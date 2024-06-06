<?php

namespace App\Services;

use App\Models\FootballMatch;
use App\Models\Player;
use App\Repositories\MatchPlayerRepositoryInterface;

class MatchPlayerService
{
    protected $matchPlayerRepository;

    public function __construct(MatchPlayerRepositoryInterface $matchPlayerRepository)
    {
        $this->matchPlayerRepository = $matchPlayerRepository;
    }

    public function validateMatchExists($matchId)
    {
        return FootballMatch::where('id', $matchId)->exists();
    }

    public function validatePlayersExist(array $playerIds)
    {
        $players = Player::whereIn('id', $playerIds)->get();
        $missingPlayers = array_diff($playerIds, $players->pluck('id')->toArray());
        return empty($missingPlayers);
    }

    public function create(array $data)
    {
        return $this->matchPlayerRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->matchPlayerRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        return $this->matchPlayerRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->matchPlayerRepository->delete($id);
    }

    public function getAll()
    {
        return $this->matchPlayerRepository->getAll();
    }
}
