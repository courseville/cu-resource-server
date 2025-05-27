<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;

/**
 * Provides methods to search model through its attributes and relationships.
 */
trait Searchable
{
    protected function _getSearchQuery(Builder $builder, string $token, string ...$attributes)
    {
        return $builder->where(function ($query) use ($attributes, $token) {
            foreach ($attributes as $aIdx => $attribute) {
                $tokens = explode(':', $attribute);
                if (count($tokens) === 2) {
                    $relationship = $tokens[0];
                    $attribute = $tokens[1];
                    if ($aIdx > 0) {
                        $query->orWhereHas($relationship, function ($query) use ($attribute, $token) {
                            $query->where($attribute, 'like', '%' . $token . '%');
                        });
                    } else {
                        $query->whereHas($relationship, function ($query) use ($attribute, $token) {
                            $query->where($attribute, 'like', '%' . $token . '%');
                        });
                    }
                } else {
                    if ($aIdx > 0) {
                        $query->orWhere($attribute, 'like', '%' . $token . '%');
                    } else {
                        $query->where($attribute, 'like', '%' . $token . '%');
                    }
                }
            }
        });
    }

    #[Scope]
    protected function searchByAttributes(Builder $builder, string $query, string ...$attributes): void
    {
        if ($query === '') {
            return;
        }

        $tokens = explode(' ', $query);
        foreach ($tokens as $token) {
            $this->_getSearchQuery($builder, $token, ...$attributes);
        }
    }
}
