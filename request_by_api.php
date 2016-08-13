<?php
//class loader
require_once 'class-loader-master/ClassLoader.php';

use Symfony\Component\ClassLoader\ClassLoader;

$loader = new ClassLoader();

// to enable searching the include path (eg. for PEAR packages)
$loader->setUseIncludePath(true);

// ... register namespaces and prefixes here - see below

$loader->register();


//include Request API
include('Requests\library\Requests.php');

Requests::register_autoloader();

$url = isset($_REQUEST['url'])?$_REQUEST['url']:'';
//echo $url."divya"; 

//request to github
$response = Requests::get($url);

echo $response->body; 

?>