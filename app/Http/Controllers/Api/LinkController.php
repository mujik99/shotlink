<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LinkModel;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $obj = new LinkModel();

        $validate = $obj->validate($request);
        if ($validate) {
            return response(['errors' => $validate],200);
        }

        $obj->fill($request->post());
        $obj->short_link = Str::random(8);

        if ($obj->save()) {
            return response(['link' => $obj->short_link],'200');
        } else {
            return response('server error','500');
        }
    }
}
