<?php
if ( isset($_SESSION['discord']) || isset($_GET['error']) ) {
   \controller\Router::redirect(\controller\Request::base_url());
}else {
    $discord= new \model\services\discord();
    \controller\services\discord::auth_redirect($discord->clientID(), \model\services\discord::scopes);
}
?>
