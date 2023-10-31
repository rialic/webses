<?php

namespace App\Repository\Interfaces;

interface EventInterface
{
  public function filterByEventsAvailables($query, $data, $field);
}
