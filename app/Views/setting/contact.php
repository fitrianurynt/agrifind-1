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
        <h1 class="mb-4">Contact Info Setting</h1>

        <?php if (session()->getFlashdata('setting_message')) : ?>
          <?= session()->getFlashdata('setting_message'); ?>
        <?php endif; ?>

        <form action="/setting/editContact" method="POST">
          <?= csrf_field(); ?>

          <label for="website" class="form-label">Website</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="website"><i class="bi bi-globe2"></i></span>
            <input name="website" type="text" class="form-control" placeholder="Website" value="<?= $contact['website']; ?>">
            <button class="btn btn-danger" onclick="website.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="phone" class="form-label">Phone</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="phone"><i class="bi bi-telephone-fill"></i></span>
            <input name="phone" type="text" class="form-control" placeholder="Phone" value="<?= $contact['phone']; ?>">
            <button class="btn btn-danger" onclick="phone.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="mail" class="form-label">Mail</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="mail"><i class="bi bi-envelope-fill"></i></span>
            <input name="mail" type="text" class="form-control" placeholder="Mail" value="<?= $contact['mail']; ?>">
            <button class="btn btn-danger" onclick="mail.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="whatsapp" class="form-label">WhatsApp</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="whatsapp"><i class="bi bi-whatsapp"></i></span>
            <input name="whatsapp" type="text" class="form-control" placeholder="WhatsApp" value="<?= $contact['whatsapp']; ?>">
            <button class="btn btn-danger" onclick="whatsapp.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="twitter" class="form-label">Twitter</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="twitter"><i class="bi bi-twitter"></i></span>
            <input name="twitter" type="text" class="form-control" placeholder="Twitter" value="<?= $contact['twitter']; ?>">
            <button class="btn btn-danger" onclick="twitter.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="instagram" class="form-label">Instagram</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="instagram"><i class="bi bi-instagram"></i></span>
            <input name="instagram" type="text" class="form-control" placeholder="Instagram" value="<?= $contact['instagram']; ?>">
            <button class="btn btn-danger" onclick="instagram.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="facebook" class="form-label">Facebook</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="facebook"><i class="bi bi-facebook"></i></span>
            <input name="facebook" type="text" class="form-control" placeholder="Facebook" value="<?= $contact['facebook']; ?>">
            <button class="btn btn-danger" onclick="facebook.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="linkedin" class="form-label">Linkedin</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="linkedin"><i class="bi bi-linkedin"></i></span>
            <input name="linkedin" type="text" class="form-control" placeholder="Linkedin" value="<?= $contact['linkedin']; ?>">
            <button class="btn btn-danger" onclick="linkedin.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="reddit" class="form-label">Reddit</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="reddit"><i class="bi bi-reddit"></i></span>
            <input name="reddit" type="text" class="form-control" placeholder="Reddit" value="<?= $contact['reddit']; ?>">
            <button class="btn btn-danger" onclick="reddit.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>

          <label for="github" class="form-label">GitHub</label>
          <div class="input-group mb-3">
            <span class="input-group-text" id="github"><i class="bi bi-github"></i></span>
            <input name="github" type="text" class="form-control" placeholder="GitHub" value="<?= $contact['github']; ?>">
            <button class="btn btn-danger" onclick="github.value=''" type="button"><i class="bi bi-x-lg"></i></button>
          </div>


          <div class="d-flex justify-content-end mt-5">
            <button type="submit" class="btn btn-primary d-flex justify-content-end">Save Change</button>
          </div>


        </form>


      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>


<script>

</script>