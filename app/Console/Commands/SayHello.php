<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'say:hello {name* : Name(s) of the users} {--L|language=English}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'It just says hello';

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
        $users = $this->argument('name');
        $usersStr = implode(', ', $users);
        if ($this->option('language') == "Tamil")
            $this->info("Vanakkam " . $usersStr);
        else
            $this->info("Hello " . $usersStr);
    }
}
