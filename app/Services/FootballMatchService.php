<?php

namespace App\Services;

use App\Repositories\FootballMatchRepositoryInterface;

class FootballMatchService
{
    protected $matchRepository;

    public function __construct(FootballMatchRepositoryInterface $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    public function getAll()
    {
        return $this->matchRepository->getAll();
    }

    public function create(array $data)
    {
        return $this->matchRepository->create($data);
    }

    public function findById(int $id)
    {
        return $this->matchRepository->findById($id);
    }

    public function update(int $id, array $data)
    {
        return $this->matchRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->matchRepository->delete($id);
    }
}
