<?php
     include_once("functions.php");
     include_once("session.php");
     
     $db = ConnectDB();
     

     $ridSession = $_SESSION["ID"];
     $rolSession = $_SESSION["Rol"];
     
     echo 
    '<!DOCTYPE html>
     <html lang="nl">
          <head>
               <title>Mijn Ultima Casa</title>
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
                         <h3>Mijn account wijzigen</h3>';
     
     $sql = "UPDATE relaties 
                SET Naam = '" . $_POST['Naam'] . "',
                    Email = '" . $_POST['Email'] . "',
                    Telefoon = '" . $_POST['Telefoon'] . "' ";
     if ($_POST["Wachtwoord"] == "")
     {    $wachtwoord = "Ongewijzigd";
     }
     else
     {    $wachtwoord = $_POST["Wachtwoord"];
          $sql .= 
                 ", Wachtwoord = '" . md5($wachtwoord) . "'";
     } 
     $sql .= "WHERE ID = $rolSession";
     
     if ($db->query($sql) == true) 
     {     if (StuurMail($_POST['Email'], 
                        "Wijziging gegevens Ultima Casa account", 
                        "Uw gegevens zijn als volgt gewijzigd:
                        
               Naam: " . $_POST["Naam"] . "
               E-mailadres: " . $_POST["Email"] . "
               Telefoon: " . $_POST["Telefoon"] . "
               Wachtwoord: " . $wachtwoord . "
               
               Bewaar deze gegevens goed!
               
               Met vriendelijke groet,
               
               Het Ulima Casa team.",
                        "From: noreply@uc.nl"))
          {    echo     '<p>De gewijzigde gegevens zijn naar uw e-mail adres verstuurd.</p>';
          }
          else
          {    echo     '<p>Fout bij het versturen van de e-mail met uw gegevens.</p>';
          }
     }
     else
     {    echo          '<p>Fout bij het bewaren van uw account gegevens.</p>
                         <p>' . $sql . '</p>';
     }
     echo               '<br><br>
                         <button class="action-button"><a href="relatie.php" >Ok</a>
                         </button>
                    </div>
               </div>
          </body>
     </html>';
?>