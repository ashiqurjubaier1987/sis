<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SystemSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $settings = [
            [
                'key'         => 'app_name',
                'value'       => 'Student Information System',
                'type'        => 'string',
                'description' => 'Application name',
                'is_active'   => 1,
            ],
            [
                'key'         => 'app_v',
                'value'       => '2.0.0',
                'type'        => 'string',
                'description' => 'Current application version',
                'is_active'   => 1,
            ],
            [
                'key'         => 'app_logo',
                'value'       => 'setting_img\logo.png',
                'type'        => 'string',
                'description' => 'Application Logo',
                'is_active'   => 1,
            ],
            [
                'key'         => 'enable_otp_registration',
                'value'       => 'false',
                'type'        => 'string',
                'description' => 'Application requires OTP for registration or not',
                'is_active'   => 1,
            ],
            [
                'key'         => 'login_mode',
                'value'       => 'both',
                'type'        => 'string',
                'description' => 'Login by using email | phone | both',
                'is_active'   => 1,
            ]
        ];

        foreach ($settings as $setting) {
            DB::table('system_settings')->updateOrInsert(
                ['key' => $setting['key']],
                array_merge($setting, [
                    'created_at' => $now,
                ])
            );
        }
    }
}
