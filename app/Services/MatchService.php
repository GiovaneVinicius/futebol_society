<?php

namespace App\Services;

use App\Repositories\MatchRepository;

class MatchService
{
    protected $matchRepository;

    public function __construct(MatchRepository $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    public function create(array $data)
    {
        return $this->matchRepository->create($data);
    }

    public function findById($id)
    {
        return $this->matchRepository->findById($id);
    }

    public function update($id, array $data)
    {
        return $this->matchRepository->update($id, $data);
    }

    public function delete($id)
    {
        $this->matchRepository->delete($id);
    }
}
