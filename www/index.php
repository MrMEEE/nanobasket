<?php

require("connect.php");

require("nanobasket.common.functions.php");

getHeader();

getTitle("Nano Basket");

//echo "!".$currentState;

showContent($currentState);

/*
?>
<table width="100%">
<?php

createMenuItem("Bekræft tjanser","confirm.php");
createMenuItem("Mine holds kampe","games.php");
createMenuItem("Dommer/Dommerbordstjanser","duties.php");
createMenuItem("Frie Dommertjanser","opengames.php");
createMenuItem("Log Ud","logout.php");
?>

</table>

<?php
*/


getFooter();

?>