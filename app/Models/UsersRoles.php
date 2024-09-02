<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use App\Models\User;
use App\Models\Role;

class UsersRoles extends Pivot
{
    /*
    return $this->belongsToMany(Role::class)->withTimestamps();
    
    return $this->belongsToMany(Role::class)->withPivot('active', 'created_by');
    
    return $this->belongsToMany(Podcast::class)
                ->as('subscription')// pivot
                ->withTimestamps();
                */
    //
    /**
     * Get all of the Users for this Role.
     */
    /*  */public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "users_roles")
            //->as('pivot')//pivot
            ->withTimestamps();
    }
    
    /**
     * Get all of the Users for this Role.
     */
    /*  */public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, "users_roles")
            //->as('pivot')//pivot
            ->withTimestamps();
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_roles';
}
