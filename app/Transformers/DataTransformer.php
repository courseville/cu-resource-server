<?php

namespace App\Transformers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

            if (method_exists($str, $method)) {
                $str = call_user_func_array([$str, $method], $args);
            }
        }

        Log::info($str->toString());

        return $str->toString();
    }
}
