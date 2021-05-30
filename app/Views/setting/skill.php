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
      <h1 class="mb-4">Skill Setting</h1>

      <?php if (session()->getFlashdata('setting_message')) : ?>
        <?= session()->getFlashdata('setting_message'); ?>
      <?php endif; ?>

      Total : <?= count($skill); ?>

      <!-- Button trigger modal -->
      <button type="button" class="btn btn-primary float-end mb-3 btn-sm" data-bs-toggle="modal" data-bs-target="#addSkill">
        <i class="bi bi-plus-lg"></i>
      </button>

      <table class="table table-hover align-middle table-fit">
        <thead>
          <col style="width: 10%;">
          <col style="width: 20%;">
          <col style="width: 50%;">
          <col style="width: 20%;">
          <tr class="table-dark">
            <th scope="col">#</th>
            <th scope="col">Skill</th>
            <th scope="col">Level</th>
            <th scope="col">Action</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1 ?>

          <?php foreach ($skill as $s) : ?>

            <tr>
              <th scope="row"><?= $i++; ?></th>
              <th scope="row"><?= $s['name']; ?></th>
              <th scope="row">
                <div class="progress">
                  <div class="progress-bar" role="progressbar" style="width: <?= $s['level'] * 10; ?>%;" aria-valuenow="<?= $s['level']; ?>" aria-valuemin="0" aria-valuemax="20"><?= $s['level']; ?></div>
                </div>
              </th>

              <th scope="row">
                <a class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editSkill<?= $s['id'] ?>"><i class="bi bi-pencil-square"></i></a>
                <a class="btn btn-danger btn-sm" href="/setting/deleteSkill/<?= $s['id']; ?>" onclick="return confirm('Delete skill?');"><i class="bi bi-trash-fill"></i></a>
              </th>
            </tr>


            <!-- Modal Edit Skill -->
            <div class="modal fade" id="editSkill<?= $s['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Skill [<?= $s['name']; ?>]</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                    <form action="/setting/editSkill/<?= $s['id']; ?>" method="POST">
                      <div class="mb-3">
                        <label for="skillName" class="form-label">Skill Name</label>
                        <input name="nameSkillEdit" type="text" class="form-control" id="skillName" placeholder="Name" value="<?= $s['name']; ?>">
                      </div>
                      <div class="mb-3">
                        <label for="skillLevel" class="form-label">Level</label>
                        <input name="levelSkillEdit" type="number" min="0" max="10" step="0.5" class="form-control" id="skillLevel" placeholder="Level" value="<?= $s['level']; ?>">
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit</button>
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
<div class="modal fade" id="addSkill" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Skill</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">

        <form action="/setting/addSkill" method="POST">
          <div class="mb-3">
            <label for="skillName" class="form-label">Skill Name</label>
            <input name="nameSkill" type="text" class="form-control" id="skillName" placeholder="Name">
          </div>
          <div class="mb-3">
            <label for="skillLevel" class="form-label">Level</label>
            <input name="levelSkill" type="number" min="0" max="10" step="0.5" class="form-control" id="skillLevel" placeholder="Level">
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