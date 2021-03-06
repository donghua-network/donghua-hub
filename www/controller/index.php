<?php
require('autoloader.php');
if(!empty($_POST['controller'])){
    if(isset($_POST['view']))
        require($_POST['controller'].'/'.$_POST['view'].'.php');
    else{
        controller\Request::loadController();
    }
}else{
    $router = new controller\Router(new controller\Request);
    //localhost/service/test/params/send/after/test
    $router->params=array('2' => 'params','3' => 'send','4' => 'after','5' => 'test');
    $router->get('/service/test', function($request){
        return 'test';
        controller\Router::redirect($request->requestScheme.'://'.$request->httpHost);
    });
    $router->get('/service/auth', function($request){
        $identity = new \controller\identity();
        $identity->authenticate();
    });
    $router->post('/service/data', function($request){
        return json_encode($request->getBody());
    });
}
?>
