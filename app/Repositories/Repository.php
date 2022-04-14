<?php


namespace App\Repositories;


use Illuminate\Database\Eloquent\Builder;

abstract class Repository
{
    public function find($id)
    {
        return $this->getQuery()->find($id);
    }

    public function findOrFail($id)
    {
        return $this->getQuery()->findOrFail($id);
    }

    abstract protected function getQuery(): Builder;
}
