
<?php


setcookie('login', '', time() - 1, '/'); // empty value and old timestamp

header("Location:login.html");


