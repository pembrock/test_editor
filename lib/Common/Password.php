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
    const VERSION='1';
    const ROUNDS=5000;
    const DEFAULT_SALT='SoMeSoRtOfSaLtByDeFaUlT!'; // 24 bytes

    private static $_salt=self::DEFAULT_SALT;


    /** Хеширует пароль по новой схеме.
     * @param string $raw_password Сырой пароль
     * @param string null $salt Необязательная соль. Рекомендуется использовать логин пользователя или другой
     * однозначно идентифицирующий его параметр.
     * @return string хеш пароля
     */
    public static function encode($raw_password, $salt=null)
    {
        $r='v'.self::VERSION.':';
        $c=crypt(urlencode($raw_password), '$5$rounds='.self::ROUNDS.'$'.($salt?self::expandSalt($salt):self::$_salt).'$');
        $c_arr=explode('$', $c);
        $r.=array_pop($c_arr);
        return($r);
    }

    /** Сверяет сырой пароль с хешем. Возвращает true при соответствии, иначе false
     * При наличии третьего параметра - $salt - используется эта соль, иначе - определённая в классе
     * (может быть переопределена через setSalt()
     * @param string $raw_password сырой пароль
     * @param string $encoded_password хеш пароля (в своём формате или md5)
     * @param string null $salt необязательная соль (при недостаточной длине будет автодополнена)
     * @return bool
     */
    public static function check($raw_password, $encoded_password, $salt=null)
    {
        if (!self::isMD5($encoded_password)) {
            $enc = self::encode($raw_password, $salt);
            return (0===strcmp($encoded_password, $enc));
        } else {
            return(0===(strcasecmp(md5($raw_password), $encoded_password)));
        }
    }

    /** Дополняет соль до минимума (длины DEFAULT_SALT), если она короче
     * @param string $salt
     * @return string
     */
    private static function expandSalt($salt)
    {
        if (strlen($salt)>=24) {
            return($salt);
        }
        return ($salt.substr(self::DEFAULT_SALT, 0, 24-strlen($salt)));
    }


    /** Проверяет, может ли являться параметр строковым представлением md5
     * Хеши паролей в новой форме однозначно проверку не проходят, поскольку содержат другой набор символов
     * @param $str
     * @return bool
     */
    private static function isMD5($str)
    {
        if (strlen($str)!=32) {
            return(false);
        }
        $replaced=preg_replace('/[0-9a-f]/i', '', $str);
        if (strlen($replaced)) {
            return(false);
        }
        return(true);
    }


    /** Устанавливает соль по умолчанию
     * @param $salt
     */
    public static function setSalt($salt)
    {
        self::$_salt=$salt;
    }
}