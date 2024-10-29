<?php
/**

 * @author karim salim

 * @copyright 2011

 */

class user_course extends courses

{
    public function user_list($id='') { 

        global $wpdb;

        global $PLUGIN_ADDRESS;

        $table_name = $wpdb->prefix . "tc_users";
        if($id==NULL)
        {
            $users = $wpdb->get_results("SELECT * FROM $table_name WHERE course_id = '".$_GET['view_enrollment']."' ORDER BY date_time DESC");
        }
        else
        {
            
            $users = $wpdb->get_results("SELECT * FROM $table_name WHERE user_id = '$id' ORDER BY date_time DESC");
        }

        $this->script_confirm("Delete");
        ?>

    <div class="wrap">

        <style type="text/css" title="currentStyle">

    			@import "<?php echo $PLUGIN_ADDRESS?>media/css/demo_page.css";

    			@import "<?php echo $PLUGIN_ADDRESS?>media/css/demo_table.css";

    		</style>

            

            <script type="text/javascript" charset="utf-8" src="<?php echo $PLUGIN_ADDRESS?>media/js/jquery.js"></script>

    		<script type="text/javascript" charset="utf-8" src="<?php echo $PLUGIN_ADDRESS?>media/js/jquery.dataTables.js"></script>

    

    		<script type="text/javascript" charset="utf-8">

    			$(document).ready( function () {

    				var oTable = $('#example').dataTable();

    				new AutoFill( oTable );

    			} );

    		</script>

        			<h1><?php if($id!=NULL){echo "Your ";}?>Enrollment(s)</h1>

    			<form>

    			<div id="demo">

    <table cellpadding="0" cellspacing="0" border="2" class="display" id="example" style="width: 1400px;">

    	<thead>

     <tr>

        <th><b>Course Name</b></th>

        <th><b>Enroll Name</b></th>

        <th><b>Enroll Email</b></th>

        <th><b>Enroll Phone</b></th>

        <th><b>Comments</b></th>

        <th><b>Status</b></th>
        
        <th><b>Register Date</b></th>
        
        <th><b>Action</b></th>

     </tr>

    	</thead>

        <tbody>

    		

    			<?php

    foreach ($users as $user) 

    {

    echo '

        <tr>

            <td class="contact">'.$user->course_name.'</td>
            <td class="contact">'.$user->name.'</td>
            <td class="contact">'.$user->email.'</td>
            <td class="contact">'.$user->phone.'</td>
            <td class="contact">'.the_coures_content($user->comments,50).'</td>
            <td class="contact">'.$user->status.'</td>
            <td class="contact">'.$user->date_time.'</td>
            <td class="contact"><a href=?page=COURSES&view_enrollment='.$_GET['view_enrollment'].'&view='.$user->id.'>View</a> | <a href=?page=COURSES&view_enrollment='.$_GET['view_enrollment'].'&delete='.$user->id.' onclick="return confirmAction()">Delete</a></td>

        </tr>

        ';

    }

    ?>

     	</tbody>
    </table>

    			</div>

    		</form> 

    </div>
    <?php
                if($id==NULL)
                {
                    echo '<div class="leftside">';
                    $this->enrollment_excel('Download Course ('.$user->course_name.') Excel Doc', $_GET['view_enrollment']);
                    echo '</div>';
                } ?>

    <?php }  

    public function user_add($status)

    {

        global $wpdb;

        global $current_user;

        $course_data = explode(",",$_POST['option_course']);

        $table_name = $wpdb->prefix . "tc_users";

        $table_name2 = $wpdb->prefix . "tc_courses";

        $courses = $wpdb->get_results("SELECT * FROM $table_name2 WHERE id = '".$course_data[0]."'");

        foreach($courses as $course){}

            $rows_affected = $wpdb->insert( $table_name, 

            array( 'id' => 'NULL', 

            'user_id' => $current_user->ID, 

            'name' => $_POST['option_name'], 

            'email' => $_POST['option_email'], 

            'phone' => $_POST['option_phone'], 

            'course_id' => $course_data[0], 

            'course_name' => $course_data[1],

            'addition_enroll' => $_POST['option_addition'], 

            'date_time' => current_time('mysql'), 

            'comments' => $_POST['option_comments'],

            'status' => $status ) );

        

        if($rows_affected)

        {

            
            $this->admin_user_email($status);

        }

    }

    

    function user_register_courses_shortcodes() 

    { 

    ?>

    <?php

    if(isset($_POST['submit'])) 

    {

            //session_start();

        if($_SESSION['security_code'] == $_POST['option_captcha'])

        {

        if(($_POST['option_name']!='')&&

        ($_POST['option_email']!='')&&

        ($_POST['option_phone']!='')&&

        ($_POST['option_course'])!='')

        {

            global $wpdb;

            global $current_user;

            $table_name = $wpdb->prefix . "tc_users";
            
            $table_course = $wpdb->prefix . "tc_courses";

            $course_data = explode(",",$_POST['option_course']);
            
            
            $courses_enrollments = $wpdb->get_results("SELECT * FROM $table_course WHERE id = '".$course_data[0]."'");
            
            foreach($courses_enrollments as $courses_enrollment){}

            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE course_id = '".$course_data[0]."' AND name = '".$_POST['option_name']."'");

            $course = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name` WHERE course_id = '".$course_data[0]."'"));

            if($course < $courses_enrollment->total_enrollments)

            {

                if($courses)

                {

                    echo "<h3><font color='red'> You have already register this course </font></h3>";

                }

                else

                {

                    $status = 'active';

                    $update = $this->user_add($status);

                    echo "<h3><font color='blue'> Course registered sucessfully </font></h3>";

                    

                }

            }

            else

            {

                if($courses)

                {

                    echo "<h3><font color='red'> You have already register this course </font></h3>";

                }

                else

                {

                    $status = 'waiting';

                    $update = $this->user_add($status);


                        echo "<h3><font color='red'>Course enrollment full you are register for waiting list </font></h3>";


                }

                

            }

        }

        else

        {

            echo "<h3><font color='red'> All fields must be filled </font></h3>";

        }

        }

    else

    {

        echo "<h3><font color='red'> Invalid Captcha code </font></h3>";

    }

    }

        $this->user_form_shortcodes();

    ?>

    <?php }

    public function user_form() {

        global $wpdb;

        global $PLUGIN_ADDRESS;

    ?>

    <div id="stylized" class="myform">

    <form id="form" name="form" method="post" action="">

    <h1>Course register form</h1>

    <p>Select course and phone then register</p>

    

    <label>Full Name

    <span class="small">Add your full name</span>

    </label>

    <input type="text" name="option_name" id="name" />

    

    <label>E-mail

    <span class="small">Add your e-mail</span>

    </label>

    <input type="text" name="option_email" id="name" />

    

    <label>Mobile/Phone

    <span class="small">Add your phone</span>

    </label>

    <input type="text" name="option_phone" id="name" />

    

    <label>Course

    <span class="small">Select a Course</span>

    </label>

    <select name="option_course" onchange="showUser(this.value)">

    <?php

            $table_name = $wpdb->prefix . "tc_courses";

            $courses = $wpdb->get_results("SELECT id,course_name FROM $table_name WHERE course_status = 'active'");

            foreach ($courses as $c_select) 

            {

                echo"<option name='course_select' value='".$c_select->id.",".$c_select->course_name."'>".$c_select->course_name."</option>";

            }

    ?>

    </select>

    

    <button type="submit" name="submit">Register</button>

    <div class="spacer"></div>

    

    </form>

    </div>

    <div id="txtHint"></div>

    <?php }  var $seccode = false;

    public function user_form_shortcodes()

    {

            global $wpdb;

            global $PLUGIN_ADDRESS;

            if(isset($_GET['enroll']))

            {

                $table_name = $wpdb->prefix . "tc_courses";

                $courses = $wpdb->get_results("SELECT id,course_name FROM $table_name WHERE id = '".base64_decode($_GET['enroll'])."'");

                foreach ($courses as $course){} 

            }

       ?>

        <link href="<?php echo $PLUGIN_ADDRESS?>css/uni-form.css" media="screen" rel="stylesheet"/>

        <link href="<?php echo $PLUGIN_ADDRESS?>css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>

        <link href="<?php echo $PLUGIN_ADDRESS?>css/demo1.css" media="screen" rel="stylesheet"/>

    <form action="" class="uniForm" method="POST">  

          <fieldsets>

            <h2>Enrollment form</h2>

            

            <div class="ctrlHolder">

              <label for=""><em>*</em> Full Name</label>

              <input name="option_name" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required"/>

              <p class="formHint">Add your full name</p>

            </div>

            

            <div class="ctrlHolder">

              <label for=""><em>*</em> E-mail</label>

              <input name="option_email" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required"/>

              <p class="formHint">Add your e-mail</p>

            </div>

            

            <div class="ctrlHolder">

              <label for=""><em>*</em> Mobile/Phone</label>

              <input name="option_phone" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required validateInteger"/>

              <p class="formHint">Add your phone</p>

            </div>

            

            <div class="ctrlHolder">

              <label for="">Please Choose</label>

              <select name="option_course" id="" class="selectInput">

                <?php

                    $table_name = $wpdb->prefix . "tc_courses";

                    $courses = $wpdb->get_results("SELECT id,course_name FROM $table_name WHERE course_status = 'active'");

                    foreach ($courses as $c_select) { ?>

                       <option value='<?php echo $c_select->id.",".$c_select->course_name ?>' <?php if($c_select->id == base64_decode($_GET['enroll'])) {?> selected='' <?php }?> > <?php echo $c_select->course_name ?> </option>

                <?php }?>

              </select>

              

              <p class="formHint">Course name is here</p>

            </div>

            

            

            <div class="ctrlHolder">

              <label for="">Additional Enrollment</label>

              <select name="option_addition" id="" class="selectInput">

                <?php

                for($i=1; $i<=10; $i++) 

                {

                    echo"<option  value='".$i."'>".$i."</option>";

                }

                ?>

              </select>

              <p class="formHint">Additional Enrollment is here</p>

            </div>

            

            <div class="ctrlHolder">

              <label for=""> Comments</label>

              <textarea name="option_comments" id="" rows="20" cols="20"></textarea>

            </div>

            

            <div class="ctrlHolder">

              <label for=""><em>*</em> <img src="<?php echo $PLUGIN_ADDRESS?>captcha.php"/></label>

              <input name="option_captcha" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required"/>

              <p class="formHint">Add captcha code</p>

            </div>

            

          <div class="buttonHolder">

            <button type="submit" class="primaryAction" name="submit">Submit Enrollment</button>

          </div>

        </fieldsets>

        </form>

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>

        <script type="text/javascript" src="<?php echo $PLUGIN_ADDRESS?>js/uni-form-validation.jquery.js" charset="utf-8"></script>

        <script>

          $(function(){

            $('form.uniForm').uniform({

              prevent_submit : true

            });

          });

        </script>

    <?php }

    public function user_delete()

    {

        global $wpdb;

        $table_name = $wpdb->prefix . "tc_users";

        $courses = $wpdb->query("DELETE FROM $table_name where id= '".$_GET['delete']."'");

    }

    public function user_view()

    {

            global $wpdb;

            $table_name = $wpdb->prefix . "tc_users";

            $users = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".$_GET['view']."'");

    foreach ($users as $user) 

    { ?>

    <div class="wrap">
    
    <h1>Enrollment (<?php echo $user->name ?>) Details</h1>
    
    <table class="contacts" cellspacing="1" summary="Contacts template">

    <tr>

        <td class="contactDept"><b>Enrol Name</b></td>
        <td class="contact" ><?php echo $user->name ?></td>

    </tr>
    
    <tr>

        <td class="contactDept"><b>Enrol Email</b></td>
        <td class="contact" ><?php echo $user->email ?></td>

    </tr>
    
    <tr>

        <td class="contactDept"><b>Enrol Phone</b></td>
        <td class="contact" ><?php echo $user->phone ?></td>

    </tr>
    <tr>
    
        <td class="contactDept"><b>Course Name</b></td>
        <td class="contact" ><?php echo $user->course_name?></td>
    </tr>
    <tr>

        <td class="contactDept"><b>Enrol DateTime</b></td>
        <td class="contact" ><?php echo $user->date_time ?></td>

    </tr>
    <tr>

        <td class="contactDept"><b>Enrol Comments</b></td>
        <td class="contact" ><?php echo $user->comments ?></td>

    </tr>
    
    <tr>

        <td class="contactDept"><b>Enrol Status</b></td>
        <td class="contact" ><?php echo $user->status ?></td>

    </tr>

    </table>

    </div>

    <?php }

    }
    public function admin_user_email($status)

    { 

        global $wpdb;

        $table_name = $wpdb->prefix . "options";
        $table_name2 = $wpdb->prefix . "tc_users";
        
        $table_name3 = $wpdb->prefix . "tc_courses";

        $admins = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'admin_email'");

        $blogs = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'blogname'");

        foreach ($blogs as $blog){} 

        foreach ($admins as $admin){} 

        $course_ = explode(",", $_POST['option_course']);
        
        $course_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name2` WHERE course_id = '$course_[0]'"));
        
        $courses = $wpdb->get_results("SELECT * FROM $table_name3 WHERE id = '$course_[0]'");
        
        foreach ($courses as $course){}
    

    // Receiving variables

    @$pfw_ip= $_SERVER['REMOTE_ADDR'];

    

    //OWNER EMAIL
                
    $pfw_header = "MIME-Version: 1.0" . "\r\n"; 
    $pfw_header .= "Content-type: text/html; charset=iso-8859-1rn"; 
    
    $pfw_header .= "From: no-reply@courseenrollment.com " . "\r\n";

    $admin_subject = "New Course Enrollment";

    $admin_email_to = $admin->option_value;

    $admin_message = "\n\n\n\n\n
    <html>
    <head>
    <title>Course Enrollment</title>
    </head>
    <body>
    <p>NEW REGISTRATION!</p>
    
    <p>Visitor's IP: $pfw_ip</p>\n
    
    <p>Total Enrollment(s): ".($course_1)."</p>\n
    
    <table border='1' cellspacing='1' cellpadding='1' bgcolor='#f7f7f7'>
    
   <tr><td>Name:</td><td> ".$_POST['option_name']."</td></tr>\n
   
   <tr><td>Status:</td><td> ".$status."</td></tr>\n

    <tr><td>Email:</td><td>  ".$_POST['option_email']."</td></tr>\n

    <tr><td>Phone Number:</td><td> ".$_POST['option_phone']."</td></tr>\n

    <tr><td>Course Name:</td><td> ".$course_[1]."</td></tr>\n
    
    <tr><td>Course Date:</td><td> ".$course->course_date."</td></tr>\n
    
    <tr><td>Course Timing:</td><td> ".$course->course_time."</td></tr>\n
    
    <tr><td>Course Place:</td><td> ".$course->course_country.','.$course->course_city."</td></tr>\n
    
    <tr><td>Course Price:</td><td> ".$course->price."</td></tr>\n
    
    <tr><td>Course payment information:</td><td> ".$course->payment_info."</td></tr></table>
    
    <p>This message was sent through ".$blog->option_value."</p> \n\n
    
    </body>
    </html>\n\n\n";

    

    @mail($admin_email_to, $admin_subject ,$admin_message ,$pfw_header );
    
    
    //USER EMAIL

    $user_subject = "Course Enrollment";

    $user_email_to = $_POST['option_email'];
    
        $user_message = "\n\n\n\n\n
        <html>
        <head>
        <title>Course Enrollment</title>
        </head>
        <body>
        <p>Dear ".$_POST['option_name'].",\n</p>
        <p>Welcome to ".$blog->option_value."!\n\n\n</p>
        <p>Thank you for joining, your provided data listed below</P>
        <p>Visitor's IP: $pfw_ip</p>\n
        <p>Total Enrollment(s): ".($course_1)."</p>\n
        
        <table border='1' cellspacing='1' cellpadding='1' bgcolor='#f7f7f7'>
        
       <tr><td>Name:</td><td> ".$_POST['option_name']."</td></tr>\n
       
       <tr><td>Status:</td><td> ".$status."</td></tr>\n
    
        <tr><td>Email:</td><td>  ".$_POST['option_email']."</td></tr>\n
    
        <tr><td>Phone Number:</td><td> ".$_POST['option_phone']."</td></tr>\n
    
        <tr><td>Course Name:</td><td> ".$course_[1]."</td></tr>\n
        
        <tr><td>Course Date:</td><td> ".$course->course_date."</td></tr>\n
        
        <tr><td>Course Timing:</td><td> ".$course->course_time."</td></tr>\n
        
        <tr><td>Course Place:</td><td> ".$course->course_country.','.$course->course_city."</td></tr>\n
        
        <tr><td>Course Price:</td><td> ".$course->price."</td></tr>\n
        
        <tr><td>Course payment information:</td><td> ".$course->payment_info."</td></tr></table>
        
        <p>This message was sent through ".$blog->option_value."</p> \n\n
        
        </body>
        </html>\n\n\n";

    @mail($user_email_to, $user_subject ,$user_message ,$pfw_header );

    }

    public function user_excel($file)

    {

        global $PLUGIN_ADDRESS;?>

    <style type="text/css">

    #stylized{

    clear:both;

    margin-left:16px;

    width:125px;

    height:31px;

    background:#666666 url(img/button.png) no-repeat;

    text-align:center;

    line-height:31px;

    color:#FFFFFF;

    font-size:11px;

    font-weight:bold;

    }</style>

    <form action="<?php echo $PLUGIN_ADDRESS.'excel_user.php'?>" method="post" >

    <input type="hidden" name="course" value=""/>

    <input type="submit" name="excel" value="Download Excel Doc" id="stylized"/>

    </form>

    <?php  

    }

}

?>