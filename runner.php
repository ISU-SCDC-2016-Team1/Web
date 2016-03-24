<?php
require_once "db_helper.php";
require_once "login_helper.php";
require_once "runner_helper.php";
verify_session();

$logged_in = false;
$admin = false;
$user = '';
$group = '';
$fnt = '';
$project = '';
$runner = '';
$result = '';
$stdin = '';
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(isset($_COOKIE)){
        $logged_in = is_logged_in($_COOKIE);
        $admin = is_admin($_COOKIE);
        $group = db_get_group($user);

    }else{
        header('Location: /');
    }
    if(!$logged_in){
        header('Location: /');
    }
}else{
    //POST
    if(isset($_POST['project']) && isset($_POST['runner'])){
        if(isset($_COOKIE)){
            $logged_in = is_logged_in($_COOKIE);
            $admin = is_admin($_COOKIE);
            if(isset($_POST['user'])){
                $user = $_POST['user'];
            }else{
                $user = db_get_cookie_user($_COOKIE['session']);
            }
            $group = db_get_group($user);
        }else{
            header('Location: /');
        }

        $project = $_POST['project'];
        $runner = $_POST['runner'];
        if(isset($_POST['button'])){
            $fnt = $_POST['button'];
        }else{
            header('Location: /');
        }
        if($fnt != ''){
            if($fnt == 'stdin' && isset($_POST['stdin'])){
                $stdin = $_POST['stdin'];
            }
            $result = do_runner($fnt,$project,$runner,$user,$stdin);
        }
    }else{
        header('Location: /');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php require_once 'head.php'; ?>
  </head>
  <body>

        <?php require_once 'nav.php'; ?>

 <div class="row">
        <div style="text-align: center;" class="col-md-12">
          <h2>Run Some Code</h2>
        </div>
      </div>
      <hr>
      <div class="row">
       <form class="form-signin" method="post" action="/runner.php">
        <div class="col-md-6">
        <div class="aaa">
        <label for="input1" class="sr-only">Project</label>
        <input name="project" type="text" id="input1" class="form-control" placeholder="Project" value="<?php echo $project;?>" required>
        <label for="input2" class="sr-only">Runner</label>
        <input name="runner" type="text" id="input2" class="form-control" placeholder="Runner" value="<?php echo $runner;?>" required>
        <textarea id="input3" name="stdin" class="form-control" rows="5" placeholder="Stdin(optional)"></textarea>
       </div>
       </div>
        <div class="col-md-6">
        <div class="aaa">
        <button name="button" value="deploy" class="btn btn-lg btn-primary btn-block" type="submit">Deploy</button>
        <button name="button" value="clean" class="btn btn-lg btn-primary btn-block" type="submit">Clean</button>
        <button name="button" value="build" class="btn btn-lg btn-primary btn-block" type="submit">Build</button>
        <button name="button" value="run" class="btn btn-lg btn-primary btn-block" type="submit">Run</button>
        <button name="button" value="stdin" class="btn btn-lg btn-primary btn-block" type="submit">Set Stdin</button>
        <button name="button" value="stdout" class="btn btn-lg btn-primary btn-block" type="submit">Print Stdout</button>
        </div>
       </div>
      </form>
      </div>

      <div class="row">
      <div style="text-align: center;" class="col-md-12">
      <h2>Output</h2>
      <div class="col-md-2">
      </div>
      <div class="col-md-8 jumbotron">
      <p>
      <?php
      if($fnt != ''){
      echo $result;
      }
      ?>
      </p>
      </div>
      <div class="col-md-2">
      </div>
      </div>
      </div>

      <hr>

      <footer>
        <p>&copy; 2016 CDC Inc. <a href="/privacy.txt">privacy policy</a></p>
      </footer>
    </div> <!-- /container -->
  </body>
</html>
