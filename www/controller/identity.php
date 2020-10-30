<?php
namespace controller;
class identity implements IController{
    function __construct(){
        $this->discord = new \model\services\discord();
    }
    function authenticate(){
        $discord=$this->discord;
        if(isset($_GET['error']) ) {
            \controller\Router::redirect(\controller\Request::base_url());
        }
        $auth = \controller\services\discord::auth($discord->clientID(), $discord->secret(), \model\services\discord::scopes, $_GET['code']);
        if ( $auth ) {
            $user = \controller\services\discord::user_info($auth['access_token']);
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
    }
    function processRequest(){
        if ( isset($_SESSION['discord'])){
            session_destroy();
        }else {
            $discord= $this->discord;
            \controller\services\discord::auth_redirect($discord->clientID(), \model\services\discord::scopes);
        }
    }
}
?>
