<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?> Login  <?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Login</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>
        <form action="<?= base_url('auth/log') ?>" method="post">
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email" >
                <?php if (isset($validation) && $validation->hasError('email')): ?>
            <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password" >
                <?php if (isset($validation) && $validation->hasError('password')): ?>
            <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
        <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
