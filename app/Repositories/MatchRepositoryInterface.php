<?php

namespace App\Repositories;

use App\Models\Match;

interface MatchRepositoryInterface
{
    public function create(array $data);

    public function find($id);

    public function update(Match $match, array $data);

    public function delete(Match $match);
}
