<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #16694A;">
  <div class="container">

    <!-- <div class="container-md"> -->
    <a class="navbar-brand" href="/">
      <img class="mx-2" src="/img/favicon.png" height="30px" alt="">
        AgriFind
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="/profile">Profile</a>


      </div>
      <div class="navbar-nav ms-auto">
        <a class="btn btn-primary rounded-circle mx-3 " href=" /message"><i class="bi bi-chat-fill"></i></a>
          <div class="dropdown d-flex">
            <button class="btn btn-sm btn-secondary dropdown-toggle rounded-pill bg-white text-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="rounded-circle" src="/img/avatar/<?= $_SESSION['avatar'] ?>" style="width: 30px;
                  height: 30px;
                  background-position: center center;
                  background-repeat: no-repeat;
                  object-fit:cover;"><b class="my-auto"> <?= $_SESSION['username']; ?></b>
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="/profile">Profile</a></li>
              <!-- <li><a class="dropdown-item" href="/message">Message</a></li> -->
              <!-- <li><a class="dropdown-item" href="/follow">Follow</a></li> -->
              <li><a class="dropdown-item" href="/setting">Setting</a></li>

              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item " href="/auth/logout">Log Out</a></li>
            </ul>
          </div>
      </div>



    </div>
    <!-- </div> -->

  </div>
</nav>