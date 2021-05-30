<?= $this->extend('/layout/template_out'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mt-5 mb-3 justify-content-center">
    <div class="col-6 ">
      <h1 class="mb-4">Set Up Your Profile</h1>

      <?php if (session()->getFlashdata('success_account')) : ?>
        <?= session()->getFlashdata('success_account'); ?>
      <?php endif; ?>

      <form action="/profile/setupAccount" method="post">
        <?= csrf_field(); ?>

        <!-- name -->
        <div class="col mb-3">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" class="form-control" id="password" value="<?= $user['name']; ?>" disabled readonly>
        </div>
        <!-- username -->
        <div class="col mb-3">
          <label for="username" class="form-label">Username</label>
          <input name="username" type="text" class="form-control" id="password" value="<?= $user['username']; ?>" disabled readonly>
        </div>
        <!-- nim -->
        <div class="mb-3">
          <label for="nim" class="form-label">NIM</label>
          <input name="nim" type="text" class="form-control <?= ($validation->hasError('nim') ? 'is-invalid' : ''); ?>" id="nim" placeholder="NIM" value="<?= old('nim'); ?>" autofocus>

          <div class="invalid-feedback">
            <?= $validation->getError('nim'); ?>
          </div>
        </div>
        <!-- nim -->
        <div class="mb-3">
          <label for="batch" class="form-label">Batch</label>
          <input name="batch" type="number" min=0 class="form-control <?= ($validation->hasError('batch') ? 'is-invalid' : ''); ?>" id="batch" placeholder="Batch" value="<?= old('batch'); ?>">

          <div class="invalid-feedback">
            <?= $validation->getError('batch'); ?>
          </div>
        </div>



        <button type="submit" class="btn btn-primary float-end">Finish</button>

      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>