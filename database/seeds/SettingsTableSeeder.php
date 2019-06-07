<?php

use Illuminate\Database\Seeder;
use App\Entities\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * System Settings
         */

        // system_name
        Setting::create([
            'label' => 'System Name',
            'description' => 'The name of this system to your community members.',
            'key' => 'system_name',
            'default' => 'Lavra Identity'
        ]);

        /**
         * Community Settings
         */

        // community_name
        Setting::create([
            'label' => 'Community Name',
            'description' => 'The name of your community or organization.',
            'key' => 'community_name',
            'default' => 'My Community'
        ]);
    }
}
