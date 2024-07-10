<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Register</h2>
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <form action="<?= base_url('auth/register') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
            <div class="form-group mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control <?= (isset($validation) && $validation->hasError('email')) ? 'is-invalid' : '' ?>" id="email" name="email"  placeholder="Email" value="<?= old('email') ?>">

                <?php if (isset($validation) && $validation->hasError('email')): ?>
            <div class="invalid-feedback"><?= $validation->getError('email') ?></div>
        <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control  <?= (isset($validation) && $validation->hasError('username')) ? 'is-invalid' : '' ?> " id="username" name="username"  placeholder="Username" value="<?= old('username') ?>">
                <?php if (isset($validation) && $validation->hasError('username')): ?>
            <div class="invalid-feedback"><?= $validation->getError('username') ?></div>
        <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control <?= (isset($validation) && $validation->hasError('password')) ? 'is-invalid' : '' ?>" id="password" name="password"  placeholder="Password" >
                <?php if (isset($validation) && $validation->hasError('password')): ?>
            <div class="invalid-feedback"><?= $validation->getError('password') ?></div>
        <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label for="password">Confirm Password:</label>
                <input type="password" class="form-control <?= (isset($validation) && $validation->hasError('confirm_password')) ? 'is-invalid' : '' ?>" id="confirm_password" name="confirm_password"  placeholder="Confirm Password" >
                <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
            <div class="invalid-feedback"><?= $validation->getError('confirm_password') ?></div>
        <?php endif; ?>
            </div>
            <div class="form-group mb-3">
                <label for="image">Profile Image</label>
                <input type="file" class="form-control  <?= (isset($validation) && $validation->hasError('image')) ? 'is-invalid' : '' ?>" id="image" name="image"  placeholder="Image" >

                <?php if (isset($validation) && $validation->hasError('image')): ?>
            <div class="invalid-feedback"><?= $validation->getError('image') ?></div>
        <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
