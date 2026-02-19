<?php
/*
 * Created on Sat May 24 2025
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2025 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Models\Role as SpatieRole;


/**
 * @mixin IdeHelperRole
 */
class Role extends SpatieRole
{
    /** @use HasFactory<\Database\Factories\RoleFactory> */
    use HasFactory;
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    protected $guard_name = 'api';
    
    protected $fillable = [
        'name',
        'guard_name',
    ];
}
