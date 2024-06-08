<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface EloquentRepositoryInterface
{
    /**
     * Get all instances of the model.
     *
     * @param array $columns,
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection;

    /**
     * Create a new instance of the model.
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model;

    /**
     * Retrieve an instance of the model.
     *
     * @param int $id
     * @param array $columns
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*']): ?Model;

    /**
     * Update an instance of the model.
     *
     * @param int $id
     * @param array $attributes
     * @return Model|null
     */
    public function update(int $id, array $attributes): ?Model;

    /**
     * Delete an instance of the model.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void;
}
