<?php

namespace App\Repository;

use App\Models\State;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\StateInterface;

class StateRepository extends DBRepository implements StateInterface
{
    protected function model()
    {
        return State::class;
    }
}