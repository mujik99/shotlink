<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\models\LinkModel, App\Models\LinkStatModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Config;

class deleteOldLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'links:deleteOld';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete all expire date links';

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
     * @return mixed
     */
    public function handle()
    {
        $links = LinkModel::all();
        $currentDate = Carbon::now();

        $expireLinks = [];

        foreach ($links as $link) {
            $expireDate = new Carbon($link->created_at);
            $expireDate->addHours($link->lifetime + Config::get('links.lifetime'));

            if ($currentDate->toDateTimeString() >= $expireDate->toDateTimeString()) {
                $expireLinks[] = $link->id;
            }
        }
        if (!empty($expireLinks)) {
            LinkModel::destroy($expireLinks);
            LinkStatModel::whereIn('link_id', $expireLinks)->delete();
        }
    }
}
