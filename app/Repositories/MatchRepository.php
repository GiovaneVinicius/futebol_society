<?php

namespace App\Repositories;

use App\Models\Match;

class MatchRepository implements MatchRepositoryInterface
{
    public function create(array $data)
    {
        return Match::create($data);
    }

    public function findById($id)
    {
        return Match::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $match = $this->findById($id);
        $match->update($data);
        return $match;
    }

    public function delete($id)
    {
        $match = $this->findById($id);
        $match->delete();
    }
}