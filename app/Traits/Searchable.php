<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait Searchable
{
    public function getSearchQuery($builder, string $token, string ...$attributes)
    {
        return $builder->where(function ($query) use ($attributes, $token) {
            foreach ($attributes as $aIdx => $attribute) {
                $tokens = explode(':', $attribute);
                if (count($tokens) === 2) {
                    $relationship = $tokens[0];
                    $attribute = $tokens[1];
                    if ($aIdx > 0) {
                        $query->orWhereHas($relationship, function ($query) use ($attribute, $token) {
                            $query->where($attribute, 'like', '%'.$token.'%');
                        });
                    } else {
                        $query->whereHas($relationship, function ($query) use ($attribute, $token) {
                            $query->where($attribute, 'like', '%'.$token.'%');
                        });
                    }
                } else {
                    if ($aIdx > 0) {
                        $query->orWhere($attribute, 'like', '%'.$token.'%');
                    } else {
                        $query->where($attribute, 'like', '%'.$token.'%');
                    }
                }
            }
        });
    }

    /**
     * Functions for controllers
     */
    public function searchByAttributes(Request $request, $builder, string ...$attributes)
    {
        $queryParam = $this->_getQueryParam($request);
        if (isset($queryParam)) {
            $tokens = explode(' ', $queryParam);
            foreach ($tokens as $token) {
                $this->getSearchQuery($builder, $token, ...$attributes);
            }
        }

        return $builder;
    }

    private function _getQueryParam(Request $request)
    {
        $param = $request->validate([
            'query' => ['nullable', 'string'],
        ]);

        return $param['query'] ?? null;
    }
}
