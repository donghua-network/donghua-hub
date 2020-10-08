<?php
if ( isset($_SESSION['discord']) ) {
   session_destroy();
}
\controller\Router::redirect(\controller\Request::base_url());
?>
