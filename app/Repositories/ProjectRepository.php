<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository
{
    public function getAllByUser($userId)
    {
        return Project::where('owner_id', $userId)
            ->orWhereHas('users', fn($query) => $query->where('user_id', $userId))
            ->get();
    }

    public function create(array $data)
    {
        return Project::create($data);
    }

    public function find($id)
    {
        return Project::findOrFail($id);
    }

    public function update($id, array $data)
    {
        $project = $this->find($id);
        $project->update($data);
        return $project;
    }

    public function delete($id)
    {
        $project = $this->find($id);
        $project->delete();
        return true;
    }
}