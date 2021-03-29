<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkModel extends Model
{
    protected $table = 'link';

    protected $fillable = ['link', 'followings', 'lifetime'];


    protected $validateMessages = [
        'link.unique' => 'Link with this name already exist.',
        'link.required' => 'Link field is required.',
        'followings.min' => 'followings min value 0.',
        'lifetime.min' => 'lifetime min value 1.',
        'lifetime.max' => 'lifetime max value 24.',
    ];

    /**
     * @param Request $request
     * @return bool|\Illuminate\Support\MessageBag
     */
    public function validate(Request $request)
    {
        $nameRules = ['required', 'unique:link'];

        $validator = Validator::make($request->all(), [
            'link' => $nameRules,
            'followings' => 'numeric|min:0',
            'lifetime' => 'numeric|min:1|max:24'
        ], $this->validateMessages);

        if ($validator->fails()) {
            return $validator->errors();
        }

        return $validator->fails();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function stats()
    {
        return $this->hasOne('App\Models\LinkStatModel','link_id','id');
    }
}
