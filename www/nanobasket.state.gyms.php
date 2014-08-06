<?php

case "gymsmenu":

      createMenuItem(fetchText("Create Gym"),"gymscreate",3);
      
      createMenuItem(fetchText("Edit Gym"),"gymsedit",3);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "gymscreate":

      echo '<script type="text/javascript" src="js/gyms.js"></script>';
      
      getPreItem();
      
      echo fetchText("Name:").'<br><input id="name"><br>
	   '.fetchText("Address:").'<br><input id="address"><br>';

      getPostItem();
      
      createMenuItem(fetchText("Save"),"savegym",5,"savegym");

      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

case "gymsedit":

      echo '<script type="text/javascript" src="js/gyms.js"></script>';

      getPreItem();

      $gyms = mysql_query("SELECT * FROM `gyms` ORDER BY `name`");
      
      echo '<select id="gyms">
	      <option value="-1">'.fetchText("Select Gym").'</option>
	    ';
      while($gym = mysql_fetch_assoc($gyms)){
      
	  echo '<option value="'.$gym['id'].'">'.$gym['name'].'</option>';
	  
      }
      
      echo '</select><br><br>';
      
      echo fetchText("Name:").'<br><div id="name"></div>
	   '.fetchText("Address:").'<br><input id="address"><br><br>'
	   .fetchText("Coaches:").'<br><div id="coaches"></div>';
	    
      $users = mysql_query("SELECT * FROM `users` ORDER BY `name`");
      
      echo '<select id="users">
	      <option value="-1">'.fetchText("Select Coach").'</option>
	    ';
      
      while($user = mysql_fetch_assoc($users)){
      
	  echo '<option value="'.$user['id'].'">'.$user['name'].'</option>';
	  
      }
      
      echo '</select><br><br>';

	    
      getPostItem();
      
      createMenuItem(fetchText("Add Coach"),"addcoach",5,"addcoach");
      
      createMenuItem(fetchText("Remove Coach"),"remcoach",5,"remcoach");
      
      createMenuItem(fetchText("Save"),"editgym",5,"editgym");
      
      createMenuItem(fetchText("Delete"),"deletegym",5,"deletegym");
      
      createMenuItem(fetchText("Back"),"gymsmenu",3);

break;

?>