<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('system_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique()->comment('Setting key (e.g., app_name, app_version)');
            $table->text('value')->nullable()->comment('Setting value');
            $table->string('type')->default('string')->comment('Data type: string, integer, boolean, json');
            $table->text('description')->nullable()->comment('Description of the setting');
            $table->boolean('is_active')->default(true)->comment('Whether the setting is active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_settings');
    }
};
