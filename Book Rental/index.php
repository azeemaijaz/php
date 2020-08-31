<?php
session_start();
if (isset($_SESSION["username"])) {
  header("Location: student.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Login</title>
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <style>
    .row {
      margin-top: 100px
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row justify-content-center">
      <!-- Form -->

      <div class="col-sm-4">
        <div class="card shadow">
          <h5 class="card-header bg-dark text-white">
            Admin login
          </h5>
          <div class="card-body">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" required>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
              </div>
              <div class="form-group">
                <input type="submit" name="login" class="btn btn-success" value="login" />
              </div>

            </form>
          </div>
          </h5>
          <?php
          if (isset($_POST['login'])) {
            require_once("classes/Crud.php");
            $crud = new Crud();
            if (empty($_POST['username']) || empty($_POST['password'])) {
              echo '<div class="alert alert-danger">All Fields must be entered.</div>';
              die();
            } else {
              $username = $crud->escape_string(sanitize_input($_POST['username']));
              $password = md5($_POST['password']);
              $query = "SELECT * FROM admin  WHERE username = '{$username}' AND password= '{$password}'";
              $result = $crud->getData($query);
              if (count($result)) {
                session_start();
                $_SESSION["username"] = $result[0]['username'];
                $_SESSION["admin_id"] = $result[0]['admin_id'];
                header("Location: student.php");
              } else {
                echo '<div class="alert alert-danger">Username and Password are not matched.</div>';
              }
            }
          }

          ?>
        </div>
      </div>
      <!-- END Form -->

    </div>
    <script src="../js/jquery-3.4.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>