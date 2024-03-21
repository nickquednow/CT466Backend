<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";

function generate_session_token(string $user, string $domain)
{
    $time = $_SERVER['REQUEST_TIME'];
    $method = $_SERVER['REQUEST_METHOD'];
    $random_number = base64_encode(random_bytes(50));
    $token =  hash("sha3-512", $time . $method . $random_number);
    $query_result = secureQuery("INSERT INTO Sessions (STARTED_TIME, DOMAIN, USERNAME, SESSION_TOKEN) VALUE (CURRENT_TIMESTAMP(), ?, ?, ?);", false, $domain, $user, $token);
    if(!$query_result)
    {
        return false;
    }
    setrawcookie("session_token", $token, array("httponly"=>true));
    return $token;
}