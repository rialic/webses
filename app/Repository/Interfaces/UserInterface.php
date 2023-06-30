<?php

namespace App\Repository\Interfaces;

interface UserInterface {
  public function filterByCPF($query, $data, $field);
  public function filterByEmail($query, $data, $field);
}