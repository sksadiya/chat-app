<?= $this->extend('layouts/app') ?>
<?= $this->section('title') ?> Dashboard  <?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="card">
        <div class="card-header">User</div>
        <div class="card-body">
          <img src="<?= base_url('images/'. $user->user_image) ?>" class="img-fluid" alt="..."> <br>
          Name : <?php echo $user->username; ?> <br>
          Email : <?php echo $user->email; ?> <br>


        </div>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
