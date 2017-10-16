<?php

use App\User;
use App\Ad;

function get_user_meta($user_id, $key, $array = false, $default = false)

{

    $user = User::findOrFail($user_id);

    $user->meta_key = $key;

    $meta = $user->meta;

    if ($meta) {
        if ($array) {
            return unserialize($meta->value);
        } else {
            return $meta->value;
        }
    } else {
        return $default;
    }

}

function get_publisher_ads( $user_id )

{

    $ads = get_user_meta($user_id, 'publishable_ads', true);

    if ($ads) {
        $ad_container = array();
        foreach ($ads as $ad) {
            $ad_content = Ad::find($ad);
            if (isset($ad_content)) {
                $ad_container[] = $ad_content;
            } else {
                $ad_container[] = (object) ['id' => '0', 'user_id' => '0', 'content' => '0', 'link' => '0', 'created_at' => '0', 'updated_at' => '0'];
            }
        }
        return $ad_container;
    } else {
        return false;
    }

}