<?= $this->extend('/layout/template_out'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mt-5 mb-3 justify-content-center">
    <div class="col-6 ">
      <h1 class="mb-4">Sign Up</h1>

      <?php if (session()->getFlashdata('success_account')) : ?>
        <?= session()->getFlashdata('success_account'); ?>
      <?php endif; ?>

      <form action="/auth/registration" method="post">
        <?= csrf_field(); ?>
        <!-- name -->
        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input name="name" type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : ''); ?>" id="name" placeholder="Name" value="<?= old('name'); ?>" autofocus>

          <div class="invalid-feedback">
            <?= $validation->getError('name'); ?>
          </div>
        </div>

        <!-- email / username -->
        <label for="username" class="form-label">Email</label>
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" id="username" placeholder="Email" value="<?= old('username'); ?>">
          <span class="input-group-text" id="basic-addon2">@apps.ipb.ac.id</span>

          <div class="invalid-feedback">
            <?= $validation->getError('username'); ?>
          </div>
        </div>

        <!-- password -->
        <div class="row">
          <div class="col mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password" class="form-control <?= ($validation->hasError('password') ? 'is-invalid' : ''); ?>" id="password" placeholder="Password">

            <div class="invalid-feedback">
              <?= $validation->getError('password'); ?>
            </div>
          </div>
          <div class="col mb-3">
            <label for="passconf" class="form-label">Confirm Password</label>
            <input name="passconf" type="password" class="form-control <?= ($validation->hasError('passconf') ? 'is-invalid' : ''); ?>" id="passconf" placeholder="Password">

            <div class="invalid-feedback">
              <?= $validation->getError('passconf'); ?>
            </div>
          </div>
        </div>

        <!-- term and condition -->
        <div class="form-check mb-3">
          <input name="termcond" class="form-check-input <?= ($validation->hasError('termcond') ? 'is-invalid' : ''); ?>" type="checkbox" id="termcond" name="termcond">
          <label class="form-check-label" for="termcond">
            I agree to the Agrifind term and condition.
          </label>

          <div class="invalid-feedback">
            <?= $validation->getError('termcond'); ?>
          </div>


        </div>


        <button type="submit" class="btn btn-primary float-end">Sign Up</button>

      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>