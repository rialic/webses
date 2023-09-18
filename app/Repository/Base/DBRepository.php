<?php


namespace App\Repository\Base;

use App\Exceptions\FilterByMethodNotDefined;
use App\Repository\RepositoryException\EntityNotDefined;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DBRepository implements DBRepositoryInterface
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function getTableColumn($field)
    {
        $isFieldInRelationship = in_array($field, $this->model->getRelationships());

        if ($isFieldInRelationship) {
            $model = $this->model->{$field};

            return "{$model->getTableColumnPrefix()}_id";
        }

        return "{$this->model->getTableColumnPrefix()}_{$field}";
    }

    public function getModel()
    {
        if (!method_exists($this, 'model')) {
            throw new EntityNotDefined();
        }
        return app($this->model());
    }

    public function count()
    {
        return $this->model::count();
    }

    public function findAll()
    {
        return $this->model::all();
    }

    public function findById($id)
    {
        return $this->model::where($this->model->getKeyName(), $id)->first();
    }

    public function findByIdOrNew($id)
    {
        return $this->model::firstOrNew([$this->model->getKeyName() => $id]);
    }

    public function findByUuid($uuid)
    {
        return $this->model::where($this->getTableColumn('uuid'), $uuid)->first();
    }

    public function findByUuidOrNew($uuid)
    {
        return $this->model::firstOrNew([$this->getTableColumn('uuid') => $uuid]);
    }

    public function getFirstData($params = [])
    {
        return $this->query($params)->first();
    }

    public function getFirstDataOrNew($params = [])
    {
        return $this->query($params)->first() ?? $this->model;
    }

    public function getData($params = [])
    {
        $isPaginable = Arr::get($params, 'page');
        $limit = Arr::get($params, 'limit') ?: -1;
        $model = $this->query($params);

        if ($isPaginable) {
            return ($limit !== -1) ? $model->paginate($limit) : $model->paginate();
        }

        return ($limit !== -1) ? $model->limit($limit)->get() : $model->get();
    }

    public function query($params = [])
    {
        $model = $this->model;
        $model = $this->filter($model, $params);
        $model = $this->sort($model, $params);

        return $model;
    }

    public function store($data, $model)
    {
        $model->fill($model->syncFields($data));
        $model->save();

        return $model;
    }

    public function update($data, $identify)
    {
        $model = $this->findByUuid($identify);

        return $this->store($data, $model);
    }

    private function filter($model, $params)
    {
        $params = collect($params);
        $isFilterable = $params->contains(fn ($_, $key) => Str::startsWith($key, 'filter:'));

        if ($isFilterable) {
            // Verifica se o parâmetro começa com "filter:"
            $filters = $params->flatMap(function ($value, $key) {
                $isStringFilter = Str::startsWith($key, 'filter:');

                if ($isStringFilter) {
                    $field = Str::replace('filter:', '', $key);

                    if ($value !== '') {
                        return array($field => $value);
                    }
                }
            });

            $model = $filters->reduce(function ($accModel, $value, $field) {
                $method = 'filterBy' . Str::studly($field);

                // Verifica por algum método filterByMethod
                if (method_exists($this, $method)) {
                    $accModel = $this->{$method}($accModel, $value, $field);

                    return $accModel;
                }

                throw new FilterByMethodNotDefined();
            }, $model);

            return $model;
        }

        return $model;
    }

    private function sort($model, $params)
    {
        $isSortable = Arr::get($params, 'orderBy');

        if ($isSortable) {
            $orderBy = Arr::get($params, 'orderBy');
            $direction = Arr::get($params, 'direction');
            $method = 'orderBy' . Str::studly($orderBy);

            // Check for a custom orderByField method
            if (method_exists($this, $method)) {
                $model = $this->{$method}($model, $direction);
            } else {
                $model = $model->orderBy($orderBy, $direction);
            }

            return $model;
        }

        return $model->orderBy('created_at', 'desc');
    }
}
