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
    return collect($fields)->reduce(fn($acc, $field, $key) => $acc += ["{$this->getTableColumnPrefixAttribute()}_{$key}" => $field], []);
  }

  public function __get($name)
  {
    $propertyExits = (in_array($name, $this->appends) || in_array($name, $this->fillable));

    if ($propertyExits) {
      $method = 'get' . Str::studly($name) . 'Attribute';

      if (method_exists($this, $method)) {
        return $this->{$method}();
      }

      return  $this->getAttributes()[$name] ?? $this->getAttributes()["{$this->tableColumnPrefix}_{$name}"];
    }

    return;
  }

  public function getTableColumnPrefixAttribute()
  {
    return $this->tableColumnPrefix;
  }

  public function getPrimaryKeyAttribute()
  {
    return $this->primaryKey;
  }
}
