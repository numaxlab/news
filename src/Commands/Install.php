<?php

namespace NumaxLab\NewsPost\Commands;

use Backpack\CRUD\app\Console\Commands\Traits\PrettyCommandOutput;
use Illuminate\Console\Command;

class Install extends Command
{

    use PrettyCommandOutput;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'numaxlab:new-post:install
                                {--debug} : Show process output or not. Useful for debugging.';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Cinema Catalog package';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->progressBlock('Adding menu items');

        $this->executeArtisanProcess('backpack:add-menu-content', [
            'code' => '<x-backpack::menu-item title="' . __(
                    'new-post::backpack_messages.news'
                ) . '" icon="la la-newspaper" :link="backpack_url(\'new-post-crud-controller\')" />',
        ]);

        $this->closeProgressBlock();
    }
}
