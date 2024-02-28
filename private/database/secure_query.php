<?php
require_once($_SERVER['DOCUMENT_ROOT']."/../private/database/base.php");


function secureQuery(string $query, bool $expectResponse = true, ...$args)
{
    global $conn;
    $secure_query = $conn->prepare($query);
    if ($secure_query) {
        $i=1;
        foreach ($args as $arg) {
            switch (gettype($arg)) {
                case "integer":
                    $secure_query->bindValue($i,$arg, PDO::PARAM_INT);
                    break;
                case "string":
                    $secure_query->bindValue($i,$arg, PDO::PARAM_STR);
                    break;
                case "double":
                    $secure_query->bindValue($i,$arg, PDO::PARAM_INT);
                    break;
                case "boolean":
                    $secure_query->bindValue($i,$arg?1:0, PDO::PARAM_INT);
            }
            $i++;
        }
        $success = $secure_query->execute();
        if ($success) {
            $num_rows = $secure_query->rowCount();
            if ($num_rows > 0) {
                $retVal = array();
                while($row = $secure_query->fetch(PDO::FETCH_ASSOC)) {
                    array_push($retVal, $row);
                }
                if(count($retVal))
                {
                    return $retVal;
                }
                else
                {
                    if($expectResponse)
                    {
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
            } else if ($expectResponse) {
                return false;
            } else {
                return true;
            }
        } else {
            var_dump($conn->errorInfo());
            return false;
        }
    } else{
        var_dump($conn->errorInfo());
    }
}