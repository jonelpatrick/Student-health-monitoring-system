
<!DOCTYPE html>
<html lang="en">
<head>   
<link href="calendar.css" type="text/css" rel="stylesheet" />
<link href="../dist/css/calendar.css" rel="stylesheet">
</head>
<body>

<?php
include 'calendar.php';
 
$calendar = new Calendar();
 
echo $calendar->show();
?>
</body>
</html>    