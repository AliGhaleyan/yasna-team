<?php

namespace Modules\User\Entities;

class Permission extends ACLEntity
{
    public function assignRole(...$names)
    {
        foreach ($names as $name)
            $this->roles()->attach(Role::findByName($name)->id);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
