<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\LinkStatModel;
use Illuminate\Http\Request;

class LinkStatController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index ($id)
    {
        return view('linkStat',['stats' => LinkStatModel::where(['link_id'=> $id])->get()]);
    }
}
