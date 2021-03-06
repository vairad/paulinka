<?php

session_start();

//load libraries prepared by composer
require_once 'vendor/autoload.php';

//prepare logger
Logger::configure("logger.config.xml");
$logger = Logger::getLogger("main");


$logger->debug("Load configuration");

require_once("app.conf.php");

/** ========================================================================= */
/** @var array[] storage for data to show by twig*/
global $data;
$data = array();

//preparation of arrays
$data["error"] = array();
$data["success"] = array();

require_once ("version.php");

if(isset($_GET["lang"])){
    $logger->debug("Localization set");
    switch($_GET["lang"]){
        case "cz":
            require_once("texts/cz.texts.php");
            $logger->debug("Czech localization");
            break;
        case "en":
            require("texts/en.texts.php");
            $logger->debug("English localization");
            break;
        default : require_once("texts/cz.texts.php");
    }
}else{
    require_once("texts/cz.texts.php");
}

if(isset($_POST["send"]) && $_POST["send"] == "poslat"){
    $logger->debug("In SEND");
    $logger->debug($_POST);
    require_once ("send.php");
}

//$logger->debug("Data START");
//$logger->debug($data);
//$logger->debug("Data END");

$logger->debug("Prepare twig template");

$loader = new Twig_Loader_Filesystem('.'); // path to folder with templates
$twig = new Twig_Environment($loader); // no cache

$logger->debug("Load chosen template (see app.conf.php)");
$template = $twig->loadTemplate(TEMPLATE);

$logger->debug("Show result");
echo $template->render($data);

$logger->debug("End of index.php");