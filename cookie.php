<!-- < ?php
 if (session_status() != PHP_SESSION_ACTIVE) {
       session_start();
     
 };
date_default_timezone_set("Africa/Algiers");
define("ICONFONT","23px");
define("FONTSIZE","30px");


ini_set("display_errors", 1);
error_reporting(-1);
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (900), "/"); // 86400 = 1 day
?>
<html>
<body>

< ?php
if(!isset($_COOKIE[$cookie_name])) {
  echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
  echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookie_name];
}
?>

</body>
</html> -->



<html>
<body>

<?php
$cookie_name = "user";
$cookie_value = "John Doe";
if(!isset($_COOKIE[$cookie_name])) {
  echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
  echo "Cookie '" . $cookie_name . "' is set!<br>";
  echo "Value is: " . $_COOKIE[$cookie_name];
}
// echo count($_COOKIE);
// if(count($_COOKIE) > 0) {
//   echo "Cookies are enabled.";
// } else {
//   echo "Cookies are disabled.";
// }
?>

</body>
</html>
