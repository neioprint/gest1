<?php
if (session_status() != PHP_SESSION_ACTIVE) {
    session_start();
}
//$_SESSION["favcolor"]=190;
echo $_SESSION["favcolor"];
?>