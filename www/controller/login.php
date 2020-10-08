<?php
if ( isset($_SESSION['discord']) || isset($_GET['error']) ) {
   \controller\Router::redirect(\controller\Request::base_url());
}else {
    $discord= new \model\discord();
    \controller\discord::auth_redirect($discord->clientID(), \model\discord::scopes);
}
?>
