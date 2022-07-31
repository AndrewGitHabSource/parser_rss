<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ParsingService;

class LoadFeeds extends Command
{
    protected $signature = 'feeds:load';

    protected $description = 'Load Feeds and insert in db Posts';

    public function handle(ParsingService $parsing)
    {
        $parsing->insertFeeds();
    }
}
