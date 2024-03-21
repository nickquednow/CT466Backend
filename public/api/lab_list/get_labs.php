<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/communications/json_builder.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_warning.php";
require_once $_SERVER['DOCUMENT_ROOT']."/../private/errors/log_error.php";

if(isset($_GET["request"]))
{
    die(JsonBuilder(array(array("name"=>"session","type"=>"string"), array("name"=>"class","type"=>"string"))));
}
if(isset($_GET["response"]))
{
    die(JsonBuilder(array("length","labs")));
}
if(isset($_GET["version"]))
{
    die(JsonBuilder(array("major"=>1,"minor"=>0)));
}

if(isset($_POST["request"]))
{
    $request = json_decode($_POST["request"], false);
    $labs_query = secureQuery("SELECT NAME FROM Labs;", true);
    if($labs_query)
    {
        $labs = array();
        $i=0;
        foreach($labs_query as $lab)
        {
            $i++;
            array_push($labs, $lab["NAME"]);
        }
        die(JsonBuilder(array("length"=>$i,"labs"=>$labs)));
    }
    else
    {
        die(JsonBuilder(array("length"=>0,"labs"=>[])));
    }
}