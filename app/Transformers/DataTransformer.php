<?php

namespace App\Transformers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DataTransformer
{
    /**
     * Fetch mappings from the database based on the source.
     */
    public static function getMappings(string $source): array
    {
        $rows = DB::table('transformer_mappings')->where('data_source_id', $source)->latest()->get();

        $mappings = [];
        foreach ($rows as $row) {
            $mappings[$row->model][$row->field] = [
                'mapping' => $row->mapping,
                'formatting' => $row->formatting,
            ];
        }

        return $mappings;
    }

    /**
     * Transform an array of fetched data into multiple model formats using mappings from the database.
     */
    public static function transformFromSource(string $source, array $dataArray): array
    {
        $mappings = self::getMappings($source);
        $transformedData = [];

        foreach ($mappings as $modelClass => $mapping) {
            $modelInstance = new $modelClass;
            $transformedData[$modelClass] = self::transformArray($dataArray, $modelInstance, $mapping, $source);
        }

        return $transformedData;
    }

    /**
     * Transform an array of fetched data into the given model format with a provided mapping.
     */
    public static function transformArray(array $dataArray, Model $model, array $mapping, ?string $source = null): array
    {
        return array_map(fn ($data) => self::transform($data, $model, $mapping, $source), $dataArray);
    }

    /**
     * Transform a single fetched data item into the given model format with a provided mapping.
     */
    public static function transform(array $data, Model $model, array $mapping, ?string $source = null): array
    {
        $transformed = [];

        // Get only fillable field of that model to map
        foreach ($model->getFillable() as $field) {
            if (isset($mapping[$field])) {
                $transformed[$field] = self::applyTransformation($data, $mapping[$field]['mapping']);

                $transformed[$field] = self::applyFormatting(
                    $transformed[$field],
                    $field,
                    $mapping[$field]['formatting']
                );
            }
        }

        if ($source && in_array('data_source_id', $model->getFillable())) {
            $transformed['data_source_id'] = $source;
        }

        return $transformed;
    }

    /**
     * Apply transformation based on mapping.
     *
     * @param  mixed  $mapping
     * @return mixed
     */
    private static function applyTransformation(array $data, $mapping)
    {
        if (is_callable($mapping)) {
            return $mapping($data);
        }

        return $data[$mapping] ?? null;
    }

    /**
     * Apply formatting to a transformed field based on the formatting logic stored in the database.
     *
     * @param  mixed  $value
     * @return mixed
     */
    private static function applyFormatting($value, string $field, ?string $formatting)
    {
        if (is_null($formatting)) {
            return $value;
        }

        $formattingRules = json_decode($formatting, true);

        $str = Str::of($value);

        foreach ($formattingRules as $rule) {
            // date_format function is written because fluent string don't have date format
            if (str_starts_with($rule, 'date_format')) {
                $value = Carbon::parse($value)->toDateTimeString();
                $str = Str::of($value);

                continue;
            }

            [$method, $args] = array_pad(explode(':', $rule, 2), 2, null);
            $args = $args ? explode(',', $args) : [];

            // Handle custom parsing rules
            if (in_array($method, ['title_th', 'first_name_th', 'last_name_th'])) {
                $parts = self::parseThName($value);
                $value = $parts[$method] ?? '';
                $str = Str::of($value);

                continue;
            }

            if (in_array($method, ['title_en', 'first_name_en', 'last_name_en'])) {
                $parts = self::parseEnName($value);
                $value = $parts[$method] ?? '';
                $str = Str::of($value);

                continue;
            }

            if (method_exists($str, $method)) {
                $str = call_user_func_array([$str, $method], $args);
            }
        }

        return $str->toString();
    }

    /**
     * Parse Thai name into title, first_name, and last_name.
     */
    private static function parseThName(string $fullName): array
    {
        $fullName = trim($fullName);
        $titles = [
            'นางสาว', 'นาย', 'นาง', 'น.ส.', 'ดร.', 'ศ.', 'รศ.', 'ผศ.',
            'พล.อ.', 'พล.ท.', 'พล.ต.', 'พ.อ.', 'พ.ท.', 'พ.ต.',
            'ร.อ.', 'ร.ท.', 'ร.ต.', 'ม.ล.', 'ม.ร.ว.', 'ม.จ.',
        ];

        $title = '';
        foreach ($titles as $t) {
            if (str_starts_with($fullName, $t)) {
                $title = $t;
                $fullName = trim(substr($fullName, strlen($t)));
                break;
            }
        }

        $parts = explode(' ', $fullName, 2);
        $firstName = $parts[0] ?? '';
        $lastName = trim($parts[1] ?? '');

        return [
            'title_th' => $title,
            'first_name_th' => $firstName,
            'last_name_th' => $lastName,
        ];
    }

    /**
     * Parse English name into title, first_name, and last_name.
     */
    private static function parseEnName(string $fullName): array
    {
        $fullName = trim($fullName);

        // First, split by double space for last name if possible
        if (str_contains($fullName, '  ')) {
            $parts = explode('  ', $fullName, 2);
            $firstPart = trim($parts[0]);
            $lastName = trim($parts[1]);
        } else {
            // Fallback: split by last space if no double space
            $lastSpacePos = strrpos($fullName, ' ');
            if ($lastSpacePos !== false) {
                $firstPart = trim(substr($fullName, 0, $lastSpacePos));
                $lastName = trim(substr($fullName, $lastSpacePos + 1));
            } else {
                $firstPart = $fullName;
                $lastName = '';
            }
        }

        $titles = [
            '1st Lt.', '2nd Lt.', 'Lt. Col.', 'Mr.', 'Mrs.', 'Ms.', 'Miss', 'Dr.', 'Prof.', 'Capt.', 'Maj.', 'Col.',
        ];

        $title = '';
        foreach ($titles as $t) {
            if (str_starts_with($firstPart, $t)) {
                $title = $t;
                $firstName = trim(substr($firstPart, strlen($t)));
                break;
            }
        }

        if ($title === '') {
            $firstName = $firstPart;
        }

        return [
            'title_en' => $title,
            'first_name_en' => $firstName,
            'last_name_en' => $lastName,
        ];
    }
}
