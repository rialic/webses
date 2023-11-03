<?php

namespace App\Repository;

use App\Models\Event;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\EventInterface;
use Illuminate\Support\Facades\Log;

class EventRepository extends DBRepository implements EventInterface
{
    protected function model()
    {
        return Event::class;
    }

    public function store($data, $model)
    {
        $data = $this->getDataModels($data);

        $model->createdBy()->associate($data['created_by']);
        unset($data['created_by']);

        return parent::store($data, $model);
    }

    public function filterByName($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), 'like', "%{$data}%");
    }

    public function filterByDescription($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), 'like', "%{$data}%");
    }

    public function filterByStartAt($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), '<=', "{$data} 23:59:59");
    }

    public function filterByEndAt($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), '<=', "{$data} 23:59:59");
    }

    public function filterByBiremeCode($query, $data, $field)
    {
        return $query->where($this->getTableColumn($field), 'like', "%{$data}%");
    }

    public function filterByEventsAvailables($query, $data, $field)
    {
        return $query->whereRaw('date(ev_start_at) = curdate()');
    }
}