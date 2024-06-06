<?php

namespace App\Repositories;

interface PlayerRepositoryInterface
{
    public function create(array $data);
    public function getAll();
}