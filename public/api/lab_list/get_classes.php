<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/communications/json_builder.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_warning.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_error.php";

if(isset($_GET["request"]))
{
    die(JsonBuilder(array(array("name"=>"session","type"=>"string"))));
}
if(isset($_GET["response"]))
{
    die(JsonBuilder(array("length", "classes")));
}
if(isset($_GET["version"]))
{
    die(JsonBuilder(array("major"=>1,"minor"=>0)));
}

if(isset($_POST["request"]))
{
    $request = json_decode($_POST["request"], false);
    $classes_query = secureQuery("SELECT NAME FROM Classes;", true);
    if($classes_query)
    {
        $classes = array();
        $i=0;
        foreach($classes_query as $class)
        {
            $i++;
            array_push($classes, $class["NAME"]);
        }
        die(JsonBuilder(array("length"=>$i,"classes"=>$classes)));
    }
    else
    {
        die(JsonBuilder(array("length"=>0,"classes"=>[])));
    }
}