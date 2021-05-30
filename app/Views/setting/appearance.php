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
        <h1 class="mb-4">Appearance Setting</h1>

        <?php if (session()->getFlashdata('setting_message')) : ?>
          <?= session()->getFlashdata('setting_message'); ?>
        <?php endif; ?>

        <form action="/setting/editAppearance" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="hiddenAvatar" value="<?= $user['avatar']; ?>">
          <input type="hidden" name="hiddenHeader" value="<?= $user['header']; ?>">

          <?= csrf_field(); ?>

          <div class="row mb-5">
            <div class="col-2">
              <label for="avatar" class="form-label">Avatar</label>
            </div>
            <div class="col">
              <div class="input-group mb-3">
                <label class="input-group-text" for="avatar"><i class="bi bi-person-fill"></i></label>
                <input name="avatar" type="file" class="form-control <?= ($validation->hasError('avatar') ? 'is-invalid' : ''); ?>" id="avatar">
                <button class="btn btn-danger" type="button"><i class="bi bi-x-lg"></i></button>

                <div class="invalid-feedback">
                  <?= $validation->getError('avatar'); ?>
                </div>
              </div>
              <img src="/img/avatar/<?= $user['avatar']; ?>" class="img-thumbnail" width="100px" height="200px">
            </div>
          </div>

          <div class="row">
            <div class="col-2">
              <label for="header" class="form-label">Header</label>
            </div>
            <div class="col">
              <div class="input-group mb-3">
                <label class="input-group-text" for="header"><i class="bi bi-card-image"></i></label>
                <input name="header" type="file" class="form-control <?= ($validation->hasError('header') ? 'is-invalid' : ''); ?>" id="header">
                <button class="btn btn-danger" type="button"><i class="bi bi-x-lg"></i></button>

                <div class="invalid-feedback">
                  <?= $validation->getError('header'); ?>
                </div>
              </div>
              <img src="/img/header/<?= $user['header']; ?>" class="img-thumbnail" width="100px" height="200px">
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success d-flex justify-content-end">Save Change</button>
          </div>


        </form>


      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>


<script>

</script>