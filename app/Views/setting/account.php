<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mb-5">
  <div class="row mt-5">
    <div class="col-2">
      <?= $this->include('/layout/navbar_setting'); ?>
    </div>

    <div class="col-1">

    </div>

    <div class="col-6">
      <div class="row">
        <h1 class="mb-4">Account Setting</h1>




        <form action="/setting/editPassword" method="POST">
          <?= csrf_field(); ?>

          <h3 class="mb-3">Change Password</h3>

          <?php if (session()->getFlashdata('setting_message')) : ?>
            <?= session()->getFlashdata('setting_message'); ?>
          <?php endif; ?>

          <div class="mb-5">
            <label for="password" class="form-label">Old Password</label>
            <input name="password" type="text" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" id="password" placeholder="Old Password">

            <div class="invalid-feedback">
              <?= $validation->getError('password'); ?>
            </div>
          </div>

          <div class="mb-2">
            <label for="passnew" class="form-label">New Password</label>
            <input name="passnew" type="text" class="form-control <?= ($validation->hasError('passnew') ? 'is-invalid' : ''); ?>" id="passnew" placeholder="New Password">

            <div class="invalid-feedback">
              <?= $validation->getError('passnew'); ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="passconf" class="form-label">Confirm New Password</label>
            <input name="passconf" type="text" class="form-control <?= ($validation->hasError('passconf') ? 'is-invalid' : ''); ?>" id="passconf" placeholder="Confirm New Password">

            <div class="invalid-feedback">
              <?= $validation->getError('passconf'); ?>
            </div>
          </div>

          <div class="d-flex justify-content-end mb-4">
            <button type="submit" class="btn btn-success d-flex justify-content-end">Change</button>
          </div>

        </form>


        <hr>

        <h3 class="mt-4">Delete Account</h3>
        <p class="mb-3 text-muted">Permanently delete your account and all the data in it.</p>

        <?php if (session()->getFlashdata('delete_message')) : ?>
            <?= session()->getFlashdata('delete_message'); ?>
          <?php endif; ?>

        <form action="/setting/deleteAccount" method="POST">

          <div class="mb-5">
            <label for="passdel" class="form-label">Password</label>
            <input name="passdel" type="text" class="form-control <?= ($validation->hasError('passdel') ? 'is-invalid' : ''); ?>" id="passdel" placeholder="Password">

            <div class="invalid-feedback">
              <?= $validation->getError('passdel'); ?>
            </div>
          </div>

          <div class="d-flex justify-content-end mb-4">
            <button type="submit" class="btn btn-danger d-flex justify-content-end" onclick="confirm('Your account will be permanently deleted. Are you sure you want to delete your account?')">Delete</button>
          </div>

        </form>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>


<script>

</script>