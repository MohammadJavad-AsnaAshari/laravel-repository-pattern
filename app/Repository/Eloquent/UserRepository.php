<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Find a user by email.
     *
     * @param string $email
     * @param array $columns
     * @return Model|null
     */
    public function findByEmail(string $email, array $columns = ['*']): ?Model
    {
        return $this->model->newQuery()->where('email', $email)->first($columns);
    }

    /**
     * Get all users with a specific role.
     *
     * @param string $role
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function getUsersByRole(string $role, array $columns = ['*'], array $relations = []): Collection
    {
        $query = $this->model->newQuery();

        $this->applyRelations($query, $relations);

        return $query->whereHas('roles', function (Builder $query) use ($role) {
            $query->where('name', $role);
        })->get($columns);
    }
}
