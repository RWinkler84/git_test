<?php

if (isset($_GET['cookie']) && $_GET['cookie'] === 'ok') {
    setcookie('cookieok', 'ok', time() + 356 * 24 * 60 * 60);
    header("Location: index.php");
    die();
}

if(isset($_COOKIE['cookieok']) && $_COOKIE['cookieok'] === 'ok')  {
    session_start();
    if (!isset($_SESSION['counter'])) {
        $_SESSION['counter'] = 0;
    }
    else {
        $_SESSION['counter']++;
    }
}


?>

<p>Das hier ist der Inhalt...</p>

<?php if(isset($_COOKIE['cookieok']) && $_COOKIE['cookieok'] === 'ok'): ?>
    <p>Sie haben diese Seite bisher <?php echo $_SESSION['counter']; ?> mal aufgerufen...</p>
<?php endif; ?>

<?php if (!isset($_COOKIE['cookieok']) || $_COOKIE['cookieok'] !== 'ok'): ?>
    <p>Erlauben Sie Cookies? <a href="index.php?cookie=ok">Ja</a></p>
<?php endif;?>