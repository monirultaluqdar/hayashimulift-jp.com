<?php 



template_include("/backend/partials/header");



?>



<?php 



template_include("/backend/partials/sidebar");



?>
<main>

<div class="container-fluid">

    
    <div class="row justify-content-center mt-3">
        <div class="col-lg-12">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="card-title mb-0">Change Your Password</h5>
                </div>
                <div class="card-body">
                    <?php if(session_get('errors')): ?>
                        <div class="alert alert-danger">
                            <?php foreach(session_get('errors') as $error): ?>
                                <p class="mb-1"><?= $error ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if(session_get('success')): ?>
                        <div class="alert alert-success">
                            <p class="mb-0"><?= session_get('success') ?></p>
                        </div>
                    <?php endif; ?>

                    <form action="/admin/password/update" method="post">
                        <div class="mb-3">
                            <label for="inputOldPassword" class="form-label">Old Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputOldPassword" name="old_password" required />
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('inputOldPassword', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="inputNewPassword" class="form-label">New Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputNewPassword" name="new_password" required />
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('inputNewPassword', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            <small class="form-text text-muted">Password must be at least 6 characters long.</small>
                        </div>
                        
                        <div class="mb-3">
                            <label for="inputConfirmPassword" class="form-label">Confirm Password</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="inputConfirmPassword" name="confirm_password" required />
                                <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('inputConfirmPassword', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="/admin/dashboard" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Update Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

                    </main>
<?php



template_include("/backend/partials/footer");



?>
<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
