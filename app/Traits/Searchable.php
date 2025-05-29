<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

/**
 * Provides methods to search model through its attributes and relationships.
 */
trait Searchable
{
    public function getSearchable(): array
    {
        return $this->searchable ?? [];
    }

    protected function _searchBuilder(Builder $builder, string $token, string ...$attributes): void
    {
        $builder->where(function ($query) use ($attributes, $token) {
            foreach ($attributes as $aIdx => $attribute) {
                $tokens = explode(':', $attribute);
                if (count($tokens) === 2) {
                    $relationship = $tokens[0];
                    $attribute = $tokens[1];
                    if ($aIdx > 0) {
                        $query->orWhereHas($relationship, function ($query) use ($attribute, $token) {
                            $query->whereLike($attribute, '%' . $token . '%');
                        });
                    } else {
                        $query->whereHas($relationship, function ($query) use ($attribute, $token) {
                            $query->whereLike($attribute, '%' . $token . '%');
                        });
                    }
                } else {
                    if ($aIdx > 0) {
                        $query->orWhereLike($attribute, '%' . $token . '%');
                    } else {
                        $query->whereLike($attribute, '%' . $token . '%');
                    }
                }
            }
        });
    }

    public function scopeSearchByAttributes(Builder $builder, string $query, string ...$attributes): void
    {
        if ($query === '') {
            return;
        }

        $tokens = explode(' ', $query);
        foreach ($tokens as $token) {
            $this->_searchBuilder($builder, $token, ...$attributes);
        }
    }
}
