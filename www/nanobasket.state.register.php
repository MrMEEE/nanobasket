<?php

case "registermenu":

      createMenuItem(fetchText("Register players"),"registerplayers",5);
      
      //createMenuItem(fetchText("View Logs"),"viewlogs",5);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "registerplayers":

      echo '<script type="text/javascript" src="js/players.js"></script>';

      getPreItem();

      echo fetchText("Gym:")."<br>";
      
      $user = mysql_fetch_assoc(getCurrentUser());
      
      echo '<input type="hidden" id="userid" value="'.$user['id'].'">';
      
      $accesses = mysql_query("SELECT * FROM `gymusers` WHERE `userid`='".$user['id']."'");
      
      while($access = mysql_fetch_assoc($accesses)){
      
	  $availablegyms[] = $access['gymid'];
      
      }
      
      $gyms = mysql_query("SELECT * FROM `gyms` ORDER BY `name`");
      
      echo '<select id="gyms">
	      <option value="-1">'.fetchText("Select Gym").'</option>
	    ';
	    
      while($gym = mysql_fetch_assoc($gyms)){
      
	  if(in_array($gym['id'],$availablegyms)){
      
	      echo '<option value="'.$gym['id'].'">'.$gym['name'].'</option>';
	      
	  }
	  
      }
      
      echo '</select><br><br>';
      
      echo fetchText("Number of players")."<br>";
      
      echo '<select id="players">
	      <option value="-1">'.fetchText("Number of players").'</option>';
	      
      for ($i = 1; $i <= 50; $i++) {
      
	    echo '<option value="'.$i.'">'.$i.'</option>';
      }
      
      echo '</select><br><br>';
      
      getPostItem();
      
      createMenuItem(fetchText("Save"),"saveregisterplayers",5,"saveregisterplayers");
      
      createMenuItem(fetchText("Back"),"mainmenu",5);

break;


case "viewlogs":

      echo "";
      
      createMenuItem(fetchText("Back"),"registermenu",5);

break;


?>