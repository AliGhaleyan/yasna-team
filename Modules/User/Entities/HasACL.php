<?php


namespace Modules\User\Entities;


use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasACL
{
    /**
     * Get user roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Add role to user roles
     *
     * @param mixed ...$names
     */
    public function assignRole(...$names)
    {
        foreach ($names as $name)
            $this->roles()->attach(Role::findByName($name)->id);
    }

    /**
     * Check user has selected permission
     *
     * @param string $name
     * @return bool
     */
    public function hasPermission(string $name)
    {
        /** @var Role[] $roles */
        $roles = $this->roles()->get();
        foreach ($roles as $role) {
            if ($role->permissions()->get()->contains("name", $name))
                return true;
        }

        return false;
    }

    public static function role(string $name)
    {
        return Role::findByName($name)->users();
    }
}
