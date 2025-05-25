<?php

namespace App\Traits;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait Paginatable
{
    /**
     * Execute $builder with get() or paginate() depending on $request
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @return mixed
     */
    public function paginatableGet(Builder $builder, Request $request)
    {
        $param = $request->validate([
            'n' => 'numeric|min:0',
            'page' => 'numeric|min:1',
        ]);

        $result = $this->paginateChooser($param, $builder);

        return $result;
    }

    private function paginateChooser($param, $builder)
    {
        if (! isset($param['page'])) {
            return $builder->get();
        }

        return $builder->paginate($param['n'] ?? 10);
    }
}
