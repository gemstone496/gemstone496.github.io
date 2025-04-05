<?php
$TYPE = "Lab";
$TIME = "1.5";

$TDATA = array(
  array("First", "Ash", "Blaze", "Ember", "Inferna", "Phoenix", "Spark"),
  array("Last", "Aurora", "Blight", "Emmara", "Ire", "Phoebe", "Storm"),
  array("Age", "43", "26", "30", "22", "17", "67")
  );
$NRROWS = count($TDATA[0]);
$NRCOLS = count($TDATA);

?>

<html>
<head>

</head>
<body>

<h1><?php echo "NRROWS=".($NRROWS-1)."<br>"; ?></h1>

<table>
<?php
for ( $i = 0; $i < $NRROWS; $i++ ){
  echo("<tr>");
  for ( $j = 0; $j < $NRCOLS; $j++ ) {
    $type = $i == 0 ? "<th>" : "<td>";
    echo($type.$TDATA[$j][$i].$type);
	}
  echo("</tr>");
}
?>
</table>

<?php include "../layouts/footer_std.html.php";?>

</body>
</html>