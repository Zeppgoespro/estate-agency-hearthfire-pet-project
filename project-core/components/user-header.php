<header class="header">

  <div class="nav nav-1">
    <section class="flex">
      <a href="../home.php" class="logo"><span class="fas fa-house"></span><b>HearthFire</b></a>

      <ul>
        <li><a href="../post-property.php">post property <span class="fas fa-paper-plane"></span></a></li>
      </ul>
    </section>
  </div>

  <div class="nav nav-2">
    <section class="flex">
      <div id="menu-btn" class="fas fa-bars"></div>

      <div class="menu">
        <ul>
          <li>
            <a href="#">my listings <span class="fas fa-angle-down"></span></a>
            <ul>
              <li><a href="../dashboard.php">dashboard</a></li>
              <li><a href="../post-property.php">post property</a></li>
              <li><a href="../my-listings.php">my listings</a></li>
            </ul>
          </li>
          <li>
            <a href="#">options <span class="fas fa-angle-down"></span></a>
            <ul>
              <li><a href="../search.php">filter search</a></li>
              <li><a href="../listings.php">all listings</a></li>
            </ul>
          </li>
          <li>
            <a href="#">help <span class="fas fa-angle-down"></span></a>
            <ul>
              <li><a href="../about.php">about us</a></li>
              <li><a href="../contact.php">contact us</a></li>
              <li><a href="../contact.php#faq">FAQ</a></li>
            </ul>
          </li>
        </ul>
      </div>

      <ul>
        <li><a href="../saved.php">saved <span class="fas fa-heart"></span></a></li>
        <li><a href="#">account <span class="fas fa-angle-down"></span></a>
          <ul>
            <li><a href="../login.php">login now</a></li>
            <li><a href="../register.php">register new</a></li>
            <?php if ($user_id != ''): ?>
              <li><a href="../update.php">update profile</a></li>
              <li><a href="../components/user-logout.php" onclick="return confirm('Logout from Hearthfire?');">logout</a></li>
            <?php endif ?>
          </ul>
        </li>
      </ul>
    </section>
  </div>

</header>