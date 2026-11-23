<?php
session_start();

// 1. Saare session variables ko clear karein
$_SESSION = array();

// 2. Client-side session cookie ko destroy karein (Best practice)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Server-side session destroy karein
session_destroy();

// 4. Redirect karein aur script ko rok dein
header("Location: index.php");
exit();
?>