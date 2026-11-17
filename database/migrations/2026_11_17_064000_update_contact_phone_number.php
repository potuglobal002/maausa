<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $this->setPhone('(347) 394-2979', '+13473942979');
    }

    public function down(): void
    {
        $this->setPhone('(347) 259-0233', '+13472590233');
    }

    private function setPhone(string $display, string $link): void
    {
        DB::table('settings')->updateOrInsert(
            ['key' => 'phone'],
            ['value' => json_encode($display), 'updated_at' => now()],
        );
        DB::table('settings')->updateOrInsert(
            ['key' => 'phone_link'],
            ['value' => json_encode($link), 'updated_at' => now()],
        );
    }
};
