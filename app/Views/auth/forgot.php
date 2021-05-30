<?= $this->extend('/layout/template_out'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mt-5 mb-3 justify-content-center">
    <div class="col-6 ">
      <h1 class="mb-4">Forgot Password</h1>

      <?php if (session()->getFlashdata('forgot_message')) : ?>
        <?= session()->getFlashdata('forgot_message'); ?>
      <?php endif; ?>

      <form action="/auth/forgotPassword" method="post">
        <?= csrf_field(); ?>

        <!-- email / username -->
        <label for="username" class="form-label">Email</label>
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" id="username" placeholder="Email" value="<?= old('username'); ?>">
          <span class="input-group-text" id="basic-addon2">@apps.ipb.ac.id</span>

          <div class="invalid-feedback">
            <?= $validation->getError('username'); ?>
          </div>
        </div>


        <button type="submit" class="btn btn-primary float-end">Send</button>

      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>