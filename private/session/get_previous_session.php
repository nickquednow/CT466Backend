<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";
function GetPreviousSessionToken(string $username = null, string $domain = null)
{
    if($username == null || $domain == null)
    {
        if(isset($_COOKIE["session_token"]))
        {
            return $_COOKIE["session_token"];
        }
        return false;
    }
    $query = secureQuery("SELECT SESSION_TOKEN FROM Sessions WHERE DOMAIN=? AND USERNAME=? AND INVALIDATE=0", true, $domain, $username);
    if($query)
    {
        return $query[0]["SESSION_TOKEN"];
    }
    return false;
}