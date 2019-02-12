<div class="container-fluid">
	

			<h4><?php echo $blogRecords->title; ?></h4>

			<div class="row">
				
				<div class="col-sm-8">
					
					<?php echo $blogRecords->content; ?>

				</div>
				<div class="col-sm-4">
					<img src="<?php echo  base_url('assets/uploads/blogs/') ?><?php echo $blogRecords->image_name ?>" widht="300" height="200">
				</div>
				<div></div>

			</div>

</div>