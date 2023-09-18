<?php

namespace App\Repository;

use App\Models\City;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\CityInterface;

class CityRepository extends DBRepository implements CityInterface
{
    protected function model()
    {
        return City::class;
    }

    public function query($params = [])
    {
        $query = parent::query($params);

        return $query->with('state');
    }

    public function filterByState($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), $data);
    }
}