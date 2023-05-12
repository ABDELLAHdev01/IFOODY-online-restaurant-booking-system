<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class PruneModelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:prune-model-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
            $prunableModels = ['App\Models\User', 'App\Models\resturant' , 'App\Models\table'];
            foreach ($prunableModels as $prunableModel) {
                $this->prune($prunableModel);
            }

    }
}
