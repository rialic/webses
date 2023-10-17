<?php

namespace App\Traits;

trait HasResourceController
{
  public function show()
  {
    $data = $this->service->show();

    return new $this->resourceColection($data);
  }

  public function index()
  {
    $dataList = $this->service->index();

    return $this->resourceColection::collection($dataList);
  }

  public function store()
  {
    $model = $this->service->store();

    return (new $this->resourceColection($model))->response()->setStatusCode(201);
  }

  public function update($identify)
  {
    $model = $this->service->update($identify);

    return new $this->resourceColection($model);
  }
}
