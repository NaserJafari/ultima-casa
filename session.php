<?php
session_start();

if (isset($_SESSION['gebruiker']) && $_SESSION['gebruiker']) {
    // Gebruiker
} 
elseif (isset($_SESSION['admin']) && $_SESSION['admin'])  {
   // Admin
} 
else {
    header("Location: http://localhost/ultima%20casa/index.php");
    exit();
}
?>
