<?php

namespace App\Repository;

use App\Models\Establishment;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\EstablishmentInterface;

class EstablishmentRepository extends DBRepository implements EstablishmentInterface
{
    protected function model()
    {
        return Establishment::class;
    }

    public function query($params = [])
    {
        $query = parent::query($params);

        return $query->with('city');
    }

    public function filterByCity($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), $data);
    }

    public function filterByLegalNature($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), $data);
    }
}
