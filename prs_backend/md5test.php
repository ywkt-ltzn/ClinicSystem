<!DOCTYPE html>
<html>
<body>

<?php
$str = "Hello";
$encrypt = md5($str);
echo $encrypt . "</br>";

$usrpsw = "Hello";
if (strcmp($encrypt,md5($usrpsw)) == 0)
	echo "this is match";
else
	echo "this is not match";
?>  
 
</body>
</html>