<?php include "header.php"; ?>

<div class="container-fluid h-custom" style="padding-top: 150px;">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
            <form>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3">Email address</label>
                    <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Enter a valid email address" />
                </div>

                <div class="d-flex justify-content-between align-items-center">
                    <!-- Checkbox -->
                    <div class="form-check mb-0">
                        <label class="form-check-label" for="form2Example3">
                            A password reset link will be sent to your email.
                        </label>
                    </div>
                </div>

                <div class="divider d-flex align-items-center my-4">
                </div>

                <div class="text-center text-lg-start mt-4 pt-2">
                    <button type="button" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Reset Password</button>
                </div>

            </form>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>