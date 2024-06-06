<?php

namespace App\Repositories;

use App\Models\Player;

class PlayerRepository implements PlayerRepositoryInterface
{
    public function create(array $data)
    {
        return Player::create($data);
    }

    public function findById(int $id)
    {
        return Player::findOrFail($id);
    }

    public function update(int $id, array $data)
    {
        $player = $this->findById($id);
        $player->update($data);
        return $player;
    }

    public function delete(int $id)
    {
        $player = $this->findById($id);
        $player->delete();
        return $player;
    }

    public function getAll()
    {
        return Player::all();
    }
}
