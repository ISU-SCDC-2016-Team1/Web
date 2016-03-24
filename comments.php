<?php
require_once "login_helper.php";
require_once "db_helper.php";
verify_session();

$comments = db_get_comments($limit);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once 'head.php'; ?>
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
  </body>
</html>
