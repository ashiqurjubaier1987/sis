<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperSystemSetting
 */
class SystemSetting extends Model
{
    protected $fillable = ['key','value'];
    public $timestamps = true;
}
