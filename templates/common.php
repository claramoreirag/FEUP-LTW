
<?php function draw_footer() { 
/**
 * Draws the footer for all pages.
 */ ?>
<link href="../css/common.css" rel="stylesheet">
<footer>
      <p>&copy; True Friends, 2020</p>
    </footer>
<?php } ?>


<?php function draw_header() { 
/**
 * Draws the header for all pages.
 */ ?>
<link href="../css/common.css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<header id="header">
      <nav class="navigation">
        <div class="bar">

        </div>
        <div class="right__buttons">
          <div class="login">
            <h1>
              <a href="../pages/login.php">Log In</a></h1>
          </div>
        </div>
      </nav>
    </header>

    <script src="../js/scrollLock.js"></script>


<?php } ?>


<?php function draw_profile_header() { 
/**
 * Draws the header for all pages.
 */ ?>
<link href="../css/common.css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<header id="header">
      <nav class="navigation">
        <div class="bar">

        </div>
        <div class="right__buttons">
          <div class="login">
            <h1><a href="../pages/mainPage.php">Home</a></h1>
          </div>
        </div>
      </nav>
    </header>

    <script src="../js/scrollLock.js"></script>


<?php } ?>


<?php function draw_header_favorites() { 
/**
 * Draws the header for all pages.
 */ ?>
<link href="../css/common.css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<header id="header">

    <nav class="navigation">
        <div class="bar">
          <div class="dropdown">
            <button class="dropdown__button">
              <img src="../img/ui/dropdownMenu.svg" alt="">
            </button>
            <ul>
              <li class="dropdown__options"><a href="../pages/mainPage.php">Home Page</a></li>
              <li class="dropdown__options"><a href="../pages/feed.php">Feed</a></li>
              <li class="dropdown__options"><a href="../pages/profile.php">Profile</a></li>
            
            </ul>
          </div>
        </div>
        <div class="right__buttons">
          <div class="proposals">
            <a href="../pages/see_proposals.php"><i class="far fa-bell fa-2x"></i></a>
          </div>
          <div class="fav">
            <a href="../pages/favorites.php"><i class="fas fa-heart fa-2x"></i></a>
          </div>
          <div class="login">
            <h1><a href="../actions/logout_action.php">Log Out</a></h1>
          </div>
        </div>
        
      </nav>
    </header>

    <script src="../js/scrollLock.js"></script>


<?php } ?>




<?php function draw_loggedin_profile() { 
/**
 * Draws the header for all pages.
 */ ?>
<link href="../css/common.css" rel="stylesheet">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<header id="header">
      <nav class="navigation">
        <div class="bar">
          <div class="dropdown">
            <button class="dropdown__button">
              <img src="../img/ui/dropdownMenu.svg" alt="">
            </button>
            <ul>
              <li class="dropdown__options"><a href="../pages/mainPage.php">Home Page</a></li>
              <li class="dropdown__options"><a href="../pages/feed.php">Feed</a></li>
              <li class="dropdown__options"><a href="../pages/profile.php">Profile</a></li>
            
            </ul>
          </div>
        </div>
        <div class="right__buttons">
          <div class="proposals">
            <a href="../pages/see_proposals.php"><i class="far fa-bell fa-2x"></i></a>
          </div>
          <div class="fav">
            <a href="../pages/favorites.php"><i class="far fa-heart fa-2x"></i></a>
          </div>
          <div class="login">
              <form method="post" action="../actions/logout_action.php">
                <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                <button type="submit" name="logout" class="link-button">
                  <p>Log out</p>
                </button>
              </form>
          </div>
        </div>
        
      </nav>
    </header>

    <script src="../js/scrollLock.js"></script>


<?php } ?>