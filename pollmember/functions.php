<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'phppoll';

    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);

    } catch ( PDOException $exception ) {
    	// Displays an err message if an error in connection has occurred
    	die ('Failed to connect to database!');
    }
}

/**
* Can also be defined as function template_header () ...
*
* But the title that will soon be specified by the user
* on both functions.php
* and index.php will equal to all tabs.
* ( createpoll.php / vote.php / result.php / delete.php )
*
*
*
* ERR_: responsiveness
* <meta name = "viewport" content = "width=device-width,
* initial-scale=1.0">
*
* <meta http-equiv = "X-UA-Compatible" content = "ie=edge">
*
**/
function template_header ( $title ) {
    echo <<<EOT

<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta name = "viewport" content = "width=device-width, initial-scale=1">

        <title> $title </title>

        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href = "https://fonts.googleapis.com/css?family=Roboto&display=swap" rel = "stylesheet">

        <link href = "../poll-member/CSS/style.css" rel = "stylesheet" type = "text/css">
    </head>
EOT;
}

function template_footer() {
echo <<<EOT
</html>
EOT;
}