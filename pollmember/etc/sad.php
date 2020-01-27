<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

if ( isset( $_GET['id'] ) ) { // Remove 'id'

    $stmt = $pdo -> prepare('SELECT * FROM polls WHERE id = ?'); // SELECT * FROM polls; << Remove 'id'
    $stmt -> execute([$_GET['id']]); // Remove 'id'

    $poll = $stmt -> fetch(PDO::FETCH_ASSOC);

    // Checks if the poll record exists with the specified ID
    if ( $poll ) {

        $stmt = $pdo -> prepare('SELECT * FROM poll_answers WHERE poll_id = ?'); // SELECT * FROM poll_answers; << Remove 'id'
        $stmt -> execute([$_GET['id']]); // Remove 'id'

        $poll_answers = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    } else {
        die ('Poll ID does not exist!'); // Remove 'id'
    }

} else {
    die ('Poll ID not specified!'); // Remove 'id'
}
?>

<?=template_header('Poll Results 2')?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "UTF-8">
    <!-- <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie=edge"> N/A -->

    <link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "https://fonts.googleapis.com/css?family=Roboto&display=swap" rel = "stylesheet">
</head>

</html>

<div class = "content poll-vote">
    <form>
        <div>
            <a href = "result.php?id=<?=$poll['id']?>">
                <i class = "fa fa-line-chart"></i> &nbsp; R E S U L T S
            </a>
        </div>
    </form>
</div>

<?=template_footer()?>