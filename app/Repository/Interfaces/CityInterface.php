<?php

namespace App\Repository\Interfaces;

interface CityInterface
{
  public function filterByState($query, $data, $field);
}
