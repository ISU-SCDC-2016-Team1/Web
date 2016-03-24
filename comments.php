<?php
require_once "login_helper.php";
require_once "db_helper.php";
verify_session();

$comments = db_get_comments($limit);


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/img/favicon.ico">

    <title>Cluster Deployment Company</title>

    <!-- Bootstrap core CSS -->
    <link href="/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/dist/css/custom.css" rel="stylesheet">
  </head>
  <body>
      <?php require_once 'nav.php'; ?>
        <div style="text-align: center; " class="col-md-12">
          <h2>Comments</h2>
          <h4>tell us how you really feel</h4>
        </div>
        <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 jumbotron">
        <?php
        while ($row = mysql_fetch_assoc($comments)) {
            $str = '';
            foreach($row as $r){
                $str = $str.' '.$r;
            }
            echo '<p style="padding-left: 10px;">'.$str.'</p>';
        }
        ?>
       </div>
        <div class="col-md-3">
        </div>
        </div>

        <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
          <form class="form-signin" method="post" action="/comments.php">
        <label for="input1" class="sr-only">Comment</label>
        <textarea id="input1" name="comment" class="form-control" rows="5" placeholder="Comment"></textarea>
        <button name="button" value="deploy" class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
       </div>
        <div class="col-md-3">
        </div>
        </div>
      <hr>

      <footer>
        <p>&copy; 2016 CDC Inc. <a href="/privacy.txt">privacy policy</a></p>
      </footer>
    </div> <!-- /container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/dist/js/jquery.min.js"></script>
    <script src="/dist/js/bootstrap.min.js"></script>
  </body>
</html>
