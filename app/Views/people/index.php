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
              <input onClick="this.select();" type="text" class="form-control" placeholder="Search People..." name="keyword" value="<?= $keyword; ?>" autofocus>
              <button class="btn btn-secondary" type="submit" name="submit">Search</button>
            </div>
          </form>
        </div>


      </div>
      <div class="row">


        <table class="table table-hover table-sm align-middle">
          <thead>
            <!-- <col style="width: 5%;"> -->
            <col style="width: 5%;">
            <col style="width: 25%;">
            <col style="width: 15%;">
            <col style="width: 10%;">
            <col style="width: 25%;">
            <col style="width: 20%;">
            <tr>
              <th scope="col" colspan="7"></th>
              <!-- <th scope="col"></th>
              <th scope="col">Name</th>
              <th scope="col">NIM</th>
              <th scope="col">Batch</th>
              <th scope="col">Department</th>
              <th scope="col">Status</th> -->
            </tr>
          </thead>
          <tbody>

            <!-- table content -->
            <?php $i = 1 + (25 * ($currentPage - 1)) ?>
            <?php foreach ($user as $u) : ?>
              <tr onclick="window.location='/profile/view/<?= $u['username']; ?>'">
                <!-- <th scope="row"><?= $i++; ?></th> -->
                <td><img src="/img/avatar/<?= $u['avatar']; ?>" style="width: 25px;
                  height: 25px;
                  background-position: center center;
                  background-repeat: no-repeat;
                  object-fit:cover;">
                </td>
                <td><?= $u['name']; ?></td>
                <td><?= $u['nim']; ?></td>
                <td><?= $u['batch']; ?></td>
                <td><?= $u['department']; ?></td>
                <td>
                  <?php if ($u['availability'] == 'Available') : ?>
                    <span class="badge rounded-pill bg-success"><?= $u['availability']; ?></span>
                  <?php elseif (($u['availability'] == 'Unavailable')) : ?>
                    <span class="badge rounded-pill bg-danger"><?= $u['availability']; ?></span>
                  <?php elseif (($u['availability'] == 'Do Not Disturb')) : ?>
                    <span class="badge rounded-pill bg-warning"><?= $u['availability']; ?></span>
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