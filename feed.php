<?php 
session_start();
require('connection.php');

$hasil=mysqli_query($conn, "SELECT * FROM status LEFT JOIN user ON status.user_id = user.id ORDER BY status.created_at DESC");

$email = $_SESSION['email'];
$sql = "SELECT id FROM user WHERE email = '$email'";
$resultUser = $conn->query($sql);
$userid = $resultUser->fetch_assoc()['id'];

$name = $conn->query("SELECT username FROM user WHERE id = '$userid'");
$nameUser = $name->fetch_assoc()['username'];
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Feed</title>
    <link href="css/pricing.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/pricing/">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
  </head>
  <body>
    
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check" viewBox="0 0 16 16">
    <title>Check</title>
    <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
  </symbol>
</svg>

<div class="container py-3">
  <header>
    <div class="d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">
      <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <span class="fs-4">ArsMedia</span>
      </a>

      <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
        <a class="me-3 py-2 text-dark text-decoration-none" href="#"><?php echo $nameUser;?></a>
      </nav>
    </div>
  </header>
  <main>
    <div class="row">
      <div class="col-lg-12">
        <h4>Whats on your mind?</h4>

        <form class="form" action="process/feed_process.php" method="POST">
          <textarea name="content" class="form-control"></textarea>
          <input type="submit" class="btn btn-primary float-end mt-3" value="Post">
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <?php while ($feed=mysqli_fetch_array($hasil)) { ?>
        <p>
          <b><?php echo $feed["username"];?></b> <br>
          <?php echo $feed["content"];?> <br>
          <a href="">Like</a> - <a href="">Comment</a>
        </p>
        <hr>
        <?php } ?>
      </div>
    </div>
  </main>
</div>


    
  </body>
</html>
