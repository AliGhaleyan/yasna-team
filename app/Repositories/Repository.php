<?php


namespace App\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    /**
     * Get all entities
     *
     * @return Builder[]|Collection
     */
    public function all()
    {
        return $this->newQuery()->get();
    }

    /**
     * Create new query
     *
     * @return Builder
     */
    abstract protected function newQuery(): Builder;

    /**
     * Get paginate entities
     *
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 25): LengthAwarePaginator
    {
        return $this->newQuery()->paginate($perPage);
    }

    /**
     * Find a entity by id
     *
     * @param $id
     * @return Builder|Builder[]|Collection|Model|null
     */
    public function find($id)
    {
        return $this->newQuery()->find($id);
    }

    /**
     * Find a entity by id
     * If not exist entity, throw 404 exception
     *
     * @param $id
     * @return Builder|Builder[]|Collection|Model
     */
    public function findOrFail($id)
    {
        return $this->newQuery()->findOrFail($id);
    }
}
