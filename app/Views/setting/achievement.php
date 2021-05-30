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
      <h1 class="mb-4">Achievement Setting</h1>

      <?php if (session()->getFlashdata('setting_message')) : ?>
        <?= session()->getFlashdata('setting_message'); ?>
      <?php endif; ?>

      Total : <?= count($achieve); ?>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary float-end mb-3 btn-sm" data-bs-toggle="modal" data-bs-target="#addAchieve">
        <i class="bi bi-plus-lg"></i>
      </button>

      <table class="table table-hover align-middle table-fit">
        <thead>
          <col style="width: 5%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
          <col style="width: 15%;">
          <col style="width: 20%;">
          <tr class="table-dark">
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Field</th>
            <th scope="col">Rank</th>
            <th scope="col">Organiser</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1 ?>

          <?php foreach ($achieve as $s) : ?>

            <tr>
              <th scope="row" data-bs-toggle="collapse" data-bs-target="#desc<?= $s['id']; ?>"><?= $i++; ?></th>
              <td scope="row" data-bs-toggle="collapse" data-bs-target="#desc<?= $s['id']; ?>"><b><?= $s['name']; ?></b></td>
              <td scope="row" data-bs-toggle="collapse" data-bs-target="#desc<?= $s['id']; ?>"><?= $s['field']; ?></td>
              <td scope="row" data-bs-toggle="collapse" data-bs-target="#desc<?= $s['id']; ?>"><?= $s['rank']; ?></td>
              <td scope="row" data-bs-toggle="collapse" data-bs-target="#desc<?= $s['id']; ?>"><?= $s['organiser']; ?></td>

              <td scope="row">
                <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAchieve<?= $s['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-danger btn-sm" href="/setting/deleteAchievement/<?= $s['id']; ?>" onclick="return confirm('Delete achievement?');"><i class="bi bi-trash-fill"></i></a>
              </td>
            </tr>

            <?php if ($s['description'] != '') : ?>

              <tr class="collapse" id="desc<?= $s['id']; ?>">
                <td></td>
                <td colspan="5" scope="row"><?= $s['description']; ?></td>
              </tr>

            <?php endif; ?>

            <!-- Modal -->
            <div class="modal fade" id="editAchieve<?= $s['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Achievement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                    <form action="/setting/editAchievement/<?= $s['id']; ?>" method="POST">
                      <div class="mb-3">
                        <label for="nameAchieveEdit" class="form-label">Achievement</label>
                        <input name="nameAchieveEdit" type="text" class="form-control" id="nameAchieveEdit" placeholder="Ex. Gemastik Data Minig" value="<?= $s['name']; ?>" required>
                      </div>

                      <div class="mb-3">
                        <label for="fieldAchieveEdit" class="form-label">Field</label>
                        <input name="fieldAchieveEdit" type="text" class="form-control" id="fieldAchieveEdit" placeholder="Ex. Data Mining" value="<?= $s['field']; ?>" required>
                      </div>

                      <div class="mb-3">
                        <label for="rankAchieveEdit" class="form-label">Rank</label>
                        <select name="rankAchieveEdit" id="rankAchieveEdit" class="form-select">
                          <option selected disabled>Rank</option>
                          <option value="First" <?= ($s['rank']=='First')? 'selected': ''; ?>>First (1st)</option>
                          <option value="Second" <?= ($s['rank']=='Second')? 'selected': ''; ?>>Second (2nd)</option>
                          <option value="Third" <?= ($s['rank']=='Third')? 'selected': ''; ?>>Third (3r)</option>
                          <option value="Favorite" <?= ($s['rank']=='Favorite')? 'selected': ''; ?>>Favorite</option>
                          <option value="Honorable Mention" <?= ($s['rank']=='Honorabel Mention')? 'selected': ''; ?>>Honorable Mention</option>
                          <option value="Participate" <?= ($s['rank']=='Participate')? 'selected': ''; ?>>Participate</option>
                          <option value="Ohter" <?= ($s['rank']=='Other')? 'selected': ''; ?>>Other</option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="organiserAchieveEdit" class="form-label">Organiser</label>
                        <input name="organiserAchieveEdit" type="text" class="form-control" id="organiserAchieveEdit" placeholder="Ex. Telkom" value="<?= $s['organiser']; ?>">
                      </div>

                      <div class="mb-3">
                        <label for="descriptionAchieveEdit" class="form-label">Description</label>
                        <textarea name="descriptionAchieveEdit" type="text" class="form-control" id="descriptionAchieveEdit" placeholder="Ex. Dibimbing Pak Julio"><?= $s['description']; ?></textarea>
                      </div>


                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                      </div>
                    </form>

                  </div>
                </div>
              </div>
            </div>




          <?php endforeach; ?>

        </tbody>
      </table>



    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addAchieve" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Achievement</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form action="/setting/addAchievement" method="POST">
          <div class="mb-3">
            <label for="nameAchieve" class="form-label">Achievement</label>
            <input name="nameAchieve" type="text" class="form-control" id="nameAchieve" placeholder="Ex. Gemastik Data Minig" required>
          </div>

          <div class="mb-3">
            <label for="fieldAchieve" class="form-label">Field</label>
            <input name="fieldAchieve" type="text" class="form-control" id="fieldAchieve" placeholder="Ex. Data Mining" required>
          </div>

          <div class="mb-3">
            <label for="rankAchieve" class="form-label">Rank</label>
            <select name="rankAchieve" id="rankAchieve" class="form-select">
              <option selected disabled>Rank</option>
              <option value="First">First (1st)</option>
              <option value="Second">Second (2nd)</option>
              <option value="Third">Third (3r)</option>
              <option value="Favorite">Favorite</option>
              <option value="Honorable Mention">Honorable Mention</option>
              <option value="Participate">Participate</option>
              <option value="Ohter">Other</option>
            </select>
          </div>

          <div class="mb-3">
            <label for="organiserAchieve" class="form-label">Organiser</label>
            <input name="organiserAchieve" type="text" class="form-control" id="organiserAchieve" placeholder="Ex. Telkom">
          </div>

          <div class="mb-3">
            <label for="descriptionAchieve" class="form-label">Description</label>
            <textarea name="descriptionAchieve" type="text" class="form-control" id="descriptionAchieve" placeholder="Ex. Dibimbing Pak Julio"></textarea>
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>






<?= $this->endSection(); ?>