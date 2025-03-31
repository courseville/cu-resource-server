<?php

namespace App\Transformers;

use Illuminate\Database\Eloquent\Model;

class DataTransformer
{
    /**
     * Transform an array of fetched data into the given model format with custom mappings.
     *
     * @param array $dataArray
     * @param Model $model
     * @return array
     */
    public static function transformArray(array $dataArray, Model $model): array
    {
        return array_map(fn($data) => self::transform($data, $model), $dataArray);
    }

    /**
     * Transform a single fetched data item into the given model format with custom mappings.
     *
     * @param array $data
     * @param Model $model
     * @return array
     */
    public static function transform(array $data, Model $model): array
    {
        $mapping = method_exists($model, 'getMapping') ? $model->getMapping() : [];
        $transformed = [];

        foreach ($model->getFillable() as $field) {
            if (isset($mapping[$field])) {
                $transformed[$field] = self::applyTransformation($data, $mapping[$field]);
            } else {
                $transformed[$field] = $data[$field] ?? null;
            }
        }

        return $transformed;
    }

    /**
     * Apply transformation based on mapping.
     *
     * @param array $data
     * @param mixed $mapping
     * @return mixed
     */
    private static function applyTransformation(array $data, $mapping)
    {
        if (is_callable($mapping)) {
            return $mapping($data);
        }

        return $data[$mapping] ?? null;
    }
}
