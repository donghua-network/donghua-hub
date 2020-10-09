<?php
$discord = new \model\discord();
$auth = \controller\discord::auth($discord->clientID(), $discord->secret(), \model\discord::scopes, $_GET['code']);
if ( $auth ) {
    $user = \controller\discord::user_info($auth['access_token']);
    if ( $user ) {
        $_SESSION['discord']['access-token']     = $auth['access_token'];
        $_SESSION['discord']['refresh-token']    = $auth['refresh_token'];
        $_SESSION['discord']['token-expiration'] = time() + $auth['expires_in'];
        $_SESSION['discord']['user-id']          = $user['id'];
        $_SESSION['discord']['avatar-id']        = $user['avatar'];
        $_SESSION['discord']['username']         = $user['username'];
        $_SESSION['discord']['discriminator']    = $user['discriminator'];
        \controller\Router::redirect(\controller\Request::base_url());
    }
}
?>