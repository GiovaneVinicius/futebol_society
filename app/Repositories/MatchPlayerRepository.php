<?php

namespace App\Repositories;

use App\Models\MatchPlayer;

class MatchPlayerRepository implements MatchPlayerRepositoryInterface
{
    public function create(array $data)
    {
        return MatchPlayer::create($data);
    }

    public function findById(int $id)
    {
        return MatchPlayer::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $matchPlayer = $this->findById($id);
        $matchPlayer->update($data);
        return $matchPlayer;
    }

    public function delete(int $id)
    {
        $matchPlayer = $this->findById($id);
        $matchPlayer->delete();
        return $matchPlayer;
    }

    public function getAll()
    {
        return MatchPlayer::all();
    }
}
