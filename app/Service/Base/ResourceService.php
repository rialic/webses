<?php

namespace App\Service\Base;

use App\Validator\Validator;
use Illuminate\Support\Str;

class ResourceService implements ServiceInterface
{
  protected $repository;
  protected int $limit = 20;
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

  private function getParams()
  {
    $params = [];
    $params['limit'] = (int) $this->limit;

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

    return $params;
  }
}