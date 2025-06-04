<?php
namespace App\Policies;

use App\Models\Project;
use App\Models\User;

class ProjectPolicy
{
    public function view(User $user, Project $project)
    {
        return $project->owner_id === $user->id || $project->users->contains($user);
    }

    public function update(User $user, Project $project)
    {
        return $project->owner_id === $user->id || $project->users()->where('user_id', $user->id)->where('role', 'admin')->exists();
    }

    public function delete(User $user, Project $project)
    {
        return $project->owner_id === $user->id || $project->users()->where('user_id', $user->id)->where('role', 'admin')->exists();
    }
}