<?php

class AdminController
{
    protected static $adminHomeUrl = '/admin/';

    public function __construct()
    {
        session_start();
    }

    protected static function checkLogin()
    {
        if (empty($_SESSION['user_id'])) {
            static::redirectToAdminHomepage();
        }
    }

    protected static function redirectToAdminHomepage()
    {
        header('Location:' . static::$adminHomeUrl);
    }

    public static function runIndex()
    {
        if (empty($_SESSION['user_id'])) {
            return require 'views/login.php';
        }

        $workshops = Model::getAllWorkshops();

        return require 'views/admin.php';
    }

    public static function runLogin()
    {
        if (isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            static::redirectToAdminHomepage();
        }

        if ($user = Model::authenticateAdmin($_POST['username'], $_POST['password'])) {
            $_SESSION['user_id'] = $user['id'];
            static::redirectToAdminHomepage();
        } else {
            $error = 'Napačno uporabniško ime in geslo.';
        }

        return require 'views/login.php';
    }

    public static function runLogout()
    {
        static::checkLogin();

        session_destroy();
        $cookieParams = session_get_cookie_params();
        setcookie(session_name(), '', 0, $cookieParams['path'], $cookieParams['domain'], $cookieParams['secure'],
            $cookieParams['httponly']);
        $_SESSION = array();

        static::redirectToAdminHomepage();
    }

    public static function runNew()
    {
        static::checkLogin();

        return require 'views/workshop_add.php';
    }

    public static function runCreate()
    {
        static::checkLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            static::redirectToAdminHomepage();
        }

        $postTitle = trim($_POST['title']);
        $postDate = trim($_POST['date']);

        if (!check_required(['title', 'date'])) {
            $error = 'Naziv in datum sta obvezni polji!';

            return require 'views/workshop_add.php';
        }

        $date = strtotime($postDate);

        if (!$date) {
            $error = 'Datum ni v veljavnem formatu!';

            return require 'views/workshop_add.php';
        } else {
            $capacity = !empty($_POST['capacity']) ? $_POST['capacity'] : null;
            Model::saveWorkshop($postTitle, date('Y-m-d H:i:s', $date), $capacity);
        }

        static::redirectToAdminHomepage();
    }

    public static function runEdit($id = null)
    {
        static::checkLogin();

        if (!$id) {
            static::redirectToAdminHomepage();
        }

        $workshop = Model::getWorkshop($id);

        if (!$workshop) {
            $error = 'Delavnica ne obstaja!';

            return require 'views/workshop_add.php';
        }

        return require 'views/workshop_edit.php';
    }

    public static function runUpdate($workshopId)
    {
        static::checkLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            static::redirectToAdminHomepage();
        }

        $postTitle = trim($_POST['title']);
        $postDate = trim($_POST['date']);

        if (!check_required(['title', 'date'])) {
            $error = 'Naziv in datum sta obvezni polji!';

            return require 'views/workshop_add.php';
        }

        $date = strtotime($postDate);

        if (!$date) {
            $error = 'Datum ni v veljavnem formatu!';

            return require 'views/workshop_add.php';
        } else {
            $capacity = !empty($_POST['capacity']) ? $_POST['capacity'] : null;
            Model::saveWorkshop($postTitle, date('Y-m-d H:i:s', $date), $capacity, $workshopId);
        }

        static::redirectToAdminHomepage();
    }

    public static function runParticipants()
    {
        static::checkLogin();

        $workshops = Model::getAllWorkshops();

        foreach ($workshops as &$workshop) {
            $workshop['participants'] = Model::getWorkshopApplications($workshop['id']);

            unset($workshop);
        }

        return require 'views/workshop_participants.php';
    }
}
