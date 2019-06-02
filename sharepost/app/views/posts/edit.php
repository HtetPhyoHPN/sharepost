<?php require APPROOT . '/views/inc/header.php' ?>
    <div class="row">
    <a href="<?php echo URLROOT; ?>/posts" class="btn btn-light mt-3">Back</a>
        <div class="mt-1 title-and-intro-in-index">
            <h4 class="display-6 text-center">Edit post</h4>
            <p>Share anything with anyone.</p>
            <form action="<?php echo URLROOT; ?>/posts/edit/<?php echo $data['id']; ?>" method="POST">
                <!-- Post title -->
                <div class="form-group">
                    <label for="title">Title: <sup>*</sup></label>
                    <input type="text" name="title" id="title" class="form-control form-control-sm <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                    <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                </div>
                <!-- Post body -->
                <div class="form-group">
                    <label for="body">What's on your mind?: <sup>*</sup></label>
                    <textarea name="body" id="body" class="form-control form-control-sm <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>" rows=8 cols=150 autocomplete=off><?php echo $data['body']; ?></textarea>
                    <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                </div>
                <!-- submit -->
                <div class="row no-gutters mt-4">
                    <div class="col">
                        <input type="submit" value="Update" class="my-outline-btn float-right">
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>