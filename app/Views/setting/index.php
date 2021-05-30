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
        <h1 class="mb-4">General Setting</h1>

        <?php if (session()->getFlashdata('setting_message')) : ?>
          <?= session()->getFlashdata('setting_message'); ?>
        <?php endif; ?>

        <form action="/setting/editGeneral" method="POST" enctype="multipart/form-data">
          <?= csrf_field(); ?>
          <input type="hidden" name="hiddenCV" value="<?= $user['cv']; ?>">

          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input name="name" type="text" class="form-control <?= ($validation->hasError('name') ? 'is-invalid' : ''); ?>" id="name" placeholder="Name" value="<?= ($validation->hasError('name') ? old('name') : $user['name']); ?>">

            <div class="invalid-feedback">
              <?= $validation->getError('name'); ?>
            </div>

          </div>

          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input name="username" type="text" class="form-control" id="username" placeholder="username" value="<?= $user['username']; ?>" disabled readonly>
          </div>

          <div class="mb-3">
            <label for="nim" class="form-label">NIM</label>
            <input name="nim" type="text" class="form-control <?= ($validation->hasError('nim') ? 'is-invalid' : ''); ?>" id="nim" placeholder="NIM" value="<?= ($validation->hasError('nim') ? old('nim') : $user['nim']); ?>">

            <div class="invalid-feedback">
              <?= $validation->getError('nim'); ?>
            </div>
          </div>

          <div class="mb-3">
            <label for="batch" class="form-label">Batch</label>
            <input name="batch" type="number" min=0 class="form-control" id="batch" placeholder="batch" value="<?= $user['batch']; ?>">
          </div>


          <legend for="radio-avail" class="col-form-label col-sm-2 pt-0">Availability</legend>
          <fieldset class="mb-4">
            <div class="btn-group mb-3" role="group" id="radio-avail">
              <input type="radio" class="btn-check" name="availability" id="success-outlined" autocomplete="off" value="Available" <?= ($user['availability'] == 'Available') ? 'checked' : ''; ?>>
              <label class="btn btn-outline-success" for="success-outlined">Available</label>

              <input type="radio" class="btn-check" name="availability" id="danger-outlined" autocomplete="off" value="Unavailable" <?= ($user['availability'] == 'Unavailable') ? 'checked' : ''; ?>>
              <label class="btn btn-outline-danger" for="danger-outlined">Unavailable</label>

              <input type="radio" class="btn-check" name="availability" id="warning-outlined" autocomplete="off" value="Do Not Disturb" <?= ($user['availability'] == 'Do Not Disturb') ? 'checked' : ''; ?>>
              <label class="btn btn-outline-warning" for="warning-outlined">Do Not Disturb</label>

            </div>
          </fieldset>

          <hr>

          <h3 class="mt-4">Faculty and Department</h3>
          <p class="mb-3 text-muted">Faculty and Departments depends on your NIM</p>

          <div class="mb-3">
            <label for="faculty" class="form-label">Faculty</label>
            <input name="faculty" type="text" class="form-control" id="faculty" placeholder="Faculty" value="<?= $user['faculty'] ?>" disabled readonly>
          </div>

          <div class="mb-4">
            <label for="department" class="form-label">Department</label>
            <input name="department" type="text" class="form-control" id="department" placeholder="Department" value="<?= $user['department'] ?>" disabled readonly>
          </div>

          <hr>

          <h3 class="mt-4">Curriculum Vitae / Resume</h3>
          <p class="mb-3 text-muted">Describe yourself to others!</p>

          <div class="row mb-4">
            <div class="col-2">
              <label for="cv" class="form-label">Curriculum Vitae</label>
            </div>
            <div class="col">
              <div class="input-group mb-3">
                <label class="input-group-text" for="cv"><i class="bi bi-card-image"></i></label>
                <input name="cv" type="file" class="form-control <?= ($validation->hasError('cv') ? 'is-invalid' : ''); ?>" id="cv">
                <a href="/setting/deleteCV" class="btn btn-danger"><i class="bi bi-x-lg"></i></a>

                <div class="invalid-feedback">
                  <?= $validation->getError('cv'); ?>
                </div>
              </div>
            </div>
          </div>

          <hr>

          <h3 class="mt-4">About Me</h3>
          <p class="mb-3 text-muted">Describe yourself to others!</p>



          <div class="mb-3">
            <label for="about_me" class="form-label">About Me</label>
            <textarea name="about_me" type="text" class="form-control" id="about_me" placeholder="About Me"><?= $user['about_me'] ?></textarea>
            <div id="about_me_max" class="form-text">Max. 256 characters</div>
          </div>

          <div class="d-flex justify-content-end mt-4">
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