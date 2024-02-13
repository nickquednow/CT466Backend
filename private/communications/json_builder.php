<?php

function JsonBuilder(array $obj) : string {
    return json_encode(array("response"=>$obj));
}