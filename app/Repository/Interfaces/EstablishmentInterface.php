<?php

namespace App\Repository\Interfaces;

interface EstablishmentInterface
{
  public function filterByCity($query, $data, $field);
  public function filterByLegalNature($query, $data, $field);
}
