<?php

namespace App\Console\Commands;

use App\Mail\DetailedReport;
use App\Mail\CompactReport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class EmailReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:report {emails* : Email addresses separated by spaces} {--T|type=Compact : Compact or Detailed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends the report by mail';

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
        $emails = $this->argument('emails');
        $emailsStr = implode(', ', $emails);

        $type = $this->option('type');

        $bar = $this->output->createProgressBar(count($emails));
        $bar->start();

        foreach ($emails as $email) {
            if ($type == "Detailed")
                Mail::to($email)->send(new DetailedReport);
            else
                Mail::to($email)->send(new CompactReport);
            $bar->advance();
        }
        $bar->finish();
        $this->info(" " . $type . " Email(s) sent to " . $emailsStr);
    }
}
