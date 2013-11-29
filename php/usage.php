<!--
#############
USAGE LOGGER
#############

This snippet receives a toolname as part of the calling url like:

mywebsite.com/tools/usage.php?tool=interactiveRenamer

It then looks for a file called "usage.db" and
for an entry matching the toolname. If found,
the value for that name is increased by one.

usage.db and its entries must be created manually at first.
Entries in the form "key%value" like:

toolname_01%0
toolname_02%0
toolname_03%0

Do not forget to set CHMOD write rights to the php script folder
and usage.db!

MAXScript to call the PHP:

toolname = "myTool"
url = @"mywebsite.com/myfolder/usage.php?tool="+toolname
wc = dotNetObject "System.Net.WebClient"
wc.DownloadString url

REMOVE ALL COMMENTS BEFORE PLACING THIS ON THE SERVER
TO REDUCE DOWNLOAD SIZE AND HIDE FROM USER

-->

<?php
    function log_usage($tool) {
        $filename = "usage.db";
        $lines = file($filename);

        foreach ($lines as $idx => &$line) {
            $tokens = split("%", $line);
            $key = $tokens[0];
            $value = (int) $tokens[1];

            // For debugging in the browser
            echo $key." ".$value."<p>";

            if (strcasecmp($key, $tool) == 0) {
                $line = $key."%".($value+1)."\n";
            }
        }

        $changed = implode("", $lines);
        file_put_contents($filename, $changed);
    }

    $tool = $_GET["tool"];
    if ($tool != null) {
        log_usage($tool);
    }
?>
