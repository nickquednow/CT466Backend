<?php
require_once($_SERVER['DOCUMENT_ROOT']."/../private/errors/gpg_setup.php");
function get_warnings_log()
{
    global $gpg;

    secureQuery("SELECT FILE, LINE, EXTRAS FROM Logs;", true);
}