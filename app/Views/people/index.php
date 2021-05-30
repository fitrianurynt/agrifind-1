<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mb-5">
  <div class="row mt-5">
    <div class="col-2">
      <div class="card border-dark mb-5">
        <div class="card-body text-white bg-dark">
          <div class="card-title ">
            <h1>People</h1>
          </div>
          <div class="card-text">
            Halo


          </div>
        </div>
      </div>

      <form action="">
        <input type="text">
      </form>

    </div>

    <div class="col-1">

    </div>

    <div class="col-9">
      <div class="row">
        <div class="col-6">
          <?= $pager->links('user_data', 'people_pagination'); ?>

        </div>

        <div class="col">
          <form action="" method="get">
            <div class="input-group mb-3">
              <input onClick="this.select();" type="text" class="form-control" placeholder="Search People..." name="keyword" value="<?= $keyword; ?>">
              <button class="btn btn-secondary" type="submit" name="submit">Search</button>
            </div>
          </form>
        </div>


      </div>
      <div class="row">


        <table class="table table-hover align-middle">
          <thead>
            <col style="width: 5%;">
            <col style="width: 5%;">
            <col style="width: 35%;">
            <col style="width: 20%;">
            <col style="width: 15%;">
            <col style="width: 20%;">
            <col style="width: 20%;">
            <tr>
              <th scope="col">#</th>
              <th scope="col"></th>
              <th scope="col">Name</th>
              <th scope="col">NIM</th>
              <th scope="col">Batch</th>
              <th scope="col">Department</th>
              <th scope="col">Status</th>
            </tr>
          </thead>
          <tbody>

            <!-- table content -->
            <?php $i = 1 + (2 * ($currentPage - 1)) ?>
            <?php foreach ($user as $u) : ?>
              <tr onclick="window.location='/profile/view/<?= $u['username']; ?>'">
                <th class="align-middle" scope="row"><?= $i++; ?></th>
                <td class="align-middle"><img src="/img/avatar/<?= $u['avatar']; ?>" style="width: 30px;
                  height: 30px;
                  background-position: center center;
                  background-repeat: no-repeat;
                  object-fit:cover;">
                </td>
                <td class="align-middle"><?= $u['name']; ?></td>
                <td class="align-middle"><?= $u['nim']; ?></td>
                <td class="align-middle"><?= $u['batch']; ?></td>
                <td class="align-middle"><?= $u['department']; ?></td>
                <td class="align-middle">
                  <?php if ($u['availability'] == 'Available') : ?>
                    <p class="badge bg-success"><?= $u['availability']; ?></p>
                  <?php elseif (($u['availability'] == 'Unavailable')) : ?>
                    <p class="badge bg-danger"><?= $u['availability']; ?></p>
                  <?php elseif (($u['availability'] == 'Do Not Disturb')) : ?>
                    <p class="badge bg-warning"><?= $u['availability']; ?></p>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
            </tr>
          </tbody>
        </table>



      </div>
    </div>

  </div>
</div>


<?= $this->endSection(); ?>


<script>

</script>