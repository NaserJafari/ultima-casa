<?php

session_start();
session_destroy();

header("Location: http://localhost/ultima%20casa/index.php");
exit();