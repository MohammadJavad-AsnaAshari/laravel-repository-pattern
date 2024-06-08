<?php

namespace App\Repository\Eloquent;

use App\Repository\EloquentRepositoryInterface;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * The model instance.
     *
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of the model.
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(array $columns = ['*'], array $relations = []): Collection
    {
        $query = $this->model->newQuery();

        $this->applyRelations($query, $relations);

        return $query->get($columns);
    }

    /**
     * Create a new instance of the model.
     *
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * Retrieve an instance of the model.
     *
     * @param int $id
     * @param array $columns
     * @return Model|null
     */
    public function find(int $id, array $columns = ['*']): ?Model
    {
        return $this->model->newQuery()->find($id, $columns);
    }

    /**
     * Update an instance of the model.
     *
     * @param int $id
     * @param array $attributes
     * @return Model|null
     */
    public function update(int $id, array $attributes): ?Model
    {
        $model = $this->find($id);

        if ($model) {
            $model->update($attributes);

            return $model;
        }

        return null;
    }

    /**
     * Delete an instance of the model.
     *
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $model = $this->find($id);

        if ($model) {
            $model->delete();
        }
    }

    /**
     * Apply relations to the query.
     *
     * @param Builder $query
     * @param array $relations
     * @return void
     */
    protected function applyRelations(Builder $query, array $relations): void
    {
        foreach ($relations as $relation) {
            $query->with($relation);
        }
    }
}
