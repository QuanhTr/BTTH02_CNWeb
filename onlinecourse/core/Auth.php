<?php
// core/Auth.php
class Auth
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function check()
    {
        self::start();
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }

    public static function user()
    {
        self::start();
        return $_SESSION['user'] ?? null;
    }

    public static function login($user)
    {
        self::start();
        // sanitize user array stored in session (avoid storing password)
        unset($user['password']);
        $_SESSION['user'] = $user;
    }

    public static function logout()
    {
        self::start();
        unset($_SESSION['user']);
        session_destroy();
    }

    // Chặn user chưa login
    public static function requireLogin()
    {
        if (!self::check()) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }

    // Chặn theo role: $allowedRoles = [0,1,2]
    public static function requireRole(array $allowedRoles)
    {
        self::requireLogin();
        $user = self::user();
        if (!in_array((int)$user['role'], $allowedRoles, true)) {
            // redirect to home or show access denied
            header("Location: index.php?controller=home&action=index&error=access_denied");
            exit;
        }
    }
}
