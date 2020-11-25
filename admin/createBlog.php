<?php
    session_start();
    if ($_SESSION) {
      if ($_SESSION["loggedIn"]) {
          $_SESSION["token"] = md5(time()."hello");
        }
    } else {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BLOG | Write Something</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="starter.php"><b>Blog </b>| </a>
    <span> Write Something</span>
  </div>

  <form action="../database/storeBlog.php" method="post" enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $_SESSION["token"] ?>" name="token">
    <div class="form-group">
      <input type="text" name="title" class="form-control" placeholder="Title">
    </div>
  
    <div class="form-group">
      <textarea class="form-control" name="content" rows="5" placeholder="Content"></textarea>
    </div>
  
    <div class="form-group">
      <div class="custom-file">
        <input type="file" name="image" class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">Choose file</label>
      </div>
    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-outline-success">Upload</button>
    </div>
  </form>
</div> 
<!-- /.center -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<script type="text/javascript">
  $(document).ready(function () {
    bsCustomFileInput.init();
  });
  </script>
</body>
</html>
