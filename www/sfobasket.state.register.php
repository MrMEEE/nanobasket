<?php

case "registermenu":

      createMenuItem(fetchText("Register players"),"registerplayers",5);
      
      //createMenuItem(fetchText("View Logs"),"viewlogs",5);

      createMenuItem(fetchText("Back"),"mainmenu",5);


break;

case "registerplayers":

      echo '<script type="text/javascript" src="js/players.js"></script>';

      getPreItem();
      
      $user = mysql_fetch_assoc(getCurrentUser());
      
      echo fetchText("Logged on as:")." ".$user['name']."<br><br>";

      echo fetchText("Gym:")."<br>";
      
      
      
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
      
      echo fetchText("Number of players:")."<br>";
      
      for ($i = 0; $i <= 50; $i++) {
      
	    $numbers .= '<option value="'.$i.'">'.$i.'</option>
	    ';
      }
      
      echo '<select id="boys">
	      <option value="-1">'.fetchText("Number of boys").'</option>';
	      echo $numbers;
      
      
      echo '</select><br><br>';
      
      echo '<select id="girls">
	      <option value="-1">'.fetchText("Number of girls").'</option>';
	      echo $numbers;
      
      
      echo '</select><br><br>';
      
      echo fetchText("Date:")."<br>";
      
      echo '<select id="day">';
	      for ($i = 1; $i <= 31; $i++) {
		    if ($i == date('d')){
			echo '<option value="'.$i.'" selected>'.$i.'</option>
		    ';
		    }else{
			echo '<option value="'.$i.'">'.$i.'</option>
		    ';
		    }
      }
      
      echo '</select>-';
      
      echo '<select id="month">';
	      for ($i = 1; $i <= 12; $i++) {
		    if ($i == date('n')){
			echo '<option value="'.$i.'" selected>'.$i.'</option>
		    ';
		    }else{
			echo '<option value="'.$i.'">'.$i.'</option>
		    ';
		    }
      }
      
      echo '</select>-<span id="year">'.date('Y').'</span>';
      
      getPostItem();
      
      createMenuItem(fetchText("Save"),"saveregisterplayers",5,"saveregisterplayers");
      
      createMenuItem(fetchText("Back"),"mainmenu",5);

break;


case "viewlogs":

      echo "";
      
      createMenuItem(fetchText("Back"),"registermenu",5);

break;


?>