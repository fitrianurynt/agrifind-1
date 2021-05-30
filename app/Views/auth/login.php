<?= $this->extend('/layout/template_out'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mt-5 mb-3 justify-content-center">
    <div class="col-6 ">
      <h1 class="mb-4">Log In</h1>

      <?php if (session()->getFlashdata('success_account')) : ?>
        <?= session()->getFlashdata('success_account'); ?>
      <?php endif; ?>

      <form action="/auth/loginAccount" method="post">
        <?= csrf_field(); ?>

        <!-- email / username -->
        <label for="username" class="form-label">Email</label>
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control <?= ($validation->hasError('username') ? 'is-invalid' : ''); ?>" id="username" placeholder="Email" value="<?= old('username'); ?>" autofocus>
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
            <a class="float-end" href="/auth/forgot">Forgot password?</a>
          </div>
        </div>



        <button type="submit" class="btn btn-primary float-end">Log In</button>

      </form>



    </div>

  </div>
  <div class="row justify-content-center">
    <div class="col-6 ">
      Dont have an account? <a href="/auth/signup">Sign Up</a>
    </div>

  </div>

</div>

<?= $this->endSection(); ?>