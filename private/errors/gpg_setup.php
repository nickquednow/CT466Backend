<?php
require_once($_SERVER['DOCUMENT_ROOT']."/../config/keys.php");

$gpg = new gnupg();
$gpg->adddecryptkey($gnupg_logging_key,"");
$gpg->addencryptkey($gnupg_logging_key);