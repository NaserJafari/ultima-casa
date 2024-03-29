<?php

     include_once("functions.php");
     
     $db = ConnectDB();
     
     $relatieid = $_POST["RID"]; 
     $naam = "'" . trim($_POST["Naam"]) . "'";
     $omschrijving = "'" . trim($_POST["Omschrijving"]) . "'";
     $waarde = $_POST["Waarde"];
     $landingspagina = "'" . trim($_POST["Landingspagina"]) . "'";
     echo 
    '<!DOCTYPE html>
     <html lang="nl">
          <head>
               <title>Ultima Casa Admin</title>
               <meta charset="utf-8">
               <meta name="viewport" content="width=device-width, initial-scale=1">
               <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
               <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
               <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
               <link rel="stylesheet" type="text/css" href="ucstyle.css?' . mt_rand() . '">
          </head>
          <body>
               <div class="container">
                    <div class="col-sm-5 col-md-7 col-lg-5 col-sm-offset-4 col-md-offset-3 col-lg-offset-4">
                         <h3>Rol toevoegen.</h3>';
     
     $sql = "INSERT  
               INTO rollen (Naam, Omschrijving, Waarde, Landingspagina)
             VALUES ($naam, $omschrijving, $waarde, $landingspagina)";
     
     if ($db->query($sql) == true)
     {    echo          'De rol is toegevoegd.';
     }
     else
     {    echo          'Fout bij het toevoegen van deze rol.<br><br>' . $sql;
     }
     echo               '<br><br>
                         <button class="action-button"><a href="admin.php" >Ok</a>
                         </button>
                    </div>
               </div>
          </body>
     </html>';
?>