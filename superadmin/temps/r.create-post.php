<?php

if(isset($_POST['submitpost'])){ 
  move_uploaded_file($_FILES["image"]["tmp_name"],"../assets/postimage/".$_FILES["image"]["name"]);
  $image = $_FILES['image']['name'];

  $title = $_POST["title"];
  $description = $_POST["description"];
   $timestamp = date("Y-m-d H:i:s");

  $sql = "INSERT INTO announcements(title, descriptions, status, image, timestamp) VALUES('$title', '$description', 'active', '$image', '$timestamp')";   
    mysqli_query($con, $sql);

}
?>
<section id="main-content">
    <section class="wrapper">
        <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Create Post / Announcement</h3>
			</div>
			
            <div class="row">
				<div class="col-lg-12">
                    <div class="content-panel r-bglpurple">	
						
						<form class="card-content rsg-pad5 text-center" name="create_post" method="post" action="" enctype="multipart/form-data">
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label for="title">Title</label>
									<input type="text" class="form-control" id="title" aria-describedby="post_titleHelp" name="title" required>
									<small id="post_titleHelp" class="form-text r-opac8"></small>
								</div>

								<div class="form-group text-left r-colblack col-md-12">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" aria-describedby="post_descHelp" name="description" required style="height:100px;"></textarea>
									<small class="form-text r-opac8"></small>
								</div>


								<div class="form-group text-left r-colblack col-md-12">
                                    <label for="post_desc">Upload Image</label>
									<input type="file" class="form-control" id="image" name="image">
									<small id="post_descHelp" class="form-text r-opac8"></small>
								</div>

							</strong>
							<div class="modal-footer">
								<?php if ($ids!=''){ echo '<input type="hidden" value="'.$ids.'" name="ids">';   }  ?>
								<input type="hidden" value="<?=$_SESSION['name'];?>" name="creatorID">
								<input type="submit" class="btn btn-primary" name="submitpost" value="Create Post">
							</div>
						</form>
						
					</div>
				</div>
			</div>
			
        </div>
    </section>
</section>

