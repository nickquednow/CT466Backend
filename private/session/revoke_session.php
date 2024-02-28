<?php
require_once $_SERVER['DOCUMENT_ROOT']."/../private/database/secure_query.php";
function RevokeSession(string $session)
{
    // make sure that the call is not coming someone else and only from the user.
    if($session==$_COOKIE['session_token'])
    {
        unset($_COOKIE['session_token']);
        setrawcookie('session_token', '', -1);
        secureQuery("UPDATE Sessions SET INVALIDATE=1 WHERE SESSION_TOKEN=?", false, $session);
        return true;
    }
    else
    {
        return false;
    }
}