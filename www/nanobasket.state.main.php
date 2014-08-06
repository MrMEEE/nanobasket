<?php

case "mainmenu":

      createMenuItem(fetchText("Users"),"usersmenu",3);
      
      createMenuItem(fetchText("Gyms"),"gymsmenu",3);
      
      createMenuItem(fetchText("Logout"),"logout",5,"logout");


break;

?>