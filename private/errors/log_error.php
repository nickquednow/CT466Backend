<?php
require_once($_SERVER['DOCUMENT_ROOT']."/../private/errors/gpg_setup.php");
function log_error($line, $file, ... $extras)
{
    global $gpg;
    $file_var = $gpg->encrypt($file);
    $line_var = $gpg->encrypt(strval($line));
    $extras_var = $gpg->encrypt(json_encode($extras));

    secureQuery("INSERT INTO LogErrors (FILE, LINE, EXTRAS) VALUES (?, ?, ?);", false, $file_var, $line_var, $extras_var);
}