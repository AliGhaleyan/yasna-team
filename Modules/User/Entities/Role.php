<?php

namespace Modules\User\Entities;

class Role extends ACLEntity
{
    public function assignPermission(...$names)
    {
        foreach ($names as $name)
            $this->permissions()->attach(Permission::findByName($name)->id);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
