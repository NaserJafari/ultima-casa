<?php
     include_once("functions.php");

     $db = ConnectDB();
     
     $naam = $_POST['Naam'];
     $email = $_POST['Email'];
     $telefoon = $_POST['Telefoon'];
     $wachtwoord = $_POST['Wachtwoord'];
     
     $key = openssl_random_pseudo_bytes(32);

     $encryptNaam = openssl_encrypt($naam, "AES-128-ECB", $key);
     $encryptEmail = openssl_encrypt($email, "AES-128-ECB", $key);
     $encryptTelefoon = openssl_encrypt($telefoon, "AES-128-ECB", $key);
     $encryptWachtwoord = openssl_encrypt($wachtwoord, "AES-128-ECB", $key);

     $sql = "INSERT INTO relaties (Naam, Email, Telefoon, Wachtwoord, FKrollenID, SslKey)
                  VALUES ('" . $encryptNaam . "', '" . 
                               $encryptEmail . "', '" .
                               $encryptTelefoon . "', '" . 
                               $encryptWachtwoord . "', '" .
                               10 . "', '" .
                               $key . "')";

     if ($db->query($sql) == true) 
     {    if (StuurMail($email, 
                        "Account gegevens Ultima Casa", 
                        "Uw inlog gegevens zijn:
                        
               Naam: " . $naam . "
               E-mailadres: " . $email . "
               Telefoon: " . $telefoon . "
               Wachtwoord: " . $wachtwoord . "
               
               Bewaar deze gegevens goed!
               
               Met vriendelijke groet,
               
               Het Ultima Casa team.",
                        "From: noreply@uc.nl"))
          {    $result = 'De gegevens zijn naar uw e-mail adres verstuurd.';
          }
          else
          {    $result = 'Fout bij het versturen van de e-mail met uw gegevens.';
          }
     }
     else
     {    $result .= 'Fout bij het bewaren van uw gegevens.<br><br>' . $sql;
     }
     echo $result . '<br><br>
          <button class="action-button"><a href="index.php">Ok</a></button>';
?>