<?php
echo __DIR__;
//.DIRECTORY_SEPARATOR;
echo "<br>";
echo dirname(__DIR__,4);
echo "<br>";
echo basename(__DIR__).DIRECTORY_SEPARATOR;
echo "<br>";
//echo pathinfo(__DIR__);
echo realpath(__DIR__);
echo "<br>";
echo PHP_VERSION ;