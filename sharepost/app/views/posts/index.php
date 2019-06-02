<?php require APPROOT . '/views/inc/header.php' ?>
    <?php flash('post_message'); ?>
    <div class="row mt-3">
        <div class="col- mr-auto">
            <h1>Posts</h1>
        </div>
        <div class="col-auto ml-auto">
            <a href="<?php echo URLROOT; ?>/posts/add" class="my-btn btn-primary float-right "><i class="fas fa-pencil-alt"></i> Add Post</a>
        </div>
    </div>

        <?php foreach($data['posts'] as $post): ?>
            <div class="card mr-4">
                <div class="card-body mb-3">
                    <!-- title -->
                    <span class="card-title post-title"><b><?php echo $post->title; ?></b></span><br>
                    <!-- author -->
                    <small class="card-subtitle text-muted">Written by: </small>
                    <small class="card-subtitle text-success"><?php echo $post->name; ?> </small> 
                    <!-- created_at -->
                    <small class="card-subtitle text-muted"> at <?php echo $post->postCreated; ?></small>
                    <!-- post body -->
                    <p class="card-text mt-3 text-justify"><?php echo $post->body; ?></p>
                    <a href="<?php echo URLROOT; ?>/posts/show/<?php echo $post->postId; ?>" class="btn my-outline-btn float-right">Read More</a>
                </div>
            </div>
        <?php endforeach; ?>
    
<?php require APPROOT . '/views/inc/footer.php' ?>