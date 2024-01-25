<?php

     include_once("functions.php");
     
     $email = '"' . $_POST["Email"] . '"'; 
     $ww = '"' . md5($_POST["Wachtwoord"]) . '"'; 
     
     $db = ConnectDB();
     $sql = "   SELECT relaties.ID as RID,
                       rollen.Waarde as Rol,
                       Landingspagina 
                  FROM relaties
             LEFT JOIN rollen
                    ON relaties.FKrollenID = rollen.ID
                 WHERE (Email = $email) 
                   AND (Wachtwoord = $ww)";
                   
     $inlog = $db->query($sql)->fetch();
     session_start();
     $_SESSION["ID"] = $inlog["RID"];
     $_SESSION["Rol"] = $inlog["Rol"];

     if ($inlog["Rol"] === 3) {
        $_SESSION["gebruiker"] = true;
        if ($inlog)
        {    
          $redirect_url = $inlog['Landingspagina'];
        }
    } elseif ($inlog["Rol"] === 4) {
          $_SESSION["admin"] = true;
          if ($inlog)
          {    
               $redirect_url = $inlog['Landingspagina'];
          }
    } else {
          $redirect_url = 'index.php?NOAccount';
          
    }
     
     $redirect_url = 'index.php?NOAccount';
     if ($inlog)
     {    $redirect_url = $inlog['Landingspagina'];
     }
     
     echo '<META HTTP-EQUIV=REFRESH CONTENT="1; '. $redirect_url . '">';
     
?>