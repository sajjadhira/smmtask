<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/
function install(){
echo '<html>
<head>
<script type="text/javascript">
    window.location.href = "http://'.$_SERVER['HTTP_HOST'].'/install.php";
</script>
</head>

<body>

</body>
</html>';
die;
}

$base_path_dir = __DIR__;

if(substr_count($_SERVER['HTTP_HOST'],'127.0.0.1:')>0){
    $base_path_dir = str_replace('public','',$base_path_dir);
}

$envFile = $base_path_dir . '.env';
$initiateFile = __DIR__ . '/.'.str_replace(':','',str_replace('.','',$_SERVER['HTTP_HOST']));


$existsEnv = file_exists($envFile);
$existsInitiate = file_exists($initiateFile);


$installerFile = $base_path_dir;
if(substr_count($_SERVER['HTTP_HOST'],'127.0.0.1:')>0){
    $installerFile = __DIR__;
}
$installerFile= rtrim($installerFile,'/').'/install.php';


$insatllExists = file_exists($installerFile);

if(file_exists($initiateFile) && filemtime($initiateFile)<time()){
    //install();
}

if(!$existsEnv){
    if(!$insatllExists){
        echo 'We didn\'t enter install process, please contact support. send email to support@inihub.com';
        die;
    }
    //install();
    
}

if(!$existsInitiate){
    //install();
}

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$app->bind('path.public', function() {
    return __DIR__;
});


$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);
