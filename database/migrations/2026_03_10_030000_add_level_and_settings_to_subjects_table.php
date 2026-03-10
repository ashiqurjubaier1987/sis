<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('level_id')->nullable()->after('is_active');
            $table->foreign('level_id')->references('id')->on('academic_levels')->onDelete('set null');

            $table->boolean('sms_enroll_student')->default(false)->after('level_id');
            $table->boolean('notify_teacher_enroll')->default(true)->after('sms_enroll_student');
            $table->boolean('notify_teacher_zero_fee')->default(true)->after('notify_teacher_enroll');

            $table->integer('attendance_device_id')->nullable()->after('notify_teacher_zero_fee');

            $table->index('level_id');
        });
    }

    public function down(): void
    {
        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['level_id']);
            $table->dropIndex(['level_id']);
            $table->dropColumn([
                'level_id',
                'sms_enroll_student',
                'notify_teacher_enroll',
                'notify_teacher_zero_fee',
                'attendance_device_id',
            ]);
        });
    }
};
