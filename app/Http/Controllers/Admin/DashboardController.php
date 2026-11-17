<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        return view('admin.dashboard', [
            'stats' => [
                'pages' => DB::table('pages')->count(),
                'programs' => DB::table('programs')->count(),
                'events' => DB::table('events')->count(),
                'inquiries' => DB::table('inquiries')->where('status', 'new')->count(),
                'staff' => User::query()->where('is_active', true)->count(),
            ],
        ]);
    }
}
