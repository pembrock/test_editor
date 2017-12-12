<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 22:00
 */

namespace Editor\Common;


class Password
{
    /**
     * @param $raw_password
     * @return string
     */
    public static function encode($raw_password)
    {
        return(md5($raw_password));
    }

    /**
     * @param $raw_password
     * @param $encoded_password
     * @return bool
     */
    public static function check($raw_password, $encoded_password)
    {
            return(0===(strcasecmp(md5($raw_password), $encoded_password)));
    }
}