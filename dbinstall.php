<?php
include './user/connection.php';


$command = "mysql --user={$username} --password='{$password}' "
. "-h {$server} -D {$db} < ./database/skybank.sql";

$output = shell_exec($command . '/shellexec.sql');
