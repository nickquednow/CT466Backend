<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/communications/json_builder.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/error_codes.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/error_messages.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_warning.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_error.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/session/revoke_session.php";

if(isset($_GET["request"]))
{
    die(JsonBuilder(array(array("name"=>"session","type"=>"string"))));
}
if(isset($_GET["response"]))
{
    die(JsonBuilder(array(array("name"=>"success","type"=>"boolean"))));
}
if(isset($_GET["version"]))
{
    die(JsonBuilder(array("major"=>1,"minor"=>0)));
}

if(isset($_POST["request"]))
{
    $request = json_decode($_POST["request"], false);
    $stat = RevokeSession($request->session);
    JsonBuilder(array("success"=>$stat));
}

log_warning(__LINE__, __FILE__, array("error_number"=>$MALFORMED_REQUEST_ERROR, "error_message"=>$ERROR_MESSAGES[$MALFORMED_REQUEST_ERROR], "date"=>$_SERVER['REQUEST_TIME']));
die(JsonBuilder(array("error"=>array("error_number"=>$MALFORMED_REQUEST_ERROR, "error_message"=>$ERROR_MESSAGES[$MALFORMED_REQUEST_ERROR]), "action"=>"")));