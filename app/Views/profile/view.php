<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
  <!-- header -->
  <img class="" width="200px" src="/img/header/<?= $user['header']; ?>" alt="" style="object-fit:cover; width: 100%; height: 200px;">

  <div class="row mt-5 mb-3">
    <div class="col-9">
      <div class="row">
        <div class="col">
          <h1 class="">Profile <?= $user['name']; ?></h1>
        </div>
        <div class="col">
          <div class="float-end">
            <?php if ($user['cv']) : ?>
              <a class="btn btn-primary" href="/docs/cv/<?= $user['cv'] ?>" target="_blank">CV</a>
            <?php endif; ?>

            <?php if ($is_following) : ?>
              <a class="btn btn-outline-primary" href="/profile/unfollow/<?= $user['id']; ?>/<?= $user['username']; ?>"><i class="bi bi-person-check-fill"></i></a>
            <?php else : ?>
              <a class="btn btn-primary" href="/profile/follow/<?= $user['id']; ?>/<?= $user['username']; ?>"><i class="bi bi-person-plus-fill"></i></a>
            <?php endif; ?>

            <?php if ($user['availability'] != 'Do Not Disturb') : ?>
              <!-- Button trigger modal message -->
              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#message">
                <i class="bi bi-envelope-fill"></i>
              </button>
            <?php endif; ?>
          </div>
        </div>
      </div>

      <!-- availability -->
      <?php if ($user['availability'] == 'Available') : ?>
        <p class="badge bg-success" nowrap><?= $user['availability']; ?></p>
      <?php elseif (($user['availability'] == 'Unavailable')) : ?>
        <p class="badge bg-danger"><?= $user['availability']; ?></p>
      <?php elseif (($user['availability'] == 'Do Not Disturb')) : ?>
        <p class="badge bg-warning"><?= $user['availability']; ?></p>
      <?php endif; ?>
      <br>

      <!-- avatar -->
      <img class="mb-3 rounded-circle" width="200px" src="/img/avatar/<?= $user['avatar']; ?>" alt="" style="  width: 100px;
        height: 100px;
        background-position: center center;
        background-repeat: no-repeat;
        object-fit:cover;">
      <br>

      <!-- Button trigger modal contact info-->
      <a type="button" class="" data-bs-toggle="modal" data-bs-target="#contactinfo">
        Contact info
      </a>

      <p>Following <?= count($following_count); ?> <span class="mx-2">Follower <?= count($follower_count); ?></span></p>

      <!-- Info -->
      <h2>Information</h2>
      <ul>
        <?php foreach ($user as $key => $d) : ?>
          <li><?= $key; ?>: <?= $d; ?></li>
        <?php endforeach; ?>
      </ul>

      <h2>Skill</h2>
      <table class="table table-hover align-middle table-fit">
        <thead>
          <col style="width: 5%;">
          <col style="width: 25%;">
          <col style="width: 50%;">
          <tr class="table-dark">
            <th scope="col">#</th>
            <th scope="col">Skill</th>
            <th scope="col">Level</th>
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
            </tr>

          <?php endforeach; ?>

        </tbody>
      </table>

      <h2>Achievement</h2>
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
            </tr>

            <?php if ($s['description'] != '') : ?>

              <tr class="collapse" id="desc<?= $s['id']; ?>">
                <td></td>
                <td colspan="4" scope="row"><?= $s['description']; ?></td>
              </tr>

            <?php endif; ?>



          <?php endforeach; ?>

        </tbody>
      </table>

    </div>

    <div class="col-3">
      <div class="card">
        <!-- <img src="..." class="card-img-top" alt="..."> -->
        <div class="card-body">
          <h3 class="card-title">Achievement</h3>
          <p class="card-text">Life long goals</p>
        </div>
        <ul class="list-group list-group-flush">
          <?php $competition_rank = ["First", "Second", "Third", "Favorite", "Honorable Mention", "Participate", "Other"];
          $i = 0 ?>
          <?php foreach ($competition_rank as $c) : ?>
            <?php if ($rank[$i] != 0) : ?>
              <li class="list-group-item d-flex justify-content-between align-items-center"><?= $c; ?> <span class="badge bg-primary rounded-pill"><?= $rank[$i]; ?></span></li>
            <?php endif; ?>
            <?php $i++ ?>
          <?php endforeach; ?>
        </ul>
        <div class="card-body">
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal COntact -->
<div class="modal fade" id="contactinfo" tabindex="-1" aria-labelledby="contactinfoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="contactinfoLabel">Contact Info</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?php $icon =        ['globe2', 'telephone-fill', 'envelope-fill', 'whatsapp', 'twitter', 'instagram', 'facebook', 'linkedin', 'reddit', 'github'] ?>
        <?php $contactName = ['website', 'phone', 'mail', 'whatsapp', 'twitter', 'instagram', 'facebook', 'linkedin', 'reddit', 'github'] ?>

        <div>
          <?php for ($i = 0; $i < count($icon); $i++) : ?>
            <ul class="list-group list-group-flush">
              <?php if ($contact[$contactName[$i]]) : ?>
                <li class="list-group-item"><i class="bi bi-<?= $icon[$i]; ?> mx-3"></i><?= $contact[$contactName[$i]]; ?></li>
              <?php endif; ?>
            </ul>
          <?php endfor; ?>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="message" tabindex="-1" aria-labelledby="messageLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageLabel">Message to <strong><?= $user['name']; ?></strong></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/profile/message/<?= $user['id']; ?>" method="POST">
          <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject" required>
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea name="message" type="text" class="form-control" id="message" placeholder="Message" required></textarea>
            <div id="message_max" class="form-text">Max. 512 characters</div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Send</button>
      </div>
      </form>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>