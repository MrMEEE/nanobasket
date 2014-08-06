<?php

require("../connect.php");
require("../nanobasket.common.functions.php");

switch($_POST['action']){

    case "fetchText":
	  
	  $string = fetchText($_POST['string'],"javascript");
	  
	  $json = '[ { "text": "'.$string.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "logon":
    
	  if(mysql_num_rows(getCurrentUser("POST")) > 0){
		$status = "0";
		session_start();
		$_SESSION['rpusername']=$_POST['username'];
		$_SESSION['rppasswd']=$_POST['password'];
		session_write_close();
	  }else{
		$status = "1";
	  }
	  	  
	  $json = '[ { "status": "'.$status.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "logout":
	  session_start();
	  session_unset();
	  session_destroy();
	  //header("Location: ../");exit;
    
    break;
    
    case "saveuser":
    
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
		$query = mysql_query("SELECT * FROM `users` WHERE `username`='".$_POST['newuser']."'");
		
		if(mysql_num_rows($query) == 0){
		      mysql_query("INSERT INTO `users` (`username`,`name`,`email`,`passwd`,`access`) VALUES ('".$_POST['newuser']."','".$_POST['name']."','".$_POST['email']."','".$_POST['newpassword']."','".$_POST['usertype']."')");
		      $json = '[ { "status": "created" } ]';
		}else{
		      $json = '[ { "status": "exists" } ]';
		}
	  
		echo $json;
	  }
    
    break;
    
    case "edituser":
    
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
	      if($_POST['newpassword'] == ""){
	      
		    mysql_query("UPDATE `users` SET `name`='".$_POST['name']."',`email`='".$_POST['email']."',`access`='".$_POST['usertype']."' WHERE id='".$_POST['id']."'");
	      
	      }else{
	      
		    mysql_query("UPDATE `users` SET `name`='".$_POST['name']."',`email`='".$_POST['email']."',`access`='".$_POST['usertype']."',`passwd`='".$_POST['newpassword']."' WHERE id='".$_POST['id']."'");
	      
	      }
	      
	      $json = '[ { "status": "updated" } ]';
	      
	      echo $json;
	  }
    
    break;
    
    case "getuser":
    
	  $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$_POST['id']."'"));
	  
	  $json = '[ { "username": "'.$user['username'].'", "name": "'.$user['name'].'", "email": "'.$user['email'].'", "access": "'.$user['access'].'" } ]';
	  
	  echo $json;
    
    break;
    
    case "deleteuser":
	  
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
		  mysql_query("DELETE FROM `gymusers` WHERE `userid`='".$_POST['id']."'");
	  
		  mysql_query("DELETE FROM `users` WHERE `id`='".$_POST['id']."'");
	  
	  }
	  
	  $json = '[ { "status": "deleted" } ]';
	  
	  echo $json;
    
    break;
    
    case "savegym":
    
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
		$query = mysql_query("SELECT * FROM `gyms` WHERE `name`='".$_POST['name']."'");
		
		if(mysql_num_rows($query) == 0){
		      mysql_query("INSERT INTO `gyms` (`name`,`address`) VALUES ('".$_POST['name']."','".$_POST['address']."')");
		      $json = '[ { "status": "created" } ]';
		}else{
		      $json = '[ { "status": "exists" } ]';
		}
	  
		echo $json;
	  }	  
    
    break;
    
    case "getgym":
    
	  $user = mysql_fetch_assoc(mysql_query("SELECT * FROM `gyms` WHERE `id`='".$_POST['id']."'"));
	  
	  $users = mysql_query("SELECT * FROM `gymusers` WHERE `gymid`='".$_POST['id']."'");
	  
	  while($usr = mysql_fetch_assoc($users)){
	  
	      $username = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='".$usr['userid']."'"));
	      
	      $usernames[] = $username['name'];
	  
	  }
	  
	  sort($usernames);
	  
	  $usernames = implode("¤",$usernames);
	  
	  $json = '[ { "name": "'.$user['name'].'", "address": "'.$user['address'].'", "users": "'.$usernames.'" } ]';
	  
	  echo $json;
    
    break;

    case "editgym":
    
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
	      mysql_query("UPDATE `gyms` SET `address`='".$_POST['address']."' WHERE id='".$_POST['id']."'");
	      
	      $json = '[ { "status": "updated" } ]';
	      
	      echo $json;
	  }
    
    break;

    case "deletegym":
	  
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
		  mysql_query("DELETE FROM `gyms` WHERE `id`='".$_POST['id']."'");
	  
	  }
	  
	  $json = '[ { "status": "deleted" } ]';
	  
	  echo $json;
    
    break;
    
    case "addcoach":
    
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
		  if(mysql_num_rows(mysql_query("SELECT * FROM `gymusers` WHERE `userid`='".$_POST['userid']."' AND `gymid`='".$_POST['gymid']."'"))){
		  
			  $status="exists";
		  
		  }else{
		  
			  mysql_query("INSERT INTO `gymusers` (`userid`,`gymid`) VALUES ('".$_POST['userid']."','".$_POST['gymid']."')");
			  $status="added";
			  
		  }
	  }
	  
	  $json = '[ { "status": "'.$status.'" } ]';
	  
	  echo $json;
    
    break;
    
    case "remcoach":
    
	  if(mysql_num_rows(getCurrentUser()) > 0){
	  
		  if(mysql_num_rows(mysql_query("SELECT * FROM `gymusers` WHERE `userid`='".$_POST['userid']."' AND `gymid`='".$_POST['gymid']."'"))){
		  
			  mysql_query("DELETE FROM `gymusers` WHERE `userid`='".$_POST['userid']."' AND `gymid`='".$_POST['gymid']."'");
			  $status="removed";
		  
		  }else{
		  
			  $status="noexists";
			  
		  }
	  }
	  
	  $json = '[ { "status": "'.$status.'" } ]';
	  
	  echo $json;
    
    break;
}

?>