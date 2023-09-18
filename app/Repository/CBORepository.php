<?php

namespace App\Repository;

use App\Models\CBO;
use App\Repository\Base\DBRepository;
use App\Repository\Interfaces\CBOInterface;

class CBORepository extends DBRepository implements CBOInterface
{
    protected function model()
    {
        return CBO::class;
    }
}