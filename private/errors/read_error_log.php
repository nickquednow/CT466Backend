<?php
require_once($_SERVER['DOCUMENT_ROOT']."/../private/errors/gpg_setup.php");
function get_errors_log()
{
    global $gpg;

    $ret = secureQuery("SELECT FILE, LINE, EXTRAS FROM LogErrors;", true);

    return $ret[0];
}