<?php

namespace App\Services;

use App\Repositories\ProjectRepository;

class ProjectService
{
    protected $repository;

    public function __construct(ProjectRepository $repository)
    {
        $this->repository = $repository;
    }

    public function createProject($userId, array $data)
    {
        $data['owner_id'] = $userId;
        $project = $this->repository->create($data);
        $project->users()->attach($userId, ['role' => 'admin']);
        return $project;
    }

    public function getUserProjects($userId)
    {
        return $this->repository->getAllByUser($userId);
    }

    public function updateProject($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteProject($id)
    {
        return $this->repository->delete($id);
    }
}