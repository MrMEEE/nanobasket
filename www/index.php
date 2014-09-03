<?php

require("connect.php");

require("sfobasket.common.functions.php");

getHeader();

getTitle("SFO Basket");

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