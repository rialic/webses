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

    if ($propertyExits) {
      $method = 'get' . Str::studly($field) . 'Attribute';

      if (method_exists($this, $method)) {
        return $this->{$method}();
      }

      return  $this->getAttributes()[$field] ?? $this->getAttributes()["{$this->getTableColumnPrefix()}_{$field}"];
    }
  }

  public function getTableColumnPrefix()
  {
    return $this->tableColumnPrefix;
  }

  public function getPrimaryKey()
  {
    return $this->primaryKey;
  }
}
