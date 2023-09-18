<?php

namespace App\Service\Base;

use App\Validator\Validator;
use Illuminate\Support\Str;

class ServiceResource implements ServiceInterface
{
  protected $repository;
  protected int $limit = 0;
  protected $storeInputs = [];
  protected $updateInputs = [];

  protected array $params = [
    'limit',
    'orderBy',
    'direction',
    'page'
  ];

  public function show()
  {
    return $this->repository->getFirstData($this->getParams());
  }

  public function index()
  {
    return $this->repository->getData($this->getParams());
  }

  public function store()
  {
    $data = request()->only($this->storeInputs);

    if (!is_null($this->validatorRequest())) {
      $this->validator($data)->validate();
    }

    return $this->repository->store($data, $this->repository->getModel());
  }

  public function update($identity)
  {
    $data = request()->only($this->updateInputs);

    if (!is_null($this->validatorRequest())) {
      $this->validator($data)->validate();
    }

    return $this->repository->update($data, $identity);
  }

  public function validator($inputs): Validator
  {
    $validator = $this->validatorRequest();

    return Validator($inputs, $validator->rules(), $validator->messages());
  }

  public function validatorRequest()
  {
    return null;
  }

  protected function getParams()
  {
    $params = [];

    if ($this->limit) {
      $params['limit'] = (int) $this->limit;
    }

    foreach ($this->params as $arg) {
      if (request()->get($arg)) {
        $params[$arg] = ($arg === 'limit' || $arg === 'page') ? (int) request()->get($arg) : request()->get($arg);
      }
    }

    foreach (request()->all() as $field => $value) {
      if (Str::startsWith($field, 'filter:')) {
        $params[$field] = $value;
      }
    }

    $params = $this->getUuidToId($params);

    return $params;
  }

  public function getUuidToId($params)
  {
    foreach($params as $field => $value) {
      if (Str::startsWith($field, 'filter:')) {
        $field = substr($field, strlen('filter:'));
        $isFieldInRelationship = in_array($field, $this->repository->getModel()->getRelationships());

        if ($isFieldInRelationship) {
          $model = $this->repository->getModel()->{$field};
          $model = $model::where("{$model->getTableColumnPrefix()}_uuid", $value)->first();

          $params["filter:{$field}"] = $model->id;
        }
      }
    }

    return $params;
  }
}
