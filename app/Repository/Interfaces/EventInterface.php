<?php

namespace App\Repository\Interfaces;

interface EventInterface
{
  public function filterByName($query, $data, $field);
  public function filterByDescription($query, $data, $field);
  public function filterByStartAt($query, $data, $field);
  public function filterByEndAt($query, $data, $field);
  public function filterByBiremeCode($query, $data, $field);
  public function filterByEventsAvailables($query, $data, $field);
}
