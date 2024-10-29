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
$table = $table_prefix."tc_users";
$table2 = $table_prefix."tc_courses";
mysql_select_db(DB_NAME, $con);
    header("Content-type: application/csv");
    header("Content-Disposition: attachment; filename=enrollments.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
            echo "[Id],";
            echo "[Name],";
            echo "[Status],";
            echo "[Email],";
            echo "[Phone],";
            echo "[Course Name],";
            echo "[Date time]\n";
$sql="SELECT * from `$table` ORDER BY name ASC";
$result = mysql_query($sql);           
            
//$sql="SELECT DISTINCT name,status from `$table` ORDER BY name ASC";
//$res = mysql_query($sql);
//while($ress = mysql_fetch_array($res))
//{
//$sql2="SELECT COUNT(*) from `$table2` WHERE name = '".$ress['name']."'";
//$result = mysql_query($sql2);
//$sql3="SELECT * from `$table2` WHERE name = '".$res['name']."'";
//$res3 = mysql_query($sql2);
while($row = mysql_fetch_array($result))
{
    
            echo $row['id'].",";
            echo $row['name'].",";
            echo $row['status'].",";
            echo $row['email'].",";
            echo $row['phone'].",";
            echo $row['course_name'].",";
            echo $row['date_time']."\n";  
}
mysql_close($con);
?>
