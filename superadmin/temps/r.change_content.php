<?php

if(isset($_POST['changeheader'])){ 
  $headerontent = $_POST["headerontent"];
  $id = $_POST["id"];

  $sql = "UPDATE mainheader SET content = '$headerontent' WHERE id='$id'"; 
  mysqli_query($con, $sql);

}

if(isset($_POST['updatelogo'])){ 

    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES["image"]["tmp_name"],"../assets/".'logo.'.pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
}

?>

<section id="main-content">
    <section class="wrapper">
        
        <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Change Contentr</h3>
            </div>
            <div class="row">
                <div class="content-panel">
                    <form class="form-horizontal style-form" name="r.change_content.php" method="post" action="" onSubmit="return valid();">
                        <p style="color:#F00" class="rsg-pad5"><?= isset($_SESSION['msg'])?$_SESSION['msg']:'';?><?php echo $_SESSION['msg']="";?></p>
                        <?php
                          $header = mysqli_query($con, "SELECT * FROM mainheader");
                          $content = mysqli_fetch_assoc($header);
                        ?>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Content</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="headerontent" value="<?php echo $content['content'];?>" required>
                                <input type="hidden" class="form-control" name="id" value="<?php echo $content['id'];?>" required>
                            </div>
                        </div>
                        

                        <div style="margin-left:100px;">
                            <input type="submit" name="changeheader" value="Update header" class="btn btn-theme">
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Change Logo</h3>
            </div>
            <div class="row">
                <div class="content-panel">
                    <form class="form-horizontal style-form" name="r.change_content.php" method="post" action="" onSubmit="return valid();" enctype="multipart/form-data">
                        <p style="color:#F00" class="rsg-pad5"><?= isset($_SESSION['msg'])?$_SESSION['msg']:'';?><?php echo $_SESSION['msg']="";?></p>

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label" style="padding-left:40px;">Upload Image</label>
                                    <div class="col-sm-10">
                                    <input type="file" class="form-control" id="image" name="image">
                                    </div>
                                </div>


                        <div style="margin-left:100px;">
                            <input type="submit" name="updatelogo" value="Update logo" class="btn btn-theme">
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
</section>