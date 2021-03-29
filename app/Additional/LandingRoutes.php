<?php

namespace App\Additional;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Site\LinksController;
use App\Models\LinkModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class LandingRoutes {

    public $request;
    public function __construct(Request $request) {
        $this->request = $request;
    }

    /**
     * Define routes.
     */
    public function routes()
    {
        $this->links()->each(function(LinkModel $link) {
            Route::get($link->short_link, function() use ($link) {
                return App::make(LinksController::class)->callAction('dynamicLink', ['link' => $link, 'request' => $this->request]);
            })->name('link.'.Str::snake($link->short_link));
        });
    }

    /**
     * Load links from database.
     * @return Collection|LinkModel[]
     */
    private function links() : \Illuminate\Database\Eloquent\Collection
    {
        return LinkModel::all();
    }

}
