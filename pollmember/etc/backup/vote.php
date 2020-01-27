<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

// Checks if the poll ID exists
if ( isset( $_GET['id'] ) ) {

    $stmt = $pdo -> prepare('SELECT * FROM polls WHERE id = ?');
    $stmt -> execute([$_GET['id']]);

    $poll = $stmt -> fetch(PDO::FETCH_ASSOC);

    // Checks if the poll record exists with the specified ID
    if ( $poll ) {

        $stmt = $pdo -> prepare('SELECT * FROM poll_answers WHERE poll_id = ?');
        $stmt -> execute([$_GET['id']]);

        $poll_answers = $stmt -> fetchAll(PDO::FETCH_ASSOC);

        // If user clicks on the "Vote" button
        if ( isset( $_POST['poll_answer'] ) ) {

            // Updates and increases the vote for the user has chosen
            $stmt = $pdo -> prepare('UPDATE poll_answers SET votes = votes + 1 WHERE id = ?');
            $stmt -> execute([$_POST['poll_answer']]);

            // Redirects the user to the result page
            header ('Location: result.php?id=' . $_GET['id']);
            exit;
        }

    } else {
        die ('Poll ID does not exist!');
    }

} else {
    die ('Poll ID not specified!');
}
?>

<?=template_header('Poll Vote')?>

<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <meta http-equiv = "X-UA-Compatible" content = "ie=edge">

    <link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "https://fonts.googleapis.com/css?family=Roboto&display=swap" rel = "stylesheet">
</head>

</html>

<div class = "content poll-vote">
    <a href = "index.php" class = "polls" style = "font-family: 'Raleway' ;">
        <i class = "fa fa-arrow-left"></i> &nbsp; B A C K
    </a>

    <h2> <?=$poll['title']?> </h2>

    <p style = "font-family: 'Roboto' ;"> <?=$poll['desc']?> </p>

    <form action = "vote.php?id=<?=$_GET['id']?>" method = "post">

        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>

        <label style = "font-family: 'Roboto' ;">
            <input type = "radio" name = "poll_answer" value = "<?=$poll_answers[$i]['id']?>"<?=$i == 0 ? ' checked' : ''?>>
            <?=$poll_answers[$i]['title']?>
        </label>

        <?php endfor; ?>

        <div>
            <input type = "submit" value = "V O T E">

            <a href = "result.php?id=<?=$poll['id']?>"> R E S U L T S &nbsp;
                <i class = "fa fa-arrow-right"></i>
            </a>
        </div>
    </form>
</div>

<?=template_footer()?>