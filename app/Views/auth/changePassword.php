<?= $this->extend('/layout/template_out'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <div class="row mt-5 mb-3 justify-content-center">
    <div class="col-6 ">
      <h1 class="mb-4">Change password</h1>

      <form action="/auth/confirmPassword" method="post">
        <?= csrf_field(); ?>

        <input type="hidden" name="email" value="<?= $email; ?>">
        <input type="hidden" name="token" value="<?= $token; ?>">

        <!-- email / username -->
        <label for="username" class="form-label">Email</label>
        <div class="input-group mb-3">
          <input name="username" type="text" class="form-control" id="username" placeholder="Email" value="<?= $user['username'] ?>" disabled readonly>
          <span class="input-group-text" id="basic-addon2">@apps.ipb.ac.id</span>
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

        <button type="submit" class="btn btn-primary float-end">Change</button>

      </form>
    </div>
  </div>
</div>

<?= $this->endSection(); ?>