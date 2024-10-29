<?php

/**
 * @author karim salim
 * @copyright 2011
 */

class courses
{
    public function course_list_shortcode11()
    {
        
        
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $table_user = $wpdb->prefix . "tc_users";
        $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE course_status = 'active'  order by id desc");
        
        
    ?>
    <div class="wrap">
        	
     <?php
     foreach ($courses as $course) 
     {
        $enroll_reg = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from $table_user WHERE course_id = '$course->id'"));

        if($this->course_validation($course->last_enrollment_date,date("Y-m-d")))
        {
            
            $ok = $this->coures_image($course->upload);
        ?>
            <table style="text-align: left;margin-top:0px;margin-right:auto;margin-bottom:0px;margin-left:auto;clear:both;width:901px;color:rgb(85,85,85);font-family:'Lucida Grande',Verdana,Arial,sans-serif;font-size:12px;line-height:18px;background-color:rgb(255,255,255)" border="2" cellpadding="0" cellspacing="0">
        	<thead>
        	</thead>
        	<tbody><tr>
        		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px;" rowspan="5" width="147">
        		<img width="250px" src="<?php if($ok) {echo $course->upload;} else{echo $PLUGIN_ADDRESS.'images/noimg.jpg';}?>"alt=""/></td>
        		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px" rowspan="5">
            		<a style="color:rgb(85,119,153);text-decoration:none;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(238,238,238)" href="<?php echo $this->course_permalink(get_permalink(), 'course='.base64_encode($course->id)) ?>" target="_blank">
                        <font color="blue"><?php echo $course->course_name ?></font>
                    </a>&nbsp; 
                <p align="justify"><?php echo the_coures_content($course->course_decscription,400) ?></p>
        		<p align="right" style="margin-top: 30px;"><b>Enrollment(s) Limit:</b> <?php echo $course->total_enrollments ?> <b>Enrollment(s) Done:</b> <?php echo $enroll_reg ?></p>
                <p>
        		<font color="#FF0000">
        		<a href="<?php echo $this->course_permalink(get_permalink(), 'course='.base64_encode($course->id)) ?>" target="_blank">Read More</a></font></p>
                </td>
        		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px" width="29%">
        		<b>CourseDate</b>: <?php echo $course->course_date ?></td>
        
            	<tr>
            		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px" width="29%">
            		<b>CourseTime</b>: <?php echo $course->course_time ?></td>
            	</tr>
            	<tr>
            		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px" width="29%">
            		<b>Last enrollment date</b>: <?php echo $course->last_enrollment_date ?></td>
            	</tr>
            	<tr>
            		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px" width="29%">
            		<b>Price</b>:  <?php echo $course->price ?></td>
            	</tr>
            	<tr>
            		<td style="padding-top:3px;padding-right:10px;padding-bottom:3px;padding-left:10px" width="29%">
            		<a style="color:rgb(85,119,153);text-decoration:none;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(238,238,238)" href="<?php echo $this->course_permalink(get_permalink(), 'enroll='.base64_encode($course->id)) ?>" target="_blank">
            		<font color="red">Click here to enroll</font></a><br/>
                    <a style="color:rgb(85,119,153);text-decoration:none;border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:rgb(238,238,238)" href="<?php echo $this->course_permalink(get_permalink(), 'contact='.base64_encode($course->id)) ?>" target="_blank">
            		<font color="red">Click here to contact</font></a><p>&nbsp;</p></td>
            	</tr>
            </tbody>
            
            </table>
        <?php 
        }
            else
            {
                $rows_affected = $wpdb->update( $table_name, 
                array('course_status'=> 'archive'),
                array('id' => $course->id));
            }
        }
    ?>
    </div>
    <?php }
    
    public function course_list_shortcode()
    {
        
        
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE course_status = 'active'  order by id desc");
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
    			<form>
    <table cellpadding="0" cellspacing="0" border="2" class="display" id="example">
    	<thead>
     <tr>
     
        <th><b>Course Name</b></th>
        <th><b>Course Location</b></th>
        <th><b>Course Date</b></th>
        <th><b>Course Time</b></th>
        <th><b>Last Enrollmenet Date</b></th>
        <th  style="width:100px;"><b>Action</b></th>
     </tr>
    		</tr>
    	</thead>
        <tbody>	
        	
     <?php
     foreach ($courses as $course) 
     {
        
        if($this->course_validation($course->last_enrollment_date,date("Y-m-d")))
        {
        ?>
            <tr class="odd_gradeX">
                <td><a href="<?php echo $this->course_permalink(get_permalink(), 'course='.base64_encode($course->id)) ?>"><font color="blue"><?php echo $course->course_name ?></font></a></td>
                <td><?php echo $course->course_country.','.$course->course_city ?></td>
                <td><?php echo $course->course_date ?></td>
                <td>From <?php echo $course->course_time ?></td>
                <td><?php echo $course->last_enrollment_date ?></td>
                <td style="width:100px;"><a href="<?php echo $this->course_permalink(get_permalink(), 'enroll='.base64_encode($course->id)) ?>"><font color="red">Click here to enroll</font></a><br />
                <a href="<?php echo $this->course_permalink(get_permalink(), 'contact='.base64_encode($course->id)) ?>"><font color="red">Click here to Contact</font></a></td>
                
            </tr>
        <?php 
        }
        else
        {
            $rows_affected = $wpdb->update( $table_name, 
            array('course_status'=> 'archive'),
            array('id' => $course->id));
        }
    }
    ?>
     	</tbody>
    </table>
    		</form> 
    </div>
    <?php }
    
    public function course_list($course_edit){
        
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $courses = $wpdb->get_results("SELECT * FROM $table_name order by id desc");
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
        			<h1>Courses</h1>
           
    			<form>
                <div id="demo">
    <table cellpadding="0" cellspacing="0" border="2" class="display" id="example" style="width: 1800px;">
    	<thead>
     <tr>
        <th><b>Course Name</b></th>
        <th><b>Status</b></th>
        <th><b>Last Enrollment Date</b></th>
        <th><b>Course Type</b></th>
        <th><b>Course Category</b></th>
        <th><b>Duration</b></th>
        <th><b>Location</b></th>
        <th><b>Payment Info</b></th>
        <th><b>Price</b></th>
        <th><b>Enrollments Limit</b></th>
        <th width="10%"><b>Action</b></th>
     </tr>
    		</tr>
    	</thead>

        <tbody>		
    <?php
    foreach ($courses as $course) 
    {
    echo '
        <tr>
            <td class="contact"><a href ="?page=COURSES&view_enrollment='.$course->id.'" >'.$course->course_name.'</a></td>
            <td class="contact">'.$course->course_status.'</td>
            <td class="contact">'.$course->last_enrollment_date.'</td>
            <td class="contact">'.$course->type.'</td>
            <td class="contact">'.$course->category.'</td>
            <td class="contact">'.$course->course_duration.'</td>
            <td class="contact">'.$course->course_country.','.$course->course_city.'</td>
            <td class="contact">'.$course->payment_info.'</td>
            <td class="contact">'.$course->price.'</td>
            <td class="contact">'.$course->total_enrollments.'</td>
            <td  class="contact" width="10%"><a href="?page=COURSES&edit='.$course->id.'">Edit</a> | <a href="?page=COURSES&delete='.$course->id.'" onclick="return confirmAction()">Delete</a></td>
        </tr>
        ';
    }
    ?>
     	</tbody>
    </table>
    </div>
    		</form> 
    </div>
    <?php }
    public function course_list_location() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $locations = $wpdb->get_results("SELECT DISTINCT course_location from `$table_name`");
        ?>
    <div class="wrap">
    <div class="rightside">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
        <td class="tablehead"><b>Location</b></td>
        <td class="tablehead"><b>Course(s)</b></td>
        <td class="tablehead"><b>Action</b></td>
        </tr> 
     <?php 
    foreach ($locations as $location) 
    {
        $location_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name` WHERE course_location = '$location->course_location'"));
        echo '
        <tr>
        <td class="contact">'.$location->course_location.'</td>
        <td class="contact">'.$location_1.'</td>
        <td class="contact"><a href="?page=COURSES&view_location='.$location->course_location.'">View</a></td>
        </tr>';
    }
    ?>
    </table>
    </div>
    </div>
    <?php }
    public function course_list_category() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $table_name2 = $wpdb->prefix . "tc_courses";
        $categorys = $wpdb->get_results("SELECT * from `$table_name`");
        ?>
    <div class="wrap">
    <div class="leftside">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
        <td class="tablehead"><b>Category</b></td>
        <td class="tablehead"><b>Course(s)</b></td>
        <td class="tablehead"><b>Action</b></td>
        </tr> 
     <?php 
    foreach ($categorys as $category) 
    {
        $category_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name2` WHERE category = '$category->category_name'"));
            echo '
            <tr>
            <td class="contact">'.$category->category_name.'</td>
            <td class="contact">'.$category_1.'</td>
            <td class="contact"><a href="?page=COURSES&view_category='.$category->category_name.'">View</a></td>
            </tr>';
    }
    ?>
    </table>
    </div>
    </div>
    <?php }
    public function course_list_type() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_type";
        $table_name2 = $wpdb->prefix . "tc_courses";
        $types = $wpdb->get_results("SELECT * from `$table_name`");
        ?>
    <div class="wrap">
    <div class="leftside">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
        <td class="tablehead"><b>Type</b></td>
        <td class="tablehead"><b>Course(s)</b></td>
        <td class="tablehead"><b>Action</b></td>
        </tr> 
     <?php 
    foreach ($types as $type) 
    {
        $type_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name2` WHERE type = '$type->type_name'"));
            echo '
            <tr>
            <td class="contact">'.$type->type_name.'</td>
            <td class="contact">'.$type_1.'</td>
            <td class="contact"><a href="?page=COURSES&view_type='.$type->type_name.'">View</a></td>
            </tr>';
    }
    ?>
    </table>
    </div>
    </div>
    <?php }
    public function course_before_submit() { ?>
    <div class="wrap">
    
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
            <td class="contactDept"><b>Course Status</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_status'] = $_POST['option_courses_status'] ?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Time</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_time_hour'] = $_POST['option_courses_time_hour1'].'-'.$_POST['option_courses_time_hour2']?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Date</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_date'] = $_POST['option_courses_date']?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Last Enrollmenet Date</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_enrollment'] = $_POST['option_courses_enrollment'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Name</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_name'] = $_POST['option_courses_name'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Category</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_category'] = $_POST['option_courses_category'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Decscription</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_decscription'] = $_POST['option_courses_decscription'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Type</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_type'] = $_POST['option_courses_type'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Duration</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_duration'] = $_POST['option_courses_duration'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Country</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_country'] = $_POST['option_courses_country'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Zip</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_zip'] = $_POST['option_courses_zip'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course City</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_city'] = $_POST['option_courses_city'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Address</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_address'] = $_POST['option_courses_address'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Requirements</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_requirements'] = $_POST['option_courses_requirements'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Payment Info</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_paymentinfo'] = $_POST['option_courses_paymentinfo']?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Price</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_price'] = $_POST['option_courses_price']?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Other Content</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_content'] = $_POST['option_courses_content']?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Uploaded File path</b></td>
            <td class="contact"><b><?php echo $_SESSION['upload_path'] = $_POST['upload_path']?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Enrollments Limit</b></td>
            <td class="contact"><b><?php echo $_SESSION['option_courses_total_enroll'] = $_POST['option_courses_total_enroll']?></b></td>
        </tr>
        
        
        
    
    </table>
    </div>
    <?php 
        $this->script_before_submit();
    }
    
    public function course_view_shortcodes() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".base64_decode($_GET['course'])."'");
        foreach($courses as $course){}
        ?>
    <div class="wrap">
    <?php if($course->upload != '') {?>
    <h3><a href="<?php echo $course->upload ?>" >Click here</a> to download uploaded file related this course</h3>
    <?php }?>
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
            <td class="contactDept" width="30%"><b>Course Name</b></td>
            <td class="contact"><?php echo $course->course_name ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Status</b></td>
            <td class="contact"><?php echo $course->course_status ?></td>
        </tr>
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Time</b></td>
            <td class="contact"><?php echo $course->course_time ?></td>
        </tr>
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Date</b></td>
            <td class="contact"><?php echo $course->course_date ?></td>
        </tr>
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Last Enrollmenet Date</b></td>
            <td class="contact"><?php echo $course->last_enrollment_date ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Category</b></td>
            <td class="contact"><?php echo $course->category ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Decscription</b></td>
            <td class="contact"><?php echo $course->course_decscription ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Type</b></td>
            <td class="contact"><?php echo $course->type ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Duration</b></td>
            <td class="contact"><?php echo $course->course_duration ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Country</b></td>
            <td class="contact"><?php echo $course->course_country?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Zip</b></td>
            <td class="contact"><?php echo $course->course_zip ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course City</b></td>
            <td class="contact"><?php echo $course->course_city ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Address</b></td>
            <td class="contact"><?php echo $course->course_address ?></td>
        </tr> 
        <tr>
            <td class="contactDept" width="30%"><b>Course Requirements</b></td>
            <td class="contact"><?php echo $course->course_requirements ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Payment Info</b></td>
            <td class="contact"><?php echo $course->payment_info ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Course Price</b></td>
            <td class="contact"><?php echo $course->price ?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Other Content</b></td>
            <td class="contact"><?php echo $course->other_content?></td>
        </tr> 
        
        <tr>
            <td class="contactDept" width="30%"><b>Enrollents Limit</b></td>
            <td class="contact"><?php echo $course->total_enrollments ?></td>
        </tr>
        
        
    
    </table>
    </div>
    <?php }
    
    public function course_add()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $course = $wpdb->get_results("SELECT * FROM $table_name WHERE course_name = '".$_POST['option_courses_name']."' AND course_location = '".$_POST['option_courses_location']."'");
        if($course)
        {
            echo "<h3><font color='red'> Same name with location course already register</font></h3>";
            return(0);
        }
        else
        {
            global $wpdb;
            global $PLUGIN_ADDRESS;
            $table_name = $wpdb->prefix . "tc_courses";
            $rows_affected = $wpdb->insert( $table_name, 
            array( 
            'id' => 'NULL', 
            'course_status' => $_SESSION['option_courses_status'], 
            'course_time' => $_SESSION['option_courses_time_hour'], 
            'course_date' => $_SESSION['option_courses_date'], 
            'last_enrollment_date' => $_SESSION['option_courses_enrollment'], 
            'date_time' => current_time('mysql'), 
            'course_name' => $_SESSION['option_courses_name'], 
            'course_decscription' => $_SESSION['option_courses_decscription'], 
            'category' => $_SESSION['option_courses_category'], 
            'type' => $_SESSION['option_courses_type'], 
            'course_duration' => $_SESSION['option_courses_duration'], 
            'course_country' => $_SESSION['option_courses_country'], 
            'course_zip' => $_SESSION['option_courses_zip'], 
            'course_city' => $_SESSION['option_courses_city'], 
            'course_address' => $_SESSION['option_courses_address'], 
            'course_requirements' => $_SESSION['option_courses_requirements'], 
            'payment_info' => $_SESSION['option_courses_paymentinfo'], 
            'price' => $_SESSION['option_courses_price'], 
            'other_content' => $_SESSION['option_courses_content'],
            'upload' => $_SESSION['upload_path'],
            'total_enrollments' => $_SESSION['option_courses_total_enroll']));
            unset($_SESSION['option_courses_status']); 
            unset($_SESSION['option_courses_time_hour']); 
            unset($_SESSION['option_courses_date']);
            unset($_SESSION['option_courses_enrollment']); 
            unset($_SESSION['option_courses_name']);
            unset($_SESSION['option_courses_decscription']); 
            unset($_SESSION['option_courses_category']);
            unset($_SESSION['option_courses_type']);
            unset($_SESSION['option_courses_duration']);
            unset($_SESSION['option_courses_country']);
            unset($_SESSION['option_courses_zip']);
            unset($_SESSION['option_courses_city']);
            unset($_SESSION['option_courses_address']);
            unset($_SESSION['option_courses_requirements']);
            unset($_SESSION['option_courses_paymentinfo']);
            unset($_SESSION['option_courses_price']);
            unset($_SESSION['option_courses_content']);
            unset($_SESSION['upload_path']);
            unset($_SESSION['option_courses_total_enroll']);
            return($rows_affected);
        }
    }
    public function course_update()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $course = $wpdb->get_results("SELECT * FROM $table_name WHERE course_name = '".$_POST['option_courses_name']."'");
        if($course<1)
        {
            echo "<h3><font color='red'> Same name course already register</font></h3>";
            return(0);
        }
        else
        {
            if(isset($_FILES['uploadfiles']))
            {
                    $this->fileupload_process();
            }
            if($_POST['upload_path']=='')
            {
                $old_uploads = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".$_POST['edited']."'");
                foreach($old_uploads as $old_upload)
                {
                    $_POST['upload_path'] = $old_upload->upload;
                }
            }
        $rows_affected = $wpdb->update( $table_name, 
        array(  
        'course_status' => $_POST['option_courses_status'], 
        'course_time' => $_POST['option_courses_time_hour1'].' - '.$_POST['option_courses_time_hour2'], 
        'course_date' => $_POST['option_courses_date'], 
        'last_enrollment_date' => $_POST['option_courses_enrollment'], 
        //'date_time' => current_time('mysql'), 
        'course_name' => $_POST['option_courses_name'], 
        'course_decscription' => $_POST['option_courses_decscription'], 
        'category' => $_POST['option_courses_category'], 
        'type' => $_POST['option_courses_type'], 
        'course_duration' => $_POST['option_courses_duration'], 
        'course_country' => $_POST['option_courses_country'], 
        'course_zip' => $_POST['option_courses_zip'], 
        'course_city' => $_POST['option_courses_city'], 
        'course_address' => $_POST['option_courses_address'],
        'course_requirements' => $_POST['option_courses_requirements'], 
        'payment_info' => $_POST['option_courses_paymentinfo'], 
        'price' => $_POST['option_courses_price'], 
        'other_content' => $_POST['option_courses_content'],
        'upload' => $_POST['upload_path'],
        'total_enrollments' => $_POST['option_courses_total_enroll']),
        array('id' => $_POST['edited']));
        
        return($rows_affected);
        }
    }
    public function course_form($course_edit)
    {
            global $wpdb;
            global $PLUGIN_ADDRESS;
            if(!$course_edit)
            {}
            else{
            $table_name = $wpdb->prefix . "tc_courses";
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".$course_edit."'");
            foreach($courses as $course){}
            }
    
    $this->script_datetime(); 
    ?>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/uni-form.css" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/demo1.css" media="screen" rel="stylesheet"/>
        
    <form action="" class="uniForm" method="POST" enctype="multipart/form-data" accept-charset="utf-8">  
          <fieldsets>
            <h1><?php if(!$course_edit){?>Add New Course<?php }else{?>Edit Course<?php }?></h1>
            
            <div class="ctrlHolder">
              <label for="">Course Status</label>
              <select name="option_courses_status" id="" class="selectInput">
                <option data-default-value="Placeholder text" <?php if($course->course_status=="pending") {?>selected=""<?php }?>>Pending</option>
                <option data-default-value="Placeholder text" <?php if($course->course_status=="active") {?>selected=""<?php }?>>Active</option>
                <option data-default-value="Placeholder text" <?php if($course->course_status=="deactive") {?>selected=""<?php }?>>Deactive</option>
              </select>
            </div>
    
            <div class="ctrlHolder">
            <label for="">Course Date </label>
                <input name="option_courses_date" id="datepicker1" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_date?>"/>
            </div>
            
            
            
            <div class="ctrlHolder">
              <p class="label">
                <em>*</em> Course Time
              </p>
              <ul class="alternate">
              <?php $times = explode('-', $course->course_time);?>
              <li><label for="">Hours from<select id="" name="option_courses_time_hour1">
                <?php for ($i=1; $i<=24; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[0]==$i) {?>selected=""<?php }?> value="<?php echo $i?>:00"><?php echo $i?>:00</option>
                <?php }?>
                </select></label></li>
                <li><label for="">Hours to<select id="" name="option_courses_time_hour2">
                <?php for ($i=1; $i<=24; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[1]==$i) {?>selected=""<?php }?> value="<?php echo $i?>:00"><?php echo $i?>:00</option>
                <?php }?>
                </select></label></li>
                
              </ul>
            </div>
            
            <div class="ctrlHolder">
            <label for="">Course Last Enrollmenet Date </label>
                <input name="option_courses_enrollment" id="datepicker2" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->last_enrollment_date?>"/>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Name</label>
              <input name="option_courses_name" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_name?>"/>
              <p class="formHint">Required element</p>
            </div>

            <div class="ctrlHolder">
              <p class="label">
                <em>*</em> Course Category
              </p>
                <select id="" name="option_courses_category">
                <?php
                $table_name = $wpdb->prefix . "tc_category";
                $categorys = $wpdb->get_results("SELECT id,category_name FROM $table_name WHERE status = 'active'");
                foreach ($categorys as $category) 
                {
                ?>
                <option data-default-value="Placeholder text" <?php if($category->category_name==$course->category) {?>selected=""<?php }?>><?php echo $category->category_name?></option>
                <?php }
                ?>
                </select>
                <p class="formHint">Required element</p>
            </div>
            
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Decscription</label>
              <textarea name="option_courses_decscription" id="" rows="25" cols="25"><?php echo $course->course_decscription ?></textarea>
            </div>
            
            
            <div class="ctrlHolder">
              <p class="label">
                <em>*</em> Course Type
              </p>
                <select id="" name="option_courses_type">
                <?php
                $table_name = $wpdb->prefix . "tc_type";
                $types = $wpdb->get_results("SELECT id,type_name FROM $table_name WHERE status = 'active'");
                foreach ($types as $type) 
                {
                ?>
                <option data-default-value="Placeholder text" <?php if($type->type_name==$course->type) {?>selected=""<?php }?>><?php echo $type->type_name?></option>
                <?php }
                ?>
                </select>
                <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Duration</label>
              <input name="option_courses_duration" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_duration?>"/>
              <p class="formHint">Required element</p>
            </div>

            <div class="ctrlHolder">
              <label for=""><em>*</em> Counrty Name</label>
              <input name="option_courses_country" id="type" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_country?>"/>
                <p class="formHint">Required element</p>
            </div>
            
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> ZIP</label>
              <input name="option_courses_zip" id="type" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_zip?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> City</label>
              <input name="option_courses_city" id="type" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_city?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Address</label>
              <textarea name="option_courses_address" id="" rows="25" cols="25"><?php echo $course->course_address ?></textarea>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Requirements</label>
              <textarea name="option_courses_requirements" id="" rows="25" cols="25"><?php echo $course->course_requirements ?></textarea>
            </div>
            
            <div class="ctrlHolder">
              <label for="">Course Payment Info</label>
                <input  type="text" data-default-value="Placeholder text" class="textInput" name="option_courses_paymentinfo" value="<?php echo$course->payment_info ?>"/>
            
            </div>
            
            <div class="ctrlHolder">
              <label for=""> Course Price</label>
              <input name="option_courses_price" id="" data-default-value="Placeholder text" size="35" maxlength="5000" type="text" class="textInput" value="<?php echo $course->price?>"/>
            </div>
            
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Requirements</label>
              <textarea name="option_courses_content" id="" rows="25" cols="25"><?php echo $course->other_content ?></textarea>
            </div>
            
            <div class="ctrlHolder">
              <label for=""> Upload file</label>
            <input type="file" name="uploadfiles[]" id="uploadfiles" size="35" class="uploadfiles" />
            <?php if(!$course->upload==''){?><a href="<?php echo $course->upload?>" target="_blank"><font color="red"><b>Uploaded File</b></font></a>
            <?php } else{?><font color="red"><b>No file uploaded</b></font><?php }?>
            </div>
            
            
            <div class="ctrlHolder">
            <label for="">Course Enrollments Limit </label>
                <input name="option_courses_total_enroll" class="textInput required validateInteger" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->total_enrollments?>"/>
            </div>
            
    
          <div class="buttonHolder">
            <input type="hidden" name="edited" value="<?php echo $course->id ?>"/>
            <button type="submit" class="primaryAction" name="<?php if(!$course_edit){?>submit<?php }else{?>update<?php }?>"><?php if(!$course_edit){?>Submit<?php }else{?>Update<?php }?></button>
          </div>
          
        </fieldsets>
        </form>
        <script type="text/javascript" src=""></script>
        <script type="text/javascript" src="<?php echo $PLUGIN_ADDRESS?>js/uni-form-validation.jquery.js" charset="utf-8"></script>
        <script>
          $(function(){
            $('form.uniForm').uniform({
              prevent_submit : true
            });
          });
        </script>
    <?php }
    public function course_delete()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "tc_courses";
        $wpdb->query("DELETE FROM $table_name where id= '".$_GET['delete']."'");
    }
    function course_view_location()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_courses";
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE course_location = '".$_GET['view_location']."' ORDER BY course_name ASC");
            if($courses)
            {
    ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
      <tr>
        <td class="contactDept"><b>Location</b></td>
        <td class="contactDept"><b>Course</b></td>
        <td class="contactDept"><b>Register Date</b></td>
     </tr>
     <?php 
    foreach ($courses as $course) 
    {
    echo '
        <tr>
            <td class="contact" >'.$course->course_location.'</td>
            <td class="contact" >'.$course->course_name.'</td>
            <td class="contact" >'.$course->date_time.'</td>
        </tr>
        ';
    }
    ?>
    </table>
    </div>
    <?php
    
            }
            else
            {
                echo'<h2><font color="red">No records found</font></h2>';
            }
    
    }
    public function course_view_enrollment()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_users";
            $users = $wpdb->get_results("SELECT * FROM $table_name WHERE course_id = '".$_GET['view_enrollment']."' ORDER BY name ASC");
            
            if($users)
            {
    ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
      <tr>
        <td class="contactDept"><b>Course Name</b></td>
        <td class="contactDept"><b>Enroll Name</b></td>
        <td class="contactDept"><b>Enroll Email</b></td>
        <td class="contactDept"><b>Enroll Phone</b></td>
        <td class="contactDept"><b>Comments</b></td>
        <td class="contactDept"><b>Status</b></td>
        <td class="contactDept"><b>Register Date</b></td>
     </tr>
     <?php 
    foreach ($users as $user) 
    {
    echo '
        <tr>
            <td class="contact" >'.$user->course_name.'</td>
            <td class="contact" >'.$user->name.'</td>
            <td class="contact" >'.$user->email.'</td>
             <td class="contact" >'.$user->phone.'</td>
              <td class="contact" >'.$user->comments.'</td>
               <td class="contact" >'.$user->status.'</td>
            <td class="contact" >'.$user->date_time.'</td>
        </tr>
        ';
    }
    ?>
    </table>
    </div>
    <?php
                echo '<div class="leftside">';
                $this->enrollment_excel('Download Course ('.$user->course_name.') Excel Doc', $_GET['view_enrollment']);
                echo '</div>';
            }
            else
            {
                echo'<h2><font color="red">No records found</font></h2>';
            }
    } 
    public function course_view_category()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_courses";
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE category = '".$_GET['view_category']."' ORDER BY course_name ASC");
            if($courses)
            {
    ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
      <tr>
        <td class="contactDept"><b>Category</b></td>
        <td class="contactDept"><b>Course</b></td>
        <td class="contactDept"><b>Register Date</b></td>
     </tr>
     <?php 
    foreach ($courses as $course) 
    {
    echo '
        <tr>
            <td class="contact" >'.$course->category.'</td>
            <td class="contact" >'.$course->course_name.'</td>
            <td class="contact" >'.$course->date_time.'</td>
        </tr>
        ';
    }
    ?>
    </table>
    </div>
    <?php
            }
            else
            {
                echo'<h2><font color="red">No records found</font></h2>';
            }
    } 
    public function course_view_type()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_courses";
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '".$_GET['view_type']."' ORDER BY course_name ASC");
            if($courses)
            {
    ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
      <tr>
        <td class="contactDept"><b>Type</b></td>
        <td class="contactDept"><b>Course</b></td>
        <td class="contactDept"><b>Register Date</b></td>
     </tr>
     <?php 
    foreach ($courses as $course) 
    {
    echo '
        <tr>
            <td class="contact" >'.$course->type.'</td>
            <td class="contact" >'.$course->course_name.'</td>
            <td class="contact" >'.$course->date_time.'</td>
        </tr>
        ';
    }
    ?>
    </table>
    </div>
    <?php
           }
            else
            {
                echo'<h2><font color="red">No records found</font></h2>';
            }
    }
    public function course_excel($file)
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
    <form action="<?php echo $PLUGIN_ADDRESS.'excel_course.php'?>" method="post" >
    <input type="hidden" name="course" value=""/>
    <input type="submit" name="excel" value="Download Excel Doc" id="stylized"/>
    </form>
    <?php }
    public function enrollment_excel($file,$q)
    {
    global $PLUGIN_ADDRESS;?>
    <style type="text/css">
    #stylized{
    clear:both;
    margin-left:16px;
    height:31px;
    background:#666666 url(img/button.png) no-repeat;
    text-align:center;
    line-height:31px;
    color:#FFFFFF;
    font-size:11px;
    font-weight:bold;
    }</style>
    <form action="<?php echo $PLUGIN_ADDRESS.'excel_course.php'?>" method="GET" >
    <input type="hidden" name="q" value="<?php echo $q ?>"/>
    <input type="submit" name="excel" value="<?php echo $file?>" id="stylized"/>
    </form>
    <?php }
    public function course_validation($enrollment_date,$date)
    {
        $enrollment = explode('-',$enrollment_date);
        $now = explode('-',$date);
        //YEAR IS GREATER THEN  TODAY YEAR
        if($enrollment[0]>$now[0])
        {
          return TRUE;  
        }
        //YEAR IS EQUAL TO THEN  TODAY YEAR FUTHER CHECK MONTH, DAY
        elseif($enrollment[0]==$now[0])
        {
            //MONTH GREATER THAT TODAY MONTH
            if($enrollment[1]>$now[1])
            {
                return TRUE;
            }
            //MONTH EQUAL THAT TODAY MONTH FURTURE CHECK DAY
            elseif($enrollment[1]==$now[1])
            {
                //DAY GREATER OR EQUAL TO THAT TODAY DAY
                if($enrollment[2]>=$now[2])
                {
                    return TRUE;
                }
                //DAY IS LESS THAN TODAY DAY
                else
                {
                    return FALSE;
                }
            }
            //MONTH LESS THAT TODAY MONTH
            else
            {
                return FALSE;
            }
        }
        //YEAR IS LESS THEN TODAY YEAR
        else
        {
            return FALSE;
        }
    }
    public function course_permalink($link,$get)
    {
        $perma_link = FALSE;
        for($i=0; $i<=strlen($link); $i++)
        {
            if($link[$i]=='?')
            {
                $perma_link = TRUE;
            }
        }
        if($perma_link==TRUE)
        {
            return $link.'&'.$get;
        } 
        else
        {
            return $link.'?'.$get;
        }
    }
    public function coures_image($courseimg)
    {
        $img = explode('.',strtolower($courseimg));
        $last = 1-sizeof($img);
        $last =2;
        if($img[$last]=='jpg'||$img[$last]=='png'||$img[$last]=='gif'||$img[$last]=='jepg')
        {
                return TRUE;;
        }
        else
        {
                return FALSE;
        } 
    }
    public function courses_plugin_permalink()
    {
        global $PLUGIN_ADDRESS;
        global $course;
        $perm = explode('/',$PLUGIN_ADDRESS);
        if($perm[2]!='localhost')
        {
            $PLUGIN_ADDRESS = $course='';
        }
    }
}
?>