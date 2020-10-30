<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add user to database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask("Enter name");
        $email = $this->ask("Enter email");
        $password = $this->secret("Enter password");
        $newuser = [
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ];
        $confirm = $this->confirm("Are you sure?");
        if ($confirm) {
            User::insert($newuser);
            $this->info("User entered");
        } else
            $this->info("Operation cancelled");
    }
}
