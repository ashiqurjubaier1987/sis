<?php
/*
 * Created on Tue May 20 2025
 *
 * Author: Ashiqur Jubaier
 * Email: ashiqurjubaier@gmail.com
 * Copyright (c) 2025 NASTech BD Solutions
 *
 * Version: 1.0.0
 *
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @mixin IdeHelperSubject
 */
class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'is_active',
        'level_id',
        'sms_enroll_student',
        'notify_teacher_enroll',
        'notify_teacher_zero_fee',
        'attendance_device_id',
    ];

    protected $casts = [
        'sms_enroll_student'      => 'boolean',
        'notify_teacher_enroll'   => 'boolean',
        'notify_teacher_zero_fee' => 'boolean',
    ];

    /**
     * Get the academic level for this subject.
     */
    public function level()
    {
        return $this->belongsTo(AcademicLevel::class, 'level_id');
    }

    /**
     * Get the teachers assigned to this subject.
     */
    public function teachers()
    {
        return $this->belongsToMany(User::class, 'teacher_subjects', 'subject_id', 'teacher_id')
                    ->withTimestamps();
    }
}
