<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PermissionService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class BaseResourceController extends Controller
{
    /**
     * The model class for this resource.
     * @var string
     */
    protected string $model;

    /**
     * The resource class for this resource.
     * @var string
     */
    protected string $resource;

    /**
     * Create a new controller instance.
     */
    public function __construct(
        protected PermissionService $permissionService,
    ) {}

    /**
     * Validate permissions and return viewable columns.
     *
     * @param string $action
     * @return array
     */
    protected function validatePermission(string $action = 'view'): array
    {
        $client = auth('api')->client();
        $viewableColumns = $this->permissionService->allowedColumns($client, $action, $this->model);

        if (empty($viewableColumns)) {
            abort(403, 'No permission to view any columns');
        }

        return $viewableColumns;
    }

    /**
     * Apply search criteria to the query builder.
     *
     * @param Builder $builder
     * @param Request $request
     * @return void
     */
    protected function applySearch(Builder $builder, Request $request): void
    {
        if (method_exists($this->model, 'getSearchable')) {
            $searchableAttributes = (new $this->model)->getSearchable();
            $builder->searchByAttributes(
                $request->string('name', ''),
                ...$searchableAttributes
            );
        }
    }
}
