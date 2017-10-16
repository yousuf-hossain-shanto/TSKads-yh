<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{

    /**
     * Relation With User
     */

    public function user()

    {
        return $this->belongsTo(User::class);
    }
}
