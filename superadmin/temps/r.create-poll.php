<section id="main-content">
    <section class="wrapper">
        <div class="container rsg-padTB20">
            <div class="row">
                <h3><i class="fas fa-arrow-circle-right"></i> Create Poll</h3>
			</div>
			
            <div class="row">
				<div class="col-lg-12">
                    <div class="content-panel r-bglpurple">	
						
						<form class="card-content rsg-pad5 text-center" name="create_poll" method="post" enctype="multipart/form-data">
							<strong class="r-f20">
								<div class="form-group text-left r-colblack col-md-12">
									<label for="poll_title">Title</label>
									<input type="text" class="form-control" id="poll_title" aria-describedby="poll_titleHelp" name="poll_title" required>
									<small id="poll_titleHelp" class="form-text r-opac8"></small>
								</div>

								<div class="form-group text-left r-colblack col-md-12">
                                    <label for="poll_desc">Description</label>
                                    <textarea class="form-control" id="poll_desc" aria-describedby="poll_descHelp" name="poll_desc" required style="height:80px;"></textarea>
									<small id="poll_descHelp" class="form-text r-opac8"></small>
								</div>

								<div class="form-group text-left r-colblack col-md-12">
                                    <label for="poll_chois">Choices<br>Note: One choice is to one line. Minimum of 2 choices.</label>
                                    <textarea class="form-control" id="poll_chois" aria-describedby="poll_choisHelp" name="poll_chois" required style="height:150px;"></textarea>
									<small id="poll_choisHelp" class="form-text r-opac8"></small>
								</div>
							</strong>
							<div class="modal-footer">
								<input type="submit" class="btn btn-primary" name="create_poll_submit" value="Create poll">
							</div>
						</form>
						
					</div>
				</div>
			</div>
			
        </div>
    </section>
</section>

