<!DOCTYPE html>
<html>
    <body>
        <script>
currentUrl = ""
function urlInfos(url)
{

    var xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() { 
        if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
            requestHandler(xmlHttp.responseText);
    }
    xmlHttp.open( "GET", url + "?request", true); // false for synchronous request
    xmlHttp.send( null );
    currentUrl = url;
}

function requestHandler(response){
    replyJSON =JSON.parse(response)
    table_html = "<table>"
    replyJSON.response.forEach(element => {
        table_html += "<tr><td><span>" + element + "</span></td><td><input type=\"text\"></td></tr>";
    });
    table_html += "</table><button onclick=\"submitFields()\">Submit</button>";
    document.getElementById("ret").innerHTML = table_html;
}

function submitFields()
{
    inputs =document.querySelectorAll("div#ret table tr td input");
    texts = document.querySelectorAll("div#ret table tr td span");
    query = {}
    for(i=0;i<inputs.length;i++)
    {
        query[texts[i].innerText] = inputs[i].value;
    }
    data = new FormData();
    data.append("request", JSON.stringify(query))
    document.getElementById("req").innerText = JSON.stringify(query);

    xhr = new XMLHttpRequest();
    xhr.open("POST", currentUrl, true);
    xhr.onreadystatechange = function() { 
        if (xhr.readyState == 4 && xhr.status == 200)
            document.getElementById("final").innerText = xhr.responseText;
    }
    xhr.send(data);
}
        </script>
<?php
function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }

    return $results;
}

$files = getDirContents('api');
echo "<div>";
foreach($files as $file)
{
    if(str_contains($file, ".php") && !str_contains($file, "temp.php"))
    {
        $file_path_name = str_replace("\\","/",str_replace($_SERVER['DOCUMENT_ROOT'], "", $file));
        echo "<input type=\"radio\" name=\"file\" onclick=\"urlInfos('" . $file_path_name . "')\">" . $file_path_name . "</input><br/>";
    }
}
echo "</div>\n";
?>
<div id="ret"></div>
<span> JSON Request: </span><div id="req"></div>
<span>JSON Response: </span><div id="final"></div>
    </body>
</html>