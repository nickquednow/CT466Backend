<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/communications/json_builder.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/error_codes.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/error_messages.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_warning.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_error.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/session/generate_session.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/session/get_previous_session.php";

if(isset($_GET["request"]))
{
    die(JsonBuilder(array(array("name"=>"username","type"=>"string"), array("name"=>"password","type"=>"string"))));
}
if(isset($_GET["request"]))
{
    die(JsonBuilder(array(array("name"=>"success","type"=>"string"), array("name"=>"session","type"=>"string"))));
}
if(isset($_GET["version"]))
{
    die(JsonBuilder(array("major"=>1,"minor"=>1)));
}

if(isset($_POST["request"]))
{
    $request = json_decode($_POST["request"], false);

    $query = secureQuery("SELECT HASHED_PASSWORD FROM LocalUsers WHERE USER_NAME=?;",true,$request->username);

    if(password_verify($request->password, $query[0]["HASHED_PASSWORD"]))
    {
        $previous_session = GetPreviousSessionToken($request->username, 'LOCALHOST');
        if($previous_session)
        {
            die(JsonBuilder(array("success"=>true, "session"=>$previous_session)));
        }
        echo var_dump($previous_session);
        $session_token = generate_session_token($request->username, 'LOCALHOST');
        if($session_token)
        {
            die(JsonBuilder(array("success"=>true, "session"=>$session_token)));
        } else {
            log_error(__LINE__, __FILE__, array("error_number"=>$SQL_QUERY_ERROR, "error_message"=>$ERROR_MESSAGES[$SQL_QUERY_ERROR], "date"=>$_SERVER['REQUEST_TIME']));
            die(JsonBuilder(array("error"=>array("error_number"=>$SQL_QUERY_ERROR, "error_message"=>$ERROR_MESSAGES[$SQL_QUERY_ERROR]), "action"=>"")));
        }
    } else {
        die(JsonBuilder(array("success"=>false)));
    }
}

log_warning(__LINE__, __FILE__, array("error_number"=>$MALFORMED_REQUEST_ERROR, "error_message"=>$ERROR_MESSAGES[$MALFORMED_REQUEST_ERROR], "date"=>$_SERVER['REQUEST_TIME']));
die(JsonBuilder(array("error"=>array("error_number"=>$MALFORMED_REQUEST_ERROR, "error_message"=>$ERROR_MESSAGES[$MALFORMED_REQUEST_ERROR]), "action"=>"")));