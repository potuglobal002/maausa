<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create
        {email : Administrator email address}
        {--name=MAA Administrator : Administrator display name}
        {--password= : Password (prompted securely when omitted)}
        {--force : Update the account when it already exists}';

    protected $description = 'Create or update an MAA administrator account';

    public function handle(): int
    {
        $email = (string) $this->argument('email');
        $name = (string) $this->option('name');
        $password = $this->option('password') ?: $this->secret('Password');

        $validator = Validator::make(compact('email', 'name', 'password'), [
            'email' => ['required', 'email'],
            'name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', Password::min(10)->letters()->mixedCase()->numbers()->symbols()],
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }

            return self::FAILURE;
        }

        $existing = User::query()->where('email', $email)->first();

        if ($existing && ! $this->option('force')) {
            $this->error('An account with this email already exists. Use --force to update it.');

            return self::FAILURE;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => Hash::make($password),
                'role' => 'administrator',
                'is_active' => true,
            ],
        );

        $this->info("Administrator account ready: {$email}");

        return self::SUCCESS;
    }
}
