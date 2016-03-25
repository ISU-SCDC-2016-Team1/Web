<?php
require_once 'login_helper.php';
verify_session();
?>
<!-- Static navbar -->
<nav class="navbar navbar-default navbar-static-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">Cluster Deployment Company</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="/srvstatus.php?p=runscript">Server Status</a></li>
        <li><a href="/comments.php?l=10">Comments</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
        ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php
          } elseif($_SESSION['admin']) {
        ?>
            <li><a href="viewacct.php?u=<?php echo $_SESSION['username'];?>">My Account</a></li>
            <li><a href="runner.php">Code Runners</a></li>
            <li><a href="viewallacct.php">Manage Users</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php
          } else {
        ?>
          <li><a href="viewacct.php?u=<?php echo $_SESSION['username'];?>">My Account</a></li>
          <li><a href="runner.php">Code Runners</a></li>
          <li><a href="logout.php">Logout</a></li>
        <?php
          }
        ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
