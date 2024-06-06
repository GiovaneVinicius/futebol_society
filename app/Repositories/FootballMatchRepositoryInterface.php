<?php

namespace App\Repositories;

interface FootballMatchRepositoryInterface
{
    public function create(array $data);
    public function findById(int $id);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function getAll();
}
