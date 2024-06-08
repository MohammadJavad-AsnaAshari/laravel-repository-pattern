<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface extends EloquentRepositoryInterface
{
    /**
     * Find a user by email.
     *
     * @param string $email
     * @param array $columns
     * @return Model|null
     */
    public function findByEmail(string $email, array $columns = ['*']): ?Model;

    /**
     * Get all users with a specific role.
     *
     * @param string $role
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getUsersByRole(string $role, array $columns = ['*'], array $relations = []): Collection;
}
