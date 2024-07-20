<?php $this->load->view('layout/header') ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>
                <div class="card-body">
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div class="col-12 mb-4">
                            <div class="alert alert-danger alert-dismissible fade show bg-danger rounded-md px-4 text-white" role="alert">
                                <div class="d-flex justify-content-between items-content-center">
                                    <p class="justify-content-center">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </p>
                                    <button type="button" class="btn-close justify-content-end " data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="<?= site_url('Auth/login') ?>">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="username" class="form-control" name="username" id="username" placeholder="Enter your username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <small>&copy; 2024 Your Company</small>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and Popper.js -->
<?php $this->load->view('layout/script') ?>
</body>

</html>