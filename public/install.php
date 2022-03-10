<?php

$az = range('a','z');
$sign = [':','/','?',',','.'];




if(isset($_GET['wizard'])){
    $wizard = $_GET['wizard'];
}else{
    $wizard = '';
}


$id = 1;
$host_url = 'http://127.0.0.1:8000';
$author_url = $host_url . '/downloads?permission=install&id=' . $id;

$base_path_dir = __DIR__;
$initiate = __DIR__.'/.'.str_replace(':','',str_replace('.','',$_SERVER['HTTP_HOST']));

if(substr_count($_SERVER['HTTP_HOST'],'127.0.0.1:')>0){
    $base_path_dir = str_replace('public','',$base_path_dir);
}

$envFile = $base_path_dir . $sign[4] . $az[4] . $az[13] . $az[21];

$database = __DIR__ .$sign[1]. brand(). $sign[4] . $az[18] . $az[16]. $az[11];


$existsEnv = file_exists($envFile);
if($existsEnv && $wizard!="recheck"){

    ?>

    <script type="text/javascript">
        window.location.href = '?wizard=recheck';
    </script>
    <?php
    exit;
}


if(isset($_GET['license'])){

    $responsive = base64_encode($_GET['license']);
    $file = fopen($initiate, 'w');
    fwrite($file, $responsive);
    fclose($file);
}



/* functions */

error_reporting(0);

// required extensions
$required_extensions = [
    'BCMath', 
    'Ctype', 
    'JSON', 
    'Mbstring', 
    'OpenSSL', 
    'PDO',
    'pdo_mysql', 
    'Tokenizer', 
    'XML', 
    'cURL', 
    'fileinfo', 
    'gd', 
    'gmp'
];

// required directory permission
$required_directories = [
    'bootstrap/cache/', 
    'storage/', 
    'storage/app/', 
    'storage/framework/', 
    'core/storage/logs/'
];



function extension_enabled($name){
    if (!extension_loaded($name)) {
        $response = false;
    } else {
        $response = true;
    }
    return $response;
}

function dir_permission($name){
    $perm = substr(sprintf('%o', fileperms($name)), -4);
    if ($perm >= '0775') {
        $response = true;
    } else {
        $response = false;
    }
    return $response;
}

function setit($data){
    global $envFile;
    if (!file_exists($envFile)) {
        $file = fopen($envFile, 'w');
        fwrite($file, $data->content);
        fclose($file);
    }
}

function importDB($info){
    global $database;
    $db_host = $info->database->host;
    $db_name = $info->database->name;
    $db_user = $info->database->user;
    $db_pass = $info->database->pass;

    $db = new mysqli($db_host,$db_user,$db_pass,$db_name);
    if(mysqli_connect_errno())
    return false;

    $query = file_get_contents($database);


	if($db->multi_query($query)){
        return true;
    }else{
        return mysqli_error($db);
    }
	$db->close();

    return false;

}


function insertAdmin($info){
    $db_host = $info->database->host;
    $db_name = $info->database->name;
    $db_user = $info->database->user;
    $db_pass = $info->database->pass;
    $admin_name = $info->admin->name;
    $admin_email = $info->admin->email;
    $admin_password = $info->admin->password;
    $admin_role = $info->admin->role;
    $admin_verification = $info->admin->verification;
    $admin_joined = $info->admin->time;

    $db = new mysqli($db_host,$db_user,$db_pass,$db_name);
    if(mysqli_connect_errno())
    return false;

    $admin_statement = "INSERT INTO users (name,email,password,role,verification,created_at,updated_at) VALUES ('".$admin_name."','".$admin_email."','".$admin_password."','".$admin_role."','".$admin_verification."','".$admin_joined."','".$admin_joined."')";
    $admin_query = mysqli_query($db,$admin_statement);
    if ($admin_query){
        return true;
    }else{ 
        return false;
    }
}


function insertSettins($info){
    $db_host = $info->database->host;
    $db_name = $info->database->name;
    $db_user = $info->database->user;
    $db_pass = $info->database->pass;
    $company_name = $info->company->name;
    $company_address = $info->company->address;
    $company_phone = $info->company->phone;
    $company_email = $info->company->email;
    $time = date('Y-m-d H:i:s');

    $db = new mysqli($db_host,$db_user,$db_pass,$db_name);
    if(mysqli_connect_errno())
    return false;

    $company_statement = "INSERT INTO settings (name,value,created_at,updated_at) VALUES 
    ('company_name','".$company_name."','".$time."','".$time."'),
    ('company_address','".$company_address."','".$time."','".$time."'),
    ('company_phone','".$company_phone."','".$time."','".$time."'),
    ('company_email','".$company_email."','".$time."','".$time."'),
    ('currency','USD','".$time."','".$time."'),
    ('currency_sign','$','".$time."','".$time."'),
    ('notice_type','','".$time."','".$time."'),
    ('notice','','".$time."','".$time."')
    ";
    $company_query = mysqli_query($db,$company_statement);
    if ($company_query){
        return true;
    }else{ 
        return false;
    }
}

    function get_content($url, $array = null){

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);  

        if ($array!= null && is_array($array)) {
            
            if ($array['method'] == 'POST') {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($array));
            }
        }
        $result = curl_exec($ch);
        $arr = (array)json_decode($result);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $arr['http_response_code'] = $httpcode;
        $arr['http_request_time'] = (time()+3*24*3600);
        $obj = (object) $arr;
        $result = json_encode($obj);
        curl_close($ch);
        return $result; 
    }

function base_url($str = null){ 
    $base_url = (isset($_SERVER['HTTPS']) &&
        $_SERVER['HTTPS']!='off') ? 'https://' : 'http://';
        $partURL ='';
    
        if(substr_count($_SERVER['HTTP_HOST'],'127.0.0.1:')==0){
        $partURL = dirname(__FILE__);
        $partURL = str_replace(chr(92), '/', $partURL);
        $partURL = str_replace($_SERVER['DOCUMENT_ROOT'], '', $partURL);
        $partURL = ltrim($partURL,'/');
        $partURL = rtrim($partURL, '/');
    }
    $base_url .= $_SERVER['HTTP_HOST'].'/'.$partURL;
    if($str != null){

        $base_url = rtrim($base_url,'/') . '/' . ltrim($str,'/');
    }
    return $base_url; 
}
function brand(){
    global $az,$sign;
    $sega = '';
    $sega.=$az[8];
    $sega.=$az[13];
    $sega.=$az[8];
    $sega.=$az[7];
    $sega.=$az[20];
    $sega.=$az[1];
    return $sega;

}
function remote($str = null){
        global $az,$sign;
        $base_url = '';
        $base_url.=$az[7];
        $base_url.=$az[19];
        $base_url.=$az[19];
        $base_url.=$az[15];
        $base_url.=$az[18];
        $base_url.=$sign[0];
        $base_url.=$sign[1];
        $base_url.=$sign[1];
        $base_url.=brand();
        $base_url.=$sign[4];
        $base_url.=$az[2];
        $base_url.=$az[14];
        $base_url.=$az[12];
        if($str != null){
            $base_url = rtrim($base_url,$sign[1]).$sign[1].$str;
        }

        return $base_url;
}
function api_segment(){
    global $az,$sign;
    $segment = '';
    $segment.=$az[21];
    $segment.=$az[4];
    $segment.=$az[17];
    $segment.=$az[8];
    $segment.=$az[5];
    $segment.=$az[24];

    return $segment;
}

function conf(){
    $az = range('a','z');
    $conf = '';
    $conf.=$az[18];
    $conf.=$az[20];
    $conf.=$az[2];
    $conf.=$az[2];
    $conf.=$az[4];
    $conf.=$az[18];
    $conf.=$az[18];
    return $conf;
}

function status($data){
    global $host_url,$initiate;
    $remote = remote(api_segment());
    $remote = $host_url . '/verify';
    $data['id'] = base64_decode(file_get_contents($initiate));
    $data['method'] = 'GET';
    if($data['method'] == "GET"){
        $remote = $remote.'?'.http_build_query($data);

    }
    return get_content($remote,$data);
}

function alert($message,$type = 'danger'){

    if($type == 'danger'){
        $icon = '<i class="fa fa-exclamation-triangle text-danger"></i>';
    }elseif($type == 'warning'){
        $icon = '<i class="fa fa-exclamation-triangle text-warning"></i>';
    }elseif($type == 'info'){
        $icon = '<i class="fa fa-exclamation text-info"></i>';
    }elseif($type == 'success'){
        $icon = '<i class="fa fa-check text-success"></i>';
    }
    $alert = '<div class="alert alert-'.$type.'">'.$icon .' '.$message.'</div>';
    return $alert;
}






?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>INIHUB INSTALLER</title>
	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="html themes, bootstrap html templete, WordPress Themes, WordPress Plugins">
    <meta name="description" content="Build your brand with our beautiful themes &amp; plugins.">
    <meta name="author" content="inihub">
    
	<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <!-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css"> -->
	<!-- FontAwesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" href="<?php echo base_url('assets/animate.css/animate.min.css'); ?>">
	<!-- Custom Style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/marketplace.css'); ?>">
	<!-- Shortcut Icon -->
    <link rel="shortcut icon" href="<?php echo base_url('images/icons/favicon.ico'); ?>" type="image/x-icon" />

    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo base_url('images/icons/apple-icon-57x57.png'); ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo base_url('images/icons/apple-icon-60x60.png'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url('images/icons/apple-icon-72x72.png'); ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo base_url('images/icons/apple-icon-76x76.png'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url('images/icons/apple-icon-114x114.png'); ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo base_url('images/icons/apple-icon-120x120.png'); ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo base_url('images/icons/apple-icon-144x144.png'); ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo base_url('images/icons/apple-icon-152x152.png'); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo base_url('images/icons/apple-icon-180x180.png'); ?>">
    <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo base_url('images/icons/android-icon-192x192.png'); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo base_url('images/icons/favicon-32x32.png'); ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?php echo base_url('images/icons/favicon-96x96.png'); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('images/icons/favicon-16x16.png'); ?>">
    <link rel="manifest" href="<?php echo base_url('images/icons/manifest.json'); ?>">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="<?php echo base_url('images/icons/ms-icon-144x144.png'); ?>">
    <meta name="theme-color" content="#ffffff">
    
    
</head>

<div class="header-main" id="header">

<nav class="navbar navbar-expand-lg navbar-light margin-top-50">
  <div class="container">
	<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('images/inihub.svg'); ?>" class="d-inline-block align-text-top"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
   
		<li class="nav-item">
          <a aria-current="page" href="<?php echo base_url(); ?>">Home</a>
        </li>
		

		
		<li class="nav-item">
          <a aria-current="page" href="https://inihub.com/about">About</a>
        </li>	
		
		<li class="nav-item">
          <a aria-current="page" href="https://inihub.com/contact">Contact</a>
    </li>	


      </ul>

    </div>
  </div>
</nav>
<!-- Main Navigation END    -->

</div>
<!-- Header END    -->


			<!-- section -->
			
            <div class="container product">
                <div class="row featured">
                    <div class="col-lg-6 col-md-6 offset-lg-3 offset-md-3 col-sm-12 col-xs-12">


						<main class="minimal-content">

<?php
if($wizard == "settings"){
    ?>
    <h1 class="text-center">Company Information</h1>
    <?php
    $data_file_content = file_get_contents(__DIR__.'/.inidata');
    $data = json_decode($data_file_content);

    
    if (insertSettins($data)) {
        setit($data);
        echo alert("All is done successfully!", 'success');
        unlink(__DIR__.'/.inidata');


        $request['notify'] = true;
        $request['host'] = base64_encode($_SERVER['HTTP_HOST']);
        $content =  status($request);
        $data = json_decode($content);

        echo alert($data->barta, $data->alert);

        
        ?>
        <div class="button">
            <a class="btn btn-primary btn-transform-primary" href="<?php echo base_url(); ?>"><i class="fa fa-globe"></i> Visit Site</a>
        </div>
    <?php

    }else{
        echo alert("We couldn't insert company information, please check your database insertred properly.");
    }


}elseif($wizard == "recheck"){

    $request['reverify'] = true;
    $request['host'] = base64_encode($_SERVER['HTTP_HOST']);
    $content =  status($request);
    $data = json_decode($content);
    
    ?>
    <h1 class="text-center">Rechecking Installation</h1>
    <?php
        echo alert("We are chcking license information...",'info');
    if($data->http_response_code != 200){
        touch($initiate,$data->http_request_time);
        echo '<script>window.location.href = "'.base_url().'";</script>';
    }else
    if($data->response == conf()){
        echo alert($data->barta,'success');
        touch($initiate,$data->meyad);
        ?>

        <div class="button">
            <a class="btn btn-primary btn-transform-primary" href="<?php echo base_url(); ?>"><i class="fa fa-globe"></i> Visit Site</a>
        </div>
<?php
    }else{
        echo alert($data->barta);
?>
        <div class="button">
            <a class="btn btn-primary btn-transform-inihub" href="?wizard=recheck"><i class="fa fa-sync-alt"></i> Recheck Again</a>

            <a class="btn btn-primary btn-transform-primary" href="<?php echo $author_url .'&reffer=recheck'; ?>"><i class="fa fa-globe"></i> Allow/Update/Replace License</a>
        </div>

<?php
    }
    // $data_file_content = file_get_contents(__DIR__.'/.inidata');
    // $data = json_decode($data_file_content);

    
    // if (insertSettins($data)) {
    //     setit($data);
    //     echo alert("All is done successfully!", 'success');
    //     unlink(__DIR__.'/.inidata');

        
        ?>
 
    <?php

}else
if($wizard == 'admin'){
    

    ?>

    <h1 class="text-center">Administrator Information</h1>


<?php
    $data_file_content = file_get_contents(__DIR__.'/.inidata');
    $data = json_decode($data_file_content);

    if(insertAdmin($data)){

        echo alert("Administrator information is setuped successfully!",'success');

        

        ?>
        <div class="button">
            <a class="btn btn-primary btn-transform-primary" href="?wizard=settings"><i class="fa fa-cog"></i> Setup Company Information</a>
        </div>
    <?php

    }else{
        echo alert("We couldn't insert administrator information, please check your database insertred properly.");    
    }


}else
if ($wizard == 'install') {

?>

<h1 class="text-center">Installation</h1>

<?php

    if ($_POST) {

        $request = $_POST;
        $content =  status($request);

        file_put_contents(__DIR__.'/.inidata',$content);

        $data = json_decode($content);


        if($data->response == conf()){

            touch($initiate,$data->meyad);


            if(importDB($data)){
                echo alert("Database imported successfully!",'success');

                ?>
                <div class="button">
                    <a class="btn btn-primary btn-transform-primary" href="?wizard=admin"><i class="fa fa-user"></i> Administrator Setup</a>
                </div>
            <?php

            }else{
                echo alert("We couldn't access database, please check your database credential.");
            }

        }else{
            echo alert($data->barta);

            ?>
            <div class="button">
            <a class="btn btn-primary btn-transform-primary" href="<?php echo $author_url .'&reffer=install'; ?>"><i class="fa fa-globe"></i> Update License</a>
        </div>

        <?php

        }


    }



}elseif($wizard == 'configuration'){
    ?>



							<form method="POST" action="?wizard=install">
							<div class="identity-panel">

								<!-- <img class="mb-4" src="./assets/img/inihub.svg" alt="..."> -->
								<h1 class="h3 mb-3 fw-normal">Software Setup Wizard</h1>
								<p class="text-muted">Please provide your database and administrator information.</p>
							</div>

                            <h5 class="text-center text-muted">Database Information</h5>
                            <br/>
								
							  <div class="form-floating">
                                <input name="db_name" type="text" placeholder="Database Name" id="db_name" class="form-control" value="" required autofocus>
								<label for="floatingInput">Database Name</label>
							  </div>
								
							  <div class="form-floating">
                                <input name="db_host" type="text" placeholder="localhost" id="db_host" class="form-control" value="" required>
								<label for="floatingInput">Database Host</label>
							  </div>
								
							  <div class="form-floating">
                                <input name="db_user" type="text" placeholder="Database Username" id="db_user" class="form-control" value="" required>
								<label for="floatingInput">Database Username</label>
							  </div>
								
							  <div class="form-floating">
                                <input name="db_pass" type="text" placeholder="Database Password" id="db_pass" class="form-control" value="">
								<label for="floatingInput">Database Password</label>
							  </div>
								
                              <br/>
                              <h5 class="text-center text-muted">Administrator Information</h5>
                              <br/>

							  <div class="form-floating">
                                <input name="admin_name" type="text" placeholder="Administrator Name" id="admin_name" class="form-control" value="" required>
								<label for="floatingInput">Administrator Name</label>
							  </div>
								
							  <div class="form-floating">
                                <input name="admin_email" type="email" placeholder="name@example.com" id="admin_email" class="form-control" value="" required>
								<label for="floatingInput">Administrator Email</label>
							  </div>
                              
							  <div class="form-floating">
								<input required="" name="admin_password" type="password" placeholder="Password" class="form-control" required autocomplete="current-password">
								<label for="floatingPassword">Administrator Password</label>
							  </div>

                              <br/>
                              <h5 class="text-center text-muted">Company Information</h5>
                              <br/>

                              
							  <div class="form-floating">
                                <input name="company_name" type="text" placeholder="Company Name" id="company_name" class="form-control" value="" required>
								<label for="floatingInput">Company Name</label>
							  </div>
								
							  <div class="form-floating">
                                <input name="company_address" type="text" placeholder="13/4 Royal Palas, NY, United States" id="company_address" class="form-control" value="" required>
								<label for="floatingInput">Company Address</label>
							  </div>
                              
							  <div class="form-floating">
								<input required="" name="company_phone" type="text" placeholder="+12052349109" class="form-control" required >
								<label for="floatingPassword">Company Phone</label>
							  </div>
                              
							  <div class="form-floating">
								<input required="" name="company_email" type="email" placeholder="example@<?php echo $_SERVER['HTTP_HOST']; ?>" class="form-control" required >
								<label for="floatingPassword">Company Email</label>
							  </div>

							  <div class="checkbox mb-3">
								<label>
                                    <input type="checkbox" class="" name="agree" id="agree" required> I have provide all information are correct.
								</label>
							  </div>
                              <input type="hidden" name="submit" value="true">
							  <button class="w-100 btn btn-lg btn-primary" type="submit">Install</button>

                              <p class="mt-5 mb-3 text-muted">Note: If you complete installation this install file will disappear.</p>

							</form>
<?php
}elseif($wizard == 'requirements'){

    $error = 0;

    ?>
    <h1 class="text-center">Server Requirments</h1>
    <?php

    $php_version = version_compare(PHP_VERSION, '7.3', '>=');

    if ($phpversion==true) {
        $error = $error+1;
        echo alert('Required PHP version 7.3 or higher');
    }else{
        $error = $error+0;
        echo alert('Your PHP version is 7.3 or higher','success');
    }


    foreach ($required_extensions as $extension) {
        $extension_enabled = extension_enabled($extension);
        if ($extension_enabled==true) {
            $error = $error+0;
            echo alert("Required ".strtoupper($extension)." PHP Extension");
        }else{
            $error = $error+1;
            echo alert ("Required ".strtoupper($extension)." PHP Extension is found",'success');
        }
    }

    
    if (!file_exists($database)) {
        $error = $error+0;
        echo alert("Required database file is not available");
    }else{
        $error = $error+1;
        echo alert("Required database file is available",'success');
    }

    foreach ($required_directories as $directory) {
        $directory_perm = dir_permission($directory);

        if(is_dir($directory)){
            echo alert("Required ".strtoupper($directory)." directory");
        }else
        if ($directory_perm==true) {
            $error = $error+0;
            echo alert("Required ".strtoupper($directory)." permission 0755");
        }else{
            $error = $error+1;
            echo alert("Required ".strtoupper($directory)." permission 0755",'success');
        }
    }


    if($error > 0){
        ?>
    <div class="button">
	    <a class="btn btn-primary btn-transform-inihub" href="?wizard=requirements"><i class="fa fa-sync-alt"></i> Recheck Requirements</a>
        <a class="btn btn-primary btn-transform-primary" href="?wizard=configuration">Install Anyway <i class="fa fa-angle-double-right"></i></a>
    </div>


    <br/>
    <small>* Install Anyway may cause future error. We strongly recommended enabling all extensions and enable directory permissions.</small>
    <?php
    }else{
?>
    <div class="button">
	    <a class="btn btn-primary btn-transform-primary" href="?wizard=configuration">Next Step <i class="fa fa-angle-double-right"></i></a>
    </div>
<?php
    }
    ?>


    <?php
}elseif(isset($_GET['license'])){

    ?>
<h1 class="text-center">Permission Allowed</h1>

<div class="installer-content">
<i class="fa fa-check text-success"></i>   You allowed installation permission.<br>

</div>
<br/>
<div class="button">
	    <a class="btn btn-primary btn-transform-primary" href="?wizard=requirements">Next Step <i class="fa fa-angle-double-right"></i></a>
    </div>
    <?php

}else{
    ?>
<h1 class="text-center">Terms of Use</h1>

<div class="installer-content">
									<p style="text-align: left;">
										<strong>License to be used-</strong> <br><br>
										<b><i class="fa fa-info-circle text-info"></i> Individual License:</b>  Individual license is for one website / domain only. 
                                        <br/>
                                        <b><i class="fa fa-info-circle text-info"></i> Freelancer License:</b>  Freelancer license can be used in 10 websites / domains. 
                                        <br/>
                                        <b><i class="fa fa-info-circle text-info"></i> Agency License:</b>  Agency license can be used in unlimited websites / domains. 
                                        <br/>
                                        <br/>

                                        <i class="fa fa-info text-info"></i> If you purchased yearly license you have to renew your license every year. 
                                        If you are a owner of lifetime license then you don't have to renew your license.

                                        <br><br>
										<strong>YOU CAN:</strong><br><br>
										<i class="fa fa-check text-success"></i>   Modify or edit as you want.<br>
										<i class="fa fa-check text-success"></i>   Translate language as you want.<br><br>
										<i class="fa fa-exclamation-triangle text-warning"></i> If  any error occured after your edit on code/database, we (<span class="inihub">inihub.com</span>) are not responsible for that.<br><br>
										<strong>YOU CANNOT:</strong><br><br>
										<i class="fa fa-times text-danger"></i>  Resell, distribute, give away or trade by any means to any third party or individual without permission.<br>
										<i class="fa fa-times text-danger"></i>  Include this product into other products sold on any market or affiliate websites.<br>
										<i class="fa fa-times text-danger"></i>  Use on more than your license limit domain.<br>
										<br><br> 
										For more information, Please Check <a href="https://inihub.com/licences-information" target="_blank">Our License Info </a>.
									</p>
									<div class="button">
										<a class="btn btn-primary btn-transform-primary" href="<?php 
                                        if(isset($_GET['license'])){
                                            echo "?wizard=requirements";
                                        }else{
                                            echo $author_url;

                                        } ?>">I Agree. Next Step <i class="fa fa-angle-double-right"></i></a>
									</div>
								</div>
    <?php
}
?>

						  </main>
		
                    </div>

                </div>
            </div>
			
			<!-- section END    -->
<div class="footer-bottom">
            <span>&copy; 2017-<?php echo date('Y'); ?> <span class="inihub">inihub</span>. All Rights Reserved.</span>
        </div>


<script src="<?php  echo base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?php  echo base_url('assets/js/bootstrap.min.js') ?>"></script>

</body>
</html>