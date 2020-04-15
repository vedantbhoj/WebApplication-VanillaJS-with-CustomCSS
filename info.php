<html>
<body>

<table>
<?php

foreach ($_SERVER as $key => $value) {
   echo "<tr><td> $key</td><td> $value</td></tr>";
}

?>
</table>

</body>
</html>