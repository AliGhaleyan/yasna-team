<?php


namespace App\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

abstract class Repository
{
    public function all()
    {
        return $this->getQuery()->get();
    }

    abstract protected function getQuery(): Builder;

    public function paginate(int $perPage = 25): LengthAwarePaginator
    {
        return $this->getQuery()->paginate($perPage);
    }

    public function find($id)
    {
        return $this->getQuery()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->getQuery()->findOrFail($id);
    }
}
