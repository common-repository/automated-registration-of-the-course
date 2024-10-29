<?php
/**
 * @author karim salim
 * @copyright 2011
 */
require_once('../../../wp-config.php');
//$q=explode(",",$_GET["q"]);
if(isset($_GET["q"]))
{
     $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    $table = $table_prefix."tc_users";
    mysql_select_db(DB_NAME, $con);
    
    $sql="SELECT * FROM $table WHERE course_id = '".$_GET["q"]."'";
    
    $result = mysql_query($sql);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=courses(Enrollments)_".$_GET["q"].".csv");
        header("Pragma: no-cache");
        header("Expires: 0");
                echo "[Id],";
                echo "[Enroll Name],";
                echo "[Enroll Email],";
                echo "[Enroll Phone],";
                echo "[Course Name],";
                echo "[Additional Enrollment],";
                echo "[Register Date Time],";
                echo "[status],";
                echo "\n"; 
    while($row = mysql_fetch_array($result))
    {
                echo $row['id'].",";
                echo $row['name'].",";
                echo $row['email'].",";
                echo $row['phone'].",";
                echo $row['course_name'].",";
                echo $row['addition_enroll'].",";
                echo $row['date_time'].",";
                echo $row['status'].",";
                echo "\n";  
    }
    mysql_close($con);   
}
else
{
    $con = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
    if (!$con)
      {
      die('Could not connect: ' . mysql_error());
      }
    $table = $table_prefix."tc_courses";
    mysql_select_db(DB_NAME, $con);
    
    $sql="SELECT * FROM $table";
    
    $result = mysql_query($sql);
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=courses.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
                echo "[Id],";
                echo "[Course Name],";
                echo "[Status],";
                echo "[Time],";
                echo "[Date],";
                echo "[Last enrollment date],";
                echo "[Date time],";
                //echo "[Decscription],";
                echo "[Category],";
                echo "[Type],";
                echo "[Duration],";
                echo "[Location],";
                //echo "[Requirements],";
                echo "[Payment info],";
                echo "[Price],";
                //echo "[Other content]";
                echo "\n"; 
    while($row = mysql_fetch_array($result))
    {
                echo $row['id'].",";
                echo $row['course_name'].",";
                echo $row['course_status'].",";
                echo $row['course_time'].",";
                echo $row['course_date'].",";
                echo $row['last_enrollment_date'].",";
                echo $row['date_time'].",";
                //echo $row['course_decscription'].",";
                echo $row['category'].",";
                echo $row['type'].",";
                echo $row['course_duration'].",";
                echo $row['course_location'].",";
                //echo $row['course_requirements'].",";
                echo $row['payment_info'].",";
                echo $row['price'].",";
                //echo $row['other_content']
                echo "\n";  
    }
    mysql_close($con);
}
?>
