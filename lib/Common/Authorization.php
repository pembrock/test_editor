<?php
/**
 * Created by PhpStorm.
 * User: pembrock
 * Date: 10.12.17
 * Time: 19:25
 */

namespace Editor\Common;

use Editor\DB\DBConnect;
use PDO;


class Authorization extends AbstractAuthorization
{
    const HASH_VAL = 4969;
    private $login;
    private $password;
    private $db;

    function __construct()
    {
        $this->db = DBConnect::instance()->getConnection();
    }

    public function checkAuth()
    {
        if (isset($_SESSION['user_login'])) {
            $query = $this->db->prepare('SELECT id, sid FROM users WHERE email = :session_login');
            $query->execute(array(':session_login' => $_SESSION['user_login']));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            if (!empty($result)) {
                if ($result['sid'] == session_id()) {
                    return true;
                }
            }
        }

        if (isset($_COOKIE['uid']) && isset($_COOKIE['hash'])) {
            $query = $this->db->prepare('SELECT id, pass FROM users WHERE id = :id');
            $query->execute(array(':id' => $_COOKIE['uid']));
            $result = $query->fetch(PDO::FETCH_ASSOC);
            $additional_hash = Password::encode($result['id'] . self::HASH_VAL);
            $hash = Password::encode($result['password'] . $additional_hash);
            if ($hash == $_COOKIE['hash']) {
                $sid = session_id();
                $query = $this->db->prepare('UPDATE users SET sid = :sid WHERE id = :uid');
                $query->bindParam(':sid', $sid);
                $query->bindParam(':uid', $_COOKIE['uid']);
                $query->execute();
                return true;
            }
        }

        return false;
    }

    public function doAuth($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
        if (isset($_SESSION['user_login'])) {
            unset($_SESSION['user_login']);
        }
        $query = $this->db->prepare('SELECT id FROM users WHERE email = :login and pass = :password');
        $query->execute(array(':login' => $this->login, ':password' => Password::encode($this->password)));
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if (!empty($result)) {
            $_SESSION['user_login'] = $this->login;
            $sid = session_id();
            $query = $this->db->prepare('UPDATE users SET sid = :sid WHERE id = :uid');
            $query->bindParam(':sid', $sid);
            $query->bindParam(':uid', $result['id']);
            $query->execute();
            $this->saveSession($result['id']);
            return true;
        }
        return false;
    }

    private function saveSession($uid)
    {
        $password_hash = Password::encode($this->password);
        $additional_hash = Password::encode($uid . self::HASH_VAL);
        $hash =  Password::encode($password_hash . $additional_hash);
        setcookie('uid', $uid, time() + 3600*24*30);
        setcookie('hash', $hash, time() + 3600*24*30);
    }

    public function clearSession()
    {
        if (isset($_SESSION['user_login'])) {
            unset($_SESSION['user_login']);
        }

        return true;
    }

}