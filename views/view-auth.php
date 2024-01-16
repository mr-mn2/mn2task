
<?php
defined("BASE_PATH") or die("peremetion denied");
?>

<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>login/register</title>
  <link rel="stylesheet" href="<?= siteUrl("assets/css/auth.css");?>">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-page">
  <div class="form">
    <form class="register-form" method="POST" action="<?= siteUrl('auth.php?action=register')?>">
      <input name="name" type="text" placeholder="name"/>
      <input name="password" type="password" placeholder="password"/>
      <input name="email" type="text" placeholder="email address"/>
      <p class="error"><?= isset($registerValidation) ? $registerValidation : ''?></p>
      <button>create</button>
      <p class="message">Already registered? <a href="#">Sign In</a></p>
    </form>
    <form class="login-form" method="POST" action="<?= siteUrl('auth.php?action=login')?>">
      <input name="email" type="text" placeholder="email"/>
      <input type="password" name = "password" placeholder="password"/>
      <p class="error"><?= isset($registerValidation) ? $registerValidation : ''?></p>
      <button>login</button>
      <p class="message">Not registered? <a href="#">Create an account</a></p>
    </form>
  </div>
</div>
<!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
$('.message a').click(function(){
   $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
});
</script>
</body>
</html>

