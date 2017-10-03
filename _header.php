<!doctype html>
<html lang="en">
<head>
  <title>SIJAMU - Sistem Informasi Jaminan Mutu</title>
  <meta content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" name="viewport"/>
  <meta content="MJFauzy" name="author"/>
  <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
  <link rel="stylesheet" href="datatables/dataTables.bootstrap.css"/>
  <script src="js/jquery-1.11.2.min.js"></script>
  <script src="bootstrap/js/bootstrap.js"></script>
  <script src="datatables/jquery.dataTables.js"></script>
  <script src="datatables/dataTables.bootstrap.js"></script>
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php"><img src="images/logo.jpg" /> SIJAMU</a>
    </div> 
    <ul class="nav navbar-nav navbar-right">
      <li><a href="index.php">Beranda</a></li>
      <li><a href="#">Profil</a></li>
      <li><a href="#">Tentang UJM</a></li> 
      <li><a href="#">Kontak</a></li> 
      <li><a href="#" data-toggle="modal" data-target="#ModalLoginForm"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
</nav>

<!-- Modal Login Form -->
    <div id="ModalLoginForm" class="modal fade" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <div class="logo-login text-center">
              <em class="glyphicon glyphicon-user"></em>
              <h4 class="modal-title">Login User</h4>
            </div>
          </div>
          <div class="modal-body">
            <!-- form login -->
            <form action="check-login.php" method="post">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="Username" class="form-control" required="true" />
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" class="form-control" required="true" />
              </div>
              <div class="text-right">
                <button class="btn btn-primary" type="submit">Login</button>
                <button class="btn btn-danger" type="reset" data-dismiss="modal" aria-hidden="true">Batal</button>
              </div>
            </form>
            <!-- end form login -->
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
