<?php require APPROOT . '/views/inc/header.php' ?>

<!-- back button -->
<a href="<?php echo URLROOT; ?>/posts" class="btn mt-3 back-btn">Back</a>
<br><br>

	<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
		<div class="row no-gutters mt-4 my-border" style="display: inline;">
			<span class="display-5">Your post &nbsp;-></span><span> created at <span class="text-secondary"><?php echo $data['post']->created_at; ?></span></span>
		</div>
	<?php endif; ?>
	
	<!-- post -->
	<div class="card mt-3">
		<div class="card-body mb-3">
			<!-- title -->
			<span class="card-title post-title"><b><?php echo $data['post']->title; ?></b></span><br>
			
			<?php if($data['post']->user_id != $_SESSION['user_id']) : ?>
				<!-- author -->
				<small class="card-subtitle text-muted">Written by: </small>
				<small class="card-subtitle text-success"><?php echo $data['user']->name; ?> </small> 
				<!-- created_at -->
				<small class="card-subtitle text-muted"> at <?php echo $data['post']->created_at; ?></small>
			<?php endif; ?>
			<!-- post body -->
			<p class="card-text mt-3 text-justify"><?php echo $data['post']->body; ?></p>
		</div>
	</div>

	<?php if($data['post']->user_id == $_SESSION['user_id']) : ?>
		<div class="row no-gutters float-right">
			<a href="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['post']->id; ?>" class="btn back-btn my-padding mr-2">Edit</a>
			<form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id; ?>" method="POST">
				<input type="submit" value="Delete" class="btn back-btn my-padding" style="display: inline;">
			</form>
		</div>
	<?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php' ?>
