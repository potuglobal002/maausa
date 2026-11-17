<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::table('hero_slides')
            ->whereIn('primary_url', ['/get-involved'])
            ->update(['primary_url' => '/contact-us', 'updated_at' => now()]);

        DB::table('hero_slides')
            ->whereIn('secondary_url', ['/get-involved'])
            ->update(['secondary_url' => '/contact-us', 'updated_at' => now()]);
    }

    public function down(): void
    {
        DB::table('hero_slides')
            ->where('secondary_label', 'Get involved')
            ->where('secondary_url', '/contact-us')
            ->update(['secondary_url' => '/get-involved', 'updated_at' => now()]);
    }
};
