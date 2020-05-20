<?php
namespace App\Repositories\Eloquent;

use App\Repositories\IEloquentRepository;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IEloquentRepository
{
    /**
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

    public function set(Model $model)
    {
        $this->model = $model;
        return $this->model;
    }

    public function setById($id)
    {
        $this->model = $this->findBy($this->model->getKeyName(), $id);
        return $this->model;
    }
    /**
     * @param array $attributes
     *
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * Returns the first record in the database.
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function first(): ?Model
    {
        return $this->model->first();
    }

    /**
     * Returns all the records.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Returns the count of all the records.
     *
     * @return int
     */
    public function count()
    {
        return $this->model->count();
    }

    /**
     * @param $attributes
     * @return Model
     */
    public function fillAndSave($attributes) {
        $this->model->fill($attributes);
        $this->model->save();

        return $this->model;
    }

    /**
     * @param $attributes
     * @return Model|null
     */
    public function update($attributes)
    {
        $this->model->update($attributes);
        return $this->model->fresh();
    }
}
