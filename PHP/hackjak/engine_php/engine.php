<?php
$command = escapeshellcmd('/home/naufal/anaconda2/bin/python /var/www/html/hackjak/engine_py/cm_services.py 27.1 1');
$output = shell_exec($command);

echo $output;
?>