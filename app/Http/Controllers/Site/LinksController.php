<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\LinkModel;
use Illuminate\Http\Request;
use App\Models\LinkStatModel;
use hisorange\BrowserDetect\Parser as Browser;
use Carbon\Carbon;

class LinksController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ()
    {
        return view('links',['links' => LinkModel::all()]);
    }

    public function dynamicLink(LinkModel $link, Request $request)
    {
        $expireDate = new Carbon($link->created_at);
        $expireDate->addHours($link->lifetime);
        $currentDate = Carbon::now();
        $countLinks = LinkStatModel::where(['link_id' => $link->id])->count();

        if ( ($currentDate->toDateTimeString() < $expireDate->toDateTimeString()) && ($link->followings == 0 || $countLinks <= $link->followings)) {
            $this->saveClientStat($link->id, $request->server('REMOTE_ADDR'));
            return redirect($link->link, '302');
        } else {
            return abort(404);
        }

    }

    /**
     * @param $linkId
     * @param $clientIp
     */
    private function saveClientStat ($linkId, $clientIp)
    {
        $statModel = new LinkStatModel();
        $statModel->browser = Browser::browserName();
        $statModel->platform = Browser::platformName();
        $statModel->ip = $clientIp;
        $statModel->link_id = $linkId;
        $statModel->save();
    }
}
