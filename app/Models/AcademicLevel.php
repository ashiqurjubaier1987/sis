<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicLevel extends Model
{
    protected $fillable = [
        'name',
        'active',
    ];

    /**
     * Get the subjects for this academic level.
     */
    public function subjects()
    {
        return $this->hasMany(Subject::class, 'level_id');
    }
}
