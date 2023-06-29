<?php
//host on xampp
header("Content-Type: application/json");
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $url );
unset($url);
// echo($uri);
$_GET["url-request"] = $uri;

if($uri[5]!="" and isset($uri[6]) and $uri[6]!=""){
    try{
        $Request = file_exists("Controllers/".$uri[5]."Controller.php");
        if($Request){
            require_once("Controllers/Controller.php");
            require_once("Controllers/".$uri[5]."Controller.php");

            $Controller = $uri[5] . "Controller";
            $Active = new $Controller();

            $function = $uri[6];
            try{
                $Active->{$function}();
            }catch(Exception $e){
                require_once("Request_error_view.php");
            }
            
        }else{
            require_once("Request_error_view.php");
        }
    }catch(Exception $e){
        print("");
    }
}else{
    print(json_encode("No endpoint found!"));
}

