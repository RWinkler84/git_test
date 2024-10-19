<h1>Login</h1>

<form method="POST" action="./?route=admin/login">
    <input type="hidden" name="csrf_token" value="<?php echo csrf_token(); ?>" />

    <label for="login-username">Benutzername</label><br />
    <input type="text" id="login-username" name="username" /><br />

    <label for="login-password">Passwort</label><br />
    <input type="password" id="login-password" name="password" /><br />

    <input type="submit" value="Einloggen!" />

</form>