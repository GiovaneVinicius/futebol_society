<?php

namespace App\Repositories;

use App\Models\FootballMatch;

class FootballMatchRepository implements FootballMatchRepositoryInterface
{
    public function create(array $data)
    {
        return FootballMatch::create($data);
    }

    public function findById(int $id)
    {
        return FootballMatch::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $match = $this->findById($id);
        $match->update($data);
        return $match;
    }

    public function delete(int $id)
    {
        $match = $this->findById($id);
        $match->delete();
        return $match;
    }

    public function getAll()
    {
        return FootballMatch::all();
    }
}
