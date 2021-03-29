<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkStatModel extends Model
{
    protected $table = 'link_stat';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Link()
    {
        return $this->hasOne('App\Models\LinkModel','id','link_id');
    }

}
