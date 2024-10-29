<?php
/**
 * @author karim salim
 * @copyright 2011
 */
require_once('../../../wp-config.php');
$q=explode(",",$_GET["q"]);
$con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
$table = $table_prefix."tc_type";
mysql_select_db(DB_NAME, $con);

$sql="SELECT * FROM $table";

$result = mysql_query($sql);
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=category.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
            echo "[Id],";
            echo "[Name],";
            echo "[Status],\n";
            
while($row = mysql_fetch_array($result))
{
            echo $row['id'].",";
            echo $row['category_name'].",";
            echo $row['status']."\n";  
}
mysql_close($con);
?>
