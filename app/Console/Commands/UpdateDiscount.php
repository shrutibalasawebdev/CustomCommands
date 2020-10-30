<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class UpdateDiscount extends Command
{
    protected $hidden = true;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:discount {old} {new}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update discount of product from one value to another';

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
        $old = $this->argument('old');
        $new = $this->argument('new');
        $affected = Product::where('discount', $old)->update(array(
            'discount' => $new
        ));
        $this->info("Updated discount from " . $old . "% to " . $new . "% for " . $affected . " products");
    }
}
