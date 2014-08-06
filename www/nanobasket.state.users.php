<?php

case "usersmenu":

      createMenuItem(fetchText("Create User"),"userscreate",3);
      
      createMenuItem(fetchText("Edit Users"),"usersedit",3);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "userscreate":

      echo '<script type="text/javascript" src="js/users.js"></script>';
      
      getPreItem();
      
      echo fetchText("Username:").'<br><input id="newuser"><br>
	    '.fetchText("Name:").'<br><input id="name"><br>
	    '.fetchText("Email:").'<br><input id="email"><br>
	    '.fetchText("Password:").'<br><input id="password1" type="password"><br>
	    '.fetchText("Repeat Password:").'<br><input id="password2" type="password"><br>
	    '.fetchText("Usertype:").'<br><select id="usertype"><option value="5">'.fetchText("User").'</option><option value="3">'.fetchText("Administrator").'</option></select>';

      getPostItem();
      
      createMenuItem(fetchText("Save"),"saveuser",5,"saveuser");

      createMenuItem(fetchText("Back"),"usersmenu",3);

break;

case "usersedit":

      echo '<script type="text/javascript" src="js/users.js"></script>';

      getPreItem();

      $users = mysql_query("SELECT * FROM `users` WHERE `username`!='".$_SESSION['rpusername']."' ORDER BY `username`");
      
      echo '<select id="users">
	      <option value="-1">'.fetchText("Select User").'</option>
	    ';
      while($user = mysql_fetch_assoc($users)){
      
	  echo '<option value="'.$user['id'].'">'.$user['username'].'</option>';
	  
      }
      
      echo '</select><br><br>';
      
      echo fetchText("Username:").'<div id="username"></div>
	   '.fetchText("Name:").'<br><input id="name"><br>
	   '.fetchText("Email:").'<br><input id="email"><br> 
	    '.fetchText("Usertype:").'<br><select id="usertype"><option value="5">'.fetchText("User").'</option><option value="3">'.fetchText("Administrator").'</option></select><br><br>';
	    
      echo fetchText("Change Password:")."<br>".fetchText("Password:").'<br><input id="password1" type="password"><br>
	    '.fetchText("Repeat Password:").'<br><input id="password2" type="password"><br>';
      
      getPostItem();
      
      createMenuItem(fetchText("Save"),"edituser",5,"edituser");
      
      createMenuItem(fetchText("Delete"),"deleteuser",5,"deleteuser");
      
      createMenuItem(fetchText("Back"),"usersmenu",3);

break;

?>