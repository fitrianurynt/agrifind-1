<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container mb-5">
  <div class="row mt-5">
    <div class="col-2">
      <div class="card border-success mb-5">
        <div class="card-body text-white bg-success">
          <div class="card-title ">
            <h1>Message</h1>
          </div>
          <div class="card-text">
            Halo
          </div>
        </div>

        <ul class="list-group list-group-flush">
          <a href="/message">
            <li class="list-group-item">Receive</li>
          </a>
          <a href="/message/send">
            <li class="list-group-item active">Sent</li>
          </a>
        </ul>
      </div>
    </div>

    <div class="col-1">
    </div>

    <div class="col-9">
      <div class="row">
        for search and all later

      </div>
      <div class="row">


        <table class="table table-hover align-middle">
          <thead>
            <col style="width: 5%;">
            <col style="width: 50%;">
            <col style="width: 30%;">
            <col style="width: 15%;">

            <tr class="table-dark">
              <th scope="col">#</th>
              <th scope="col">Subject</th>
              <th scope="col">To</th>
              <th scope="col">Time</th>
            </tr>
          </thead>
          <tbody>

            <!-- table content -->
            <?php $i = 1 ?>
            <?php foreach ($message as $m) : ?>
              <tr data-bs-toggle="collapse" data-bs-target="#message<?= $m['id']; ?>">
                <th scope="row"><?= $i++; ?></th>
                <td class="table-secondary"><?= $m['subject']; ?></td>
                <td><?= $m['receiver_name']; ?></td>
                <td><?= gmdate("d M - H:i", $m['created_at']); ?></td>
              </tr>

              <?php if ($m['message'] != '') : ?>
                <tr class="collapse table-secondary" id="message<?= $m['id']; ?>">
                  <td></td>
                  <td colspan="2" scope="row"><?= $m['message']; ?></td>
                  <td><a href="/message/deleteSender/<?= $m['id']; ?>" class="btn btn-danger btn-sm float-end"><i class="bi bi-trash-fill"></i></a></td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>