<?php require APPROOT . '/views/inc/header.php' ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="mt-1 title-and-intro-in-index">
                <h4 class="display-6 text-center">Create An Account</h4>
                <p>Please fill out this form to register with us.</p>
                <form action="<?php echo URLROOT; ?>/users/register" method="POST">
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name">Name: <sup>*</sup></label>
                        <input type="text" name="name" class="form-control form-control-sm <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name']; ?>" autocomplete=off>
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
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
                    <!-- Confirm Password -->
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password: <sup>*</sup></label>
                        <input type="password" name="confirm_password" class="form-control form-control-sm <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirm_password']; ?>" autocomplete=off>
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>
                    <!-- submit -->
                    <div class="row no-gutters mt-4">
                        <div class="col">
                            <input type="submit" value="Register" class="my-btn btn-block">
                        </div>
                    </div>
                    <div class="row no-gutters text-center mt-3">
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/users/login" class="">Have an account? Login</a>
                        </div>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php' ?>