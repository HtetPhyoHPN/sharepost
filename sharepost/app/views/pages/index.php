<?php require APPROOT . '/views/inc/header.php' ?>
<div class="title-and-intro-in-index">
    <img src="<?php echo URLROOT; ?>/assets/img/home.jpg" alt="Newspaper" class="img-fluid img-in-home">
    <h1><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    <div class="row">
        <a href="<?php echo URLROOT; ?>/users/login" class="my-btn">Login</a>
        <a href="<?php echo URLROOT; ?>/users/register" class="my-btn">Register</a>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php' ?>