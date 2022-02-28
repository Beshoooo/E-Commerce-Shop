
<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="#"><?php echo lang("HOME_ADMIN");?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 nav-opt">
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("CATEGORIES");?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("ITEMS");?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("MEMBERS");?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("STATISTICS");?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang("LOGS");?></a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#nav" id="navbarDropdown" role="button" data-bs-toggle="dropdown"  aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION["Username"];?>
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="edit.php?do=Edit&UserID=<?php echo $_SESSION["UserID"]?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="#">Setting</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      
      
    </div>
  </div>
</nav>
<!--marginForNav => after navbar for ignoring the height of navbar and handle margin -->
<div class="marginForNav"></div>
