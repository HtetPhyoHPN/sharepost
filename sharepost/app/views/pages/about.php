<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="title-and-intro-in-index">
    <h1><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    <p>Version: <strong class="version-in-about"><?php echo APPVERSION; ?></strong></p>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>