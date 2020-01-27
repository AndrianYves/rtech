<?php
/**
 * 08/02/20 update
 */

$rtitle = 'Poll Vote | Technohouse'; //  set page title
$rtype = '';
include '../r.header.php';
?>

<link rel = "stylesheet" type = "text/css" href = "https://fonts.googleapis.com/css?family=Raleway">
<link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet" />

<div class="container-full">
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
</div>
<div class="rsg-pad60"></div>
<section id="container" >

    <!-- 08/01/20 update -->
    <?php
    $a = false; // set if polls will be displayed: default: false -- or do not display
    $i = 0;     // set current poll ID
    $s = $n=''; // set sql connectors

    if( isset($_GET['id']) ){
        $i = $_GET['id'];
        $s = mysqli_query($con, "select * from polls where id ='$i'");
        $n = mysqli_fetch_array($s);
        $a = $n>0 ? true : false; // display poll
    }
    if( $a ): 
        
        $arr = $rsg->site_polls($con);
        $ar = $arr[$i];
    ?>
    <div class="container">
        <div class="row">
            <div class = "content poll-vote">
                <a href = "<?=RSITE;?>poll.php" class = "btn btn-info" style = "font-family: 'Raleway' ;"> <i class = "fa fa-arrow-left"></i> &nbsp; B A C K </a>
                <h2> <strong><?=$ar['polltitle']?></strong> </h2>
                <p style = "font-family: 'Roboto' ;"> <?=$ar['polldesc']?> </p>
            </div>
        </div>
        <div class="row">
            <div class="content-panel content poll-vote">
                <form method = "post" class="rsg-pad20">

                    <?php foreach($ar['pollanswers'] as $p): ?>
                        <label style = "font-family: 'Roboto' ;" class="r-wid100">
                            <input type = "radio" name = "poll_answer" value = "<?=$p['ansID']?>" required>
                            <?=$p['ansTitle']?>
                        </label>
                    <?php endforeach; ?>
                    <hr>
                    <div>
                        <input type = "submit" value = "Submit Vote" name="SubmitVote" class="btn btn-success">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php else:
        // The poll doesn't exist -- redirect to polls list
        header("Location: ".RSITE.'poll.php');
        exit;
    endif;
    ?>

</div>
<?php include '../r.footer.php';