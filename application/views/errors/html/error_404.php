<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>404 Page Not Found</title>
<style type="text/css">
body {
  background-color: #2F3242;
}
.message-box {
  height: 200px;
  width: 380px;
  position: absolute;
  top: 30%;
  left: 30%;
  color: #FFF;
  font-family: Roboto;
  font-weight: 300;
}
.message-box h1 {
  font-size: 60px;
  line-height: 46px;
  margin-bottom: 40px;
}
.buttons-con .action-link-wrap {
  margin-top: 40px;
}
.buttons-con .action-link-wrap a {
  background: #68c950;
  padding: 8px 25px;
  border-radius: 4px;
  color: #FFF;
  font-weight: bold;
  font-size: 14px;
  transition: all 0.3s linear;
  cursor: pointer;
  text-decoration: none;
  margin-right: 10px
}
.buttons-con .action-link-wrap a:hover {
  background: #5A5C6C;
  color: #fff;
}

<?php $base_url = load_class('Config')->config['base_url']; ?>
</style>
</head>
<div class="message-box">
  <h1>404</h1>
  <p>The page you requested was not found.</p>
  <div class="buttons-con">
    <div class="action-link-wrap">
      <a onclick="history.back(-1)" class="link-button link-back-button">Go Back</a>
      <a href="<?php echo $base_url; ?>" class="link-button">Go to Home Page</a>
    </div>
  </div>
</div>
</html>
