<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/communications/json_builder.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";


if(isset($_GET["request"]))
{
    die(JsonBuilder(array("username", "password")));
}
if(isset($_GET["request"]))
{
    die(JsonBuilder(array("validated", "session_id")));
}

if(isset($_POST["request"]))
{
    $request = json_decode($_POST["request"], false);

    $query = secureQuery("SELECT HASHED_PASSWORD FROM LocalUsers WHERE USER_NAME=?;",true,$request->username);

    if(password_verify($request->password, $query[0]["HASHED_PASSWORD"]))
    {
        echo JsonBuilder(array("success"=>true));
    } else {
        echo JsonBuilder(array("success"=>false));
    }
}