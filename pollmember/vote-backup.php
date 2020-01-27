<?php
session_start();
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{
    
?>
<?php
include 'functions.php';
include_once '../r.posts.php';

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
            echo "<script> alert('Successfully voted!') </script>";
            header('refresh: 0.5 ; url = index.php');
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

    <head>
    <meta name = "viewport" content = "width=device-width, initial-scale=1">
    <link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href = "../pollmember/CSS/style.css" rel = "stylesheet" type = "text/css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome </title>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/heroic-features.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />
    <link href="<?=RSITE;?>css/r.css" rel='stylesheet' type='text/css' />
</head>
 <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=RSITE;?>member/account.php"><i class="fas fa-gear"></i> &nbsp; <?= strtoupper($_SESSION['name']);?></a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="announcement.php">Announcement</a></li>
                    <li><a href="./pollmember/index.php">Polls</a></li>
                    <li> <a href="<?=RSITE;?>logout.php">Logout</a></li>
                  
                </ul>
            </div>
        </div>
    </nav>
</html>


<!-- NOTE: corrupted CSS -->

<div class = "content poll-vote">
    <a href = "<?=RSITE;?>poll.php" class = "polls" style = "font-family: 'Raleway' ;">
        <i class = "fa fa-arrow-left"></i> &nbsp; B A C K
    </a>

    <h2> <?=$poll['title']?> </h2>

    <p style = "font-family: 'Roboto' ;"> <?=$poll['desc']?> </p>

    <form action = "vote.php?id=<?=$_GET['id']?>" method = "post">

        <?php for ($i = 0; $i < count($poll_answers); $i++): ?>

        <label style = "font-family: 'Roboto' ;">
            <input type = "radio" name = "poll_answer" value = "<?=$poll_answers[$i]['id']?>" required>
            <?=$poll_answers[$i]['title']?>
        </label>

        <?php endfor; ?>

        <div>
            <input type = "submit" value = "V O T E">
        </div>
    </form>
</div>

<?=template_footer()?>
<?php } ?>