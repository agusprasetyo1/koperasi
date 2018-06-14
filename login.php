<?php
  $pesan = "";
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>CoreUI Free Bootstrap Admin Template</title>
    <!-- Icons-->
    <link href="vendors/css/flag-icon.min.css" rel="stylesheet">
    <link href="vendors/css/font-awesome.min.css" rel="stylesheet">
    <link href="vendors/css/simple-line-icons.css" rel="stylesheet">
    <!-- Main styles for this application-->
    <link href="css/style.css" rel="stylesheet">
    <link href="vendors/css/pace.min.css" rel="stylesheet">
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-5">
          <div class="card-group">
            <div class="card p-2">
              <div class="card-body">
                <h1 align="center">Login</h1>
                <p class="text-muted" align="center">Sistem Informasi Koperasi Bahagia</p>
                <form action="" method="post">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-user">ds</i>
                    </span>
                  </div>
                  <input type="text" class="form-control" placeholder="Username" aria-describedby="helpId" required>
                </div>
                <div class="input-group mb-4">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      <i class="icon-lock"></i>
                    </span>
                  </div>
                  <input type="password" class="form-control" placeholder="Password" aria-describedby="helpId" required>
                </div>
                <div class="form-group">
                  <small style="font-size: 13px; color: #bd0303" id="helpId">
                    <!-- *Username atau password salah -->
                    <!-- <?=$pesan?> -->
                  </small>
                </div>
                <div class="row justify-content-center">
                  <div class="col-7">
                    <input type="submit" class="btn btn-primary btn-block" value="Login">
                  </div>
                </div>
              </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap and necessary plugins-->
    <script src="vendors/js/jquery.min.js"></script>
    <script src="vendors/js/popper.min.js"></script>
    <script src="vendors/js/bootstrap.min.js"></script>
    <script src="vendors/js/pace.min.js"></script>
    <script src="vendors/js/perfect-scrollbar.min.js"></script>
    <script src="vendors/js/coreui.min.js"></script>
  </body>
</html>