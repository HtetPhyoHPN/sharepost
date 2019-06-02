<?php require APPROOT . '/views/inc/header.php' ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="mt-1 title-and-intro-in-index">
            <?php echo flash('register_success'); ?>
                <h4 class="display-6 text-center">Login</h4>
                <p>Please fill out this form to login.</p>
                <form action="<?php echo URLROOT; ?>/users/login" method="POST">
                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email: <sup>*</sup></label>
                        <input type="text" name="email" class="form-control form-control-sm <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>" autocomplete=off>
                        <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                    </div>
                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password: <sup>*</sup></label>
                        <input type="password" name="password" class="form-control form-control-sm <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>" autocomplete=off>
                        <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                    </div>
                    <!-- submit -->
                    <div class="row no-gutters mt-4">
                        <div class="col">
                            <input type="submit" value="Login" class="my-btn btn-block">
                        </div>
                    </div>
                    <div class="row no-gutters text-center mt-3">
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/register">Don't have an account? Create One</a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>