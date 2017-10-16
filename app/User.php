<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\UserMeta;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Meta key
     */

    public $meta_key;

    /**
     * Relation with UserMeta
     */

    public function metas()

    {
        return $this->hasMany(UserMeta::class);
    }

    /**
     * Get All Publishable ads By publishable_ad key
     */

    public function publishable_ad()

    {
        $ads = $this->hasOne(UserMeta::class)->where('key', 'publishable_ads');
        if (count($ads)) {
            return unserialize($ads);
        } else {
            return false;
        }
    }

    public function meta()

    {
        $meta = $this->hasOne(UserMeta::class)->where('key', $this->meta_key);
        if (count($meta)){
            return $meta;
        } else {
            return false;
        }
    }
}
