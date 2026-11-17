<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    private const MODULES = [
        'pages' => [
            'title' => 'Pages',
            'description' => 'Create and manage the organization’s website pages.',
            'table' => 'pages',
            'action' => 'Create page',
            'columns' => ['Title', 'Status', 'Published', 'Updated'],
        ],
        'programs' => [
            'title' => 'Programs',
            'description' => 'Manage support programs and their display order.',
            'table' => 'programs',
            'action' => 'Create program',
            'columns' => ['Program', 'Status', 'Order', 'Updated'],
        ],
        'events' => [
            'title' => 'Events',
            'description' => 'Plan events and manage registration availability.',
            'table' => 'events',
            'action' => 'Create event',
            'columns' => ['Event', 'Date', 'Status', 'Registration'],
        ],
        'media' => [
            'title' => 'Media library',
            'description' => 'Organize approved photographs, documents and videos.',
            'table' => 'media',
            'action' => 'Upload media',
            'columns' => ['File', 'Type', 'Size', 'Uploaded'],
        ],
        'inquiries' => [
            'title' => 'Inquiries',
            'description' => 'Review and manage messages from families and community members.',
            'table' => 'inquiries',
            'action' => null,
            'columns' => ['Name', 'Type', 'Status', 'Received'],
        ],
        'settings' => [
            'title' => 'Settings',
            'description' => 'Configure website identity, contact information and integrations.',
            'table' => 'settings',
            'action' => null,
            'columns' => ['Setting', 'Value', 'Updated', ''],
        ],
    ];

    public function __invoke(string $module): View
    {
        abort_unless(array_key_exists($module, self::MODULES), 404);

        $config = self::MODULES[$module];

        return view('admin.module', [
            'module' => $module,
            'config' => $config,
            'count' => DB::table($config['table'])->count(),
        ]);
    }
}
