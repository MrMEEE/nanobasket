<?php

function showHeader(){

  echo echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
	      <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	      <head>
	      <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
	      <script type="text/javascript">
	      <link rel="stylesheet" type="text/css" href="css/general.css">
	      <script type="text/javascript" src="js/sha256.js"></script>
	      <script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	      <script type="text/javascript" src="js/jquery-ui-1.10.3.js"></script>
	      <link rel="stylesheet" type="text/css" href="css/styles.css" />
	      <link rel="stylesheet" href="css/jquery-ui-1.10.3-ui-lightness.css">
	      <meta charset="utf-8">';

  global $currentState;
  $currentState = $_POST['nextState'];
  
  echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Dommerbordsplan</title>';
  
  echo '<form id="mainForm" name="mainForm" method="post">
          <input type="hidden" name="nextState" value="'.$currentState.'">';

}

function createMenuItem($name,$location){
    echo '<tr>
    <td width="2%">
    </td>
    <td>
    <input type="submit" value="'.$name.'" style="font-size:60px;height: 200px; width:96%;" onclick="location.href=\''.$location.'\';">
    </td>
    </tr>
    <tr>
    <td height="20px"></td>
    </tr>';

}

function createBackButton(){

    echo '<table width="100%">
    <tr>
    <td width="2%">
    </td>
    <td bgcolor="#FFFFFF" width="96%">
    <input type="submit" value="Tilbage" style="font-size:60px;height: 100px; width:100%;" onclick="location.href=\'./\'">
    </td>
    </tr>
    <tr>
    <td height="20px"></td>
    </tr>   
    </table>';

}

function createShowAllButton(){

    echo '<table width="100%">
    <tr>  
    <td width="2%">
    </td>
    <td bgcolor="#FFFFFF" width="96%">
    <input type="submit" value="Vis Alle Kampe" style="font-size:60px;height: 100px; width:100%;" onclick="showAll();">
    </td>
    </tr>
    <tr>
    <td height="20px"></td>
    </tr>   
    </table>';
                                                
}

function fetchText($text,$type="text"){

  if(!isset($GLOBALS['language'])){
    $GLOBALS['language'] = getLanguage();
  }

  switch($type){
  
    case "header1":
    
      return "<h1>".translateText($text)."</h1>";
    
    break;

    case "header2":
        
      return "<h2>".translateText($text)."</h2>";
                  
    break;

    case "header3":
    
      return "<h3>".translateText($text)."</h3>";
      
    break;
    
    case "javascript":
    
      return stringToJava(translateText($text));
    
    break;
    
    default:

      return translateText($text);
        
    break;

  }

}

function getLanguage(){

  $config = getConfiguration();
  
  $language = array();
  if (file_exists("nanobasket.lang.".$config['language'].".php")){
      $handle = fopen("nanobasket.lang.".$config['language'].".php", "r");
  }else{
      $handle = fopen("../nanobasket.lang.".$config['language'].".php", "r");
  }
  if ($handle) {
      while (($line = fgets($handle)) !== false) {
	  $thisline = explode("¤",$line);
	  $language[$thisline[0]] = $thisline[1];
      }
  }
  
  return $language;

}
?>
