<?php 

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App();

$container=$app->getContainer();

$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};
$container['renderer'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates');
$checkProxyHeaders = false;
$trustedProxies = [];
$app->add(new RKA\Middleware\IpAddress($checkProxyHeaders, $trustedProxies));

$app->get('/ok', function($request, $response) {
    
    $ipAddress = $request->getAttribute('ip_address');
    $this->logger->addInfo("$ipAddress");
    $this->logger->addInfo("ok");
    return $response->write("ok");

});


$app->get('/error', function($request, $response) {
    $ipAddress = $request->getAttribute('ip_address');
    $this->logger->addInfo("$ipAddress");
    $this->logger->addInfo("error");
    return $response->write('error');

});

$app->get('/',function($request,$response){
    if(file_exists("../logs/app.log")){
    $buff=file_get_contents('../logs/app.log',true);
    $buff=explode('[] []',$buff);
    $buff=collect($buff)->map(function($item,$key){
    $str=strpos($item,"O: ");
    $item=substr($item,$str+3,-1);
    return $item;
    })->filter()->countBy()->All();
    $param=['buff'=>$buff];
    return $this->renderer->render($response,'test.phtml',$param);
    }
    
    return $response->write("Нет данных о попытках подключения");
});



$app->run();

