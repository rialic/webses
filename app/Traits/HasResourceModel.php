<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait HasResourceModel
{
  public function __construct(array $attributes = [])
  {
    parent::__construct($attributes);
    array_unshift($this->appends, 'id', 'uuid');
  }

  public function uniqueIds()
  {
    return [str_replace('_id', '_uuid', $this->getKeyName())];
  }

  public function syncFields(array $fields): array
  {
    return collect($fields)->reduce(fn($acc, $field, $key) => $acc += ["{$this->getTableColumnPrefix()}_{$key}" => $field], []);
  }

  public function __get($field)
  {
    $propertyExits = (in_array($field, $this->appends) || in_array($field, $this->fillable));
    $isRelationField = in_array($field, $this->getRelationships());

    if ($propertyExits) {
      $method = 'get' . Str::studly($field) . 'Attribute';

      if (method_exists($this, $method)) {
        return $this->{$method}();
      }

      return  $this->getAttributes()[$field] ?? $this->getAttributes()["{$this->getTableColumnPrefix()}_{$field}"];
    }

    if ($isRelationField) {
      $model = app('App\Models\\' . ucfirst($field));

      return $model->where("{$model->getTableColumnPrefix()}_id", optional($this->getAttributes())["{$model->getTableColumnPrefix()}_id"])->first() ?: $model;
    }
  }

  public function getIdAttribute()
  {
    return $this->getAttributes()[$this->getPrimaryKey()];
  }

  public function getUuidAttribute()
  {
    return $this->getAttributes()["{$this->getTableColumnPrefix()}_uuid"];
  }

  public function getTableColumnPrefix()
  {
    return $this->tableColumnPrefix;
  }

  public function getPrimaryKey()
  {
    return $this->primaryKey;
  }

  public function getRelationships()
  {
    return $this->relationships ?: [];
  }
}
