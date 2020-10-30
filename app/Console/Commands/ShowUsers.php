<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class ShowUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'show:users {count=5}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the latest users';

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
        $count = $this->argument('count');
        $headers = ['Name', 'Email'];
        $users = User::orderBy('id', 'desc')->take($count)->get(['name', 'email'])->toArray();
        $this->info("Displaying latest " . count($users) . " users");
        $this->table($headers, $users);
    }
}
