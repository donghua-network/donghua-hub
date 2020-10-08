<?php
require('autoloader.php');
if(!empty($_POST['controller']))
    require($_POST['controller'].'.php');
else{
    $router = new controller\Router(new controller\Request);
    //localhost/service/test/params/send/after/test
    $router->params=array('2' => 'params','3' => 'send','4' => 'after','5' => 'test');
    $router->get('/service/test', function($request){
        return 'test';
        controller\Router::redirect($request->requestScheme.'://'.$request->httpHost);
    });
    $router->get('/home', function($request){
        require('view/index.html');
    });
    $router->get('/service/auth', function($request){
        require('auth.php');
    });
    $router->get('login', function($request){
        require('login.php');
    });
    $router->get('logout', function($request){
        require('logout.php');
    });
    $router->post('/service/data', function($request){
        print_r($_POST);
        return json_encode($request->getBody());
    });
}
?>
