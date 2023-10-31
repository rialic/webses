<?php

namespace App\Repository;

use App\Models\Event;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\EventParticipantInterface;

class EventParticipantRepository extends DBRepository implements EventParticipantInterface
{
    protected function model()
    {
        return Event::class;
    }

    public function store($data, $model)
    {
        $data = $this->getDataModels($data);
        $tenant = app('App\Tenant\ManagerTenant')->tenant();
        $event = $data['event'];
        $user = $data['user'];

        $event->participants()->syncWithPivotValues($user->id, ['tenant_id' => $tenant->id]);

        return $event;
    }
}