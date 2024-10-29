<?php 
class courses
{
    function course_list($course_edit){ 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $courses = $wpdb->get_results("SELECT * FROM $table_name");
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
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    	<thead>
     <tr>
     
        <th><b>Status</b></th>
        <th><b>Last Enrollmenet Date</b></th>
        <th><b>Name</b></th>
        <th><b>Type</b></th>
        <th><b>Category</b></th>
        <th><b>Duration</b></th>
        <th><b>Location</b></th>
        <th><b>Payment Info</b></th>
        <th><b>Price</b></th>
        <th width="10%"><b>Action</b></th>
     </tr>
    		</tr>
    	</thead>
    	<tfoot>
    		<tr>
        
    	<th><b>Status</b></td>
        <th><b>Last Enrollmene Date</b></th>
        <th><b>Name</b></th>
        <th><b>Type</b></th>
        <th><b>Category</b></th>
        <th><b>Duration</b></th>
        <th><b>Location</b></th>
        <th><b>Payment Info</b></th>
        <th><b>Price</b></th>
        <th width="10%"><b>Action</b></th>
    
    		</tr>
    	</tfoot>
        <tbody>		
    <?php
    foreach ($courses as $course) 
    {
    echo '
        <tr class="odd_gradeX">
            <td>'.$course->course_status.'</td>
            <td>'.$course->last_enrollment_date.'</td>
            <td>'.$course->course_name.'</td>
            <td>'.$course->type.'</td>
            <td>'.$course->category.'</td>
            <td>'.$course->course_duration.'</td>
            <td>'.$course->course_location.'</td>
            <td>'.$course->payment_info.'</td>
            <td>'.$course->price.'</td>
            <td width="10%"><a href="?page=COURSES&edit='.$course->id.'">Edit</a>|<a href="?page=COURSES&delete='.$course->id.'">Delete</a></td>
        </tr>
        ';
    }
    ?>
     	</tbody>
    </table>
    		</form> 
    </div>
    <?php ?>
    <?php }
    function course_list_location() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_courses";
        $locations = $wpdb->get_results("SELECT DISTINCT course_location from `$table_name`");
        ?>
    <div class="wrap">
    <div class="rightside">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
        <td class="contactDept"><b>Location</b></td>
        <td class="contactDept"><b>Course(s)</b></td>
        <td class="contactDept"><b>Action</b></td>
        </tr> 
     <?php 
    foreach ($locations as $location) 
    {
        $location_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name` WHERE course_location = '$location->course_location'"));
        echo '
        <tr>
        <td class="contact"><b>'.$location->course_location.'</b></td>
        <td class="contact"><b>'.$location_1.'</b></td>
        <td class="contact"><b><a href="?page=COURSES&view_location='.$location->course_location.'">View</b></td>
        </tr>';
    }
    ?>
    </table>
    </div>
    </div>
    <?php }
    function course_list_category() { 
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
        <td class="contactDept"><b>Category</b></td>
        <td class="contactDept"><b>Course(s)</b></td>
        <td class="contactDept"><b>Action</b></td>
        </tr> 
     <?php 
    foreach ($categorys as $category) 
    {
        $category_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name2` WHERE category = '$category->name'"));
            echo '
            <tr>
            <td class="contact"><b>'.$category->name.'</b></td>
            <td class="contact"><b>'.$category_1.'</b></td>
            <td class="contact"><b><a href="?page=COURSES&view_category='.$category->name.'">View</b></td>
            </tr>';
    }
    ?>
    </table>
    </div>
    </div>
    <?php }
    function course_before_submit() { ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        <tr>
            <td class="contactDept"><b>Course Status</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_status'] ?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Time</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_time_hour1'].'-'.$_POST['option_courses_time_hour2']?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Date</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_status'] ?></b></td>
        </tr>
        
        <tr>
            <td class="contactDept"><b>Course Last Enrollmenet Date</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_status'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Name</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_name'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Category</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_category'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Decscription</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_decscription'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Type</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_type'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Duration</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_duration'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Location</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_location'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Requirements</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_requirements'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Payment Info</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_paymentinfo']?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Course Price</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_price']?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>Other Content</b></td>
            <td class="contact"><b><?php echo $_POST['option_courses_content']?></b></td>
        </tr> 
    
    </table>
    </div>
    
    <script type="text/javascript">
      function askuser()
      {
       var answer="   "
       var answer=prompt("Do you like to Continue type (yes)?")
       if ( answer == "yes")
        {  
        }
        else
        {
          location = '<?php bloginfo('url'); ?>/wp-admin/admin.php?page=ADDCOURSES';  
        }
        }
      askuser();
    </script>
    <?php }
    function course_add()
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
        'course_status' => $_POST['option_courses_status'], 
        'course_time' => $_POST['option_courses_time_hour1'].'-'.$_POST['option_courses_time_hour2'], 
        'course_date' => $_POST['option_courses_date_year'].'-'.$_POST['option_courses_date_month'].'-'.$_POST['option_courses_date_day'], 
        'last_enrollment_date' => $_POST['option_courses_enrollment_year'].'-'.$_POST['option_courses_enrollment_month'].'-'.$_POST['option_courses_enrollment_day'], 
        'date_time' => current_time('mysql'), 
        'course_name' => $_POST['option_courses_name'], 
        'course_decscription' => $_POST['option_courses_decscription'], 
        'category' => $_POST['option_courses_category'], 
        'type' => $_POST['option_courses_type'], 
        'course_duration' => $_POST['option_courses_duration'], 
        'course_location' => $_POST['option_courses_location'], 
        'course_requirements' => $_POST['option_courses_requirements'], 
        'payment_info' => $_POST['option_courses_paymentinfo'], 
        'price' => $_POST['option_courses_price'], 
        'other_content' => $_POST['option_courses_content']));
        
        return($rows_affected);
        }
    }
    function course_update()
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
        $rows_affected = $wpdb->update( $table_name, 
        array(  
        'course_status' => $_POST['option_courses_status'], 
        'course_time' => $_POST['option_courses_time_hour1'].'-'.$_POST['option_courses_time_hour2'], 
        'course_date' => $_POST['option_courses_date_year'].'-'.$_POST['option_courses_date_month'].'-'.$_POST['option_courses_date_day'], 
        'last_enrollment_date' => $_POST['option_courses_enrollment_year'].'-'.$_POST['option_courses_enrollment_month'].'-'.$_POST['option_courses_enrollment_day'], 
        //'date_time' => current_time('mysql'), 
        'course_name' => $_POST['option_courses_name'], 
        'course_decscription' => $_POST['option_courses_decscription'], 
        'category' => $_POST['option_courses_category'], 
        'type' => $_POST['option_courses_type'], 
        'course_duration' => $_POST['option_courses_duration'], 
        'course_location' => $_POST['option_courses_location'], 
        'course_requirements' => $_POST['option_courses_requirements'], 
        'payment_info' => $_POST['option_courses_paymentinfo'], 
        'price' => $_POST['option_courses_price'], 
        'other_content' => $_POST['option_courses_content']),
        array('id' => $_POST['edited']));
        return($rows_affected);
        }
    }
    function course_form($course_edit)
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
    
    
       //script_datetime();
       //$page ="course_add_page";
       //add_action('wp_head', 'script_datetime' );  
       ?>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/uni-form.css" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/demo1.css" media="screen" rel="stylesheet"/>
    <form action="" class="uniForm" method="post">  
          <fieldsets>
            <h3><?php if(!$course_edit){?>Add New Course<?php }else{?>Edit Course<?php }?></h3>
            <div class="ctrlHolder">
              <label for="">Course Status</label>
              <select name="option_courses_status" id="" class="selectInput">
                <option data-default-value="Placeholder text" <?php if($course->course_status=="active") {?>selected=""<?php }?>>Active</option>
                <option data-default-value="Placeholder text" <?php if($course->course_status=="deactive") {?>selected=""<?php }?>>Deactive</option>
              </select>
            </div>
    
            <div class="ctrlHolder">
              <p class="label">
                <em>*</em> Course Date
              </p>
              <ul class="alternate">
              <?php $times = explode('-', $course->course_date);?>
              <li><label for="">Year <select id="" name="option_courses_date_year">
                <?php for ($i=2011; $i<=2050; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[0]==$i) {?>selected=""<?php }?>><?php echo $i?></option>
                <?php }?>
                </select></label></li>
                <li><label for="">Month <select id="" name="option_courses_date_month">
                <?php for ($i=1; $i<=12; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[1]==$i) {?>selected=""<?php }?>><?php echo $i?></option>
                <?php }?>
                </select></label></li>
                <li><label for="">Day <select id="" name="option_courses_date_day">
                <?php for ($i=1; $i<=30; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[2]==$i) {?>selected=""<?php }?>><?php echo $i?></option>
                <?php }?>
                </select></label></li>
              </ul>
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
              <p class="label">
                <em>*</em> Course Last Enrollmenet Date
              </p>
              <ul class="alternate">
              <?php $times = explode('-', $course->last_enrollment_date);?>
              <li><label for="">Year <select id="" name="option_courses_enrollment_year">
                <?php for ($i=2011; $i<=2050; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[0]==$i) {?>selected=""<?php }?>><?php echo $i?></option>
                <?php }?>
                </select></label></li>
                <li><label for="">Month <select id="" name="option_courses_enrollment_month">
                <?php for ($i=1; $i<=12; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[1]==$i) {?>selected=""<?php }?>><?php echo $i?></option>
                <?php }?>
                </select></label></li>
                <li><label for="">Day <select id="" name="option_courses_enrollment_day">
                <?php for ($i=1; $i<=30; $i++){?>
                <option data-default-value="Placeholder text" <?php if($times[2]==$i) {?>selected=""<?php }?>><?php echo $i?></option>
                <?php }?>
                </select></label></li>
              </ul>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Name</label>
              <input name="option_courses_name" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_name?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
            <div class="ctrlHolder">
              <p class="label">
                <em>*</em> Course Category
              </p>
                <select id="" name="option_courses_category">
                <?php
                $table_name = $wpdb->prefix . "tc_category";
                $categorys = $wpdb->get_results("SELECT id,name FROM $table_name WHERE status = 'active'");
                foreach ($categorys as $category) 
                {
                ?>
                <option data-default-value="Placeholder text" <?php if($category->name==$course->category) {?>selected=""<?php }?>><?php echo $category->name?></option>
                <?php }
                ?>
                </select>
                <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Decscription</label>
              <textarea name="option_courses_decscription" id="" rows="25" cols="25"><?php echo $course->course_decscription?></textarea>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Type</label>
              <input name="option_courses_type" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->type?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Duration</label>
              <input name="option_courses_duration" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_duration?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Location</label>
              <input name="option_courses_location" id="type" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $course->course_location?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Requirements</label>
              <textarea name="option_courses_requirements" id="" rows="25" cols="25"><?php echo $course->course_requirements?></textarea>
            </div>
            
            <div class="ctrlHolder">
              <label for="">Course Payment Info</label>
                <input size="35" maxlength="50" type="text" data-default-value="Placeholder text" name="option_courses_paymentinfo" value="<?php echo$course->payment_info ?>"/>
            
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Course Price</label>
              <input name="option_courses_price" id="" data-default-value="Placeholder text" size="35" maxlength="5000" type="text" class="textInput required validateInteger validateMin val-10 validateMax val-5000" value="<?php echo $course->price?>"/>
              <p class="formHint">A number that you like less than 5001</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Other Content</label>
              <textarea name="option_courses_content" id="" rows="50" cols="50"><?php echo $course->other_content?></textarea>
            </div>
    
          <div class="buttonHolder">
            <input type="hidden" name="edited" value="<?php echo $course->id ?>"/>
            <button type="submit" class="primaryAction" name="<?php if(!$course_edit){?>submit<?php }else{?>update<?php }?>"><?php if(!$course_edit){?>Submit<?php }else{?>Update<?php }?></button>
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
    function course_delete()
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
    function course_view_category()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_courses";
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE category = '".$_GET['view_category']."' ORDER BY course_name ASC");
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
    function course_excel($file)
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
    function register_courses() 
    { 
    ?>
    <div class="wrap">
    <?php
    if(isset($_POST['submit'])) 
    {
        if(($_POST['option_name']!='')&&
        ($_POST['option_email']!='')&&
        ($_POST['option_phone']!='')&&
        ($_POST['option_course'])!='')
        {
            global $wpdb;
            global $current_user;
            $table_name = $wpdb->prefix . "tc_users";
            $course_data = explode(",",$_POST['option_course']);
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE course_id = '".$course_data[0]."' AND name = '".$_POST['option_name']."'");
            $course = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name` WHERE course_id = '".$course_data[0]."'"));
            if($course<10)
            {
                if($courses)
                {
                    echo "<h3><font color='red'> You have already register this course </font></h3>";
                }
                else
                {
                    $status = 'active';
                    $update = $this->user_add($status);
                    if($update)
                    {
                        echo "<h3><font color='blue'> Course registered sucessfully </font></h3>";
                    }
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
                    if($update)
                    {
                        echo "<h3><font color='red'>Course vacancies Full you are register for waiting list </font></h3>";
                    }
                }
                
            }
        }
        else
        {
            echo "<h3><font color='red'> All fields must be filled </font></h3>";
        }
    }
        $this->script_userform();
        $this->user_form();
    ?>
    </div>
    <?php }

    function user_list1() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_users";
        $users = $wpdb->get_results("SELECT * FROM $table_name");
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
        			<h1>Enrollment</h1>
    			<form>
    			<div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    	<thead>
     <tr>
        <th><b>id</b></th>
        <th><b>Name</b></th>
        <th><b>Email</b></th>
        <th><b>Phone</b></th>
        <th><b>Course Name</b></th>
        <th><b>Status</b></th>
        <th><b>Action</b></th>
     </tr>
    	</thead>
    	<tfoot>
        <tr>
        <th><b>id</b></th>
        <th><b>Name</b></th>
        <th><b>Email</b></th>
        <th><b>Phone</b></th>
        <th><b>Course Name</b></th>
        <th><b>Status</b></th>
        <th><b>Action</b></th>
     </tr>
    	</tfoot>
        <tbody>
    		
    			<?php
    foreach ($users as $user) 
    {
    echo '
        <tr>
            <td class="contact" >'.$user->id.'</td>
            <td class="contact" >'.$user->name.'</td>
            <td class="contact" >'.$user->email.'</td>
            <td class="contact" >'.$user->phone.'</td>
            <td class="contact" >'.$user->course_name.'</td>
            <td class="contact" >'.$user->status.'</td>
            <td class="contact" ><a href=?page=USERS&delete='.$user->id.'>Delete</a></td>
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
     function user_list() { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_users";
        $users = $wpdb->get_results("SELECT DISTINCT name,status from `$table_name` ORDER BY name ASC");
            ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
     <?php  foreach ($users as $user1) 
            {
                $course_1 = $wpdb->get_var($wpdb->prepare("SELECT COUNT(*) from `$table_name` WHERE name = '$user1->name'"));
        
            ?>  
            <tr>
        <td class="contact"><b><?php echo $user1->name.' Courses('.$course_1.')'?></b></td>
        <td class="contact"><b><a href="?page=USERS&deleteall=<?php echo $user1->name?>">Delete</a></td>
        <td class="contact"><b><a href="?page=USERS&view=<?php echo $user1->name?>">View</a></td>
        <?php if($user1->status=="deactive")
        { ?>
        <td class="contact"><b><a href="?page=USERS&activate=<?php echo $user1->name?>">Activate</a></td>
        <?php } if($user1->status=="active") {?>
        <td class="contact"><b><a href="?page=USERS&deactivate=<?php echo $user1->name?>">Deactivate</a></td>
        <?php }?>
        <?php if($user1->status=="waiting") {?>
        <td class="contact"><b><a href="?page=USERS&activate=<?php echo $user1->name?>">Waiting</a></td>
        <?php }?>
            </tr>
    <?php }
    echo'</table>
    </div>';
    }
    function user_add($status)
    {
        global $wpdb;
        global $current_user;
        $course_data = explode(",",$_POST['option_course']);
        $table_name = $wpdb->prefix . "tc_users";
        $table_name2 = $wpdb->prefix . "tc_courses";
        $courses = $wpdb->get_results("SELECT * FROM $table_name2 WHERE id = '".$course_data[0]."'");
        $rows_affected = $wpdb->insert( $table_name, 
        array( 'id' => 'NULL', 
        'user_id' => $current_user->ID, 
        'name' => $_POST['option_name'], 
        'email' => $_POST['option_email'], 
        'phone' => $_POST['option_phone'], 
        'course_id' => $course_data[0], 
        'course_name' => $course_data[1], 
        'date_time' => current_time('mysql'), 
        'status' => $status ) );
        
        if($rows_affected)
        {
            $this->user_email();
            $this->admin_email();
        }
    }
    function user_add1($status)
    {
    
         global $wpdb;
        global $current_user;
        $table_name = $wpdb->prefix . "tc_users";
        $course_data = explode(",",$_POST['option_course']);
        $rows_affected = $wpdb->insert( $table_name,
        array( 'id' => 'NULL', 
        'user_id' => $current_user->ID, 
        'name' => $current_user->display_name, 
        'email' => $current_user->user_email, 
        'phone' => $_POST['option_phone'], 
        'course_id' => $course_data[0], 
        'course_name' => $course_data[1], 
        'date_time' => current_time('mysql'),  
        'status' => $status ));
        
        if($rows_affected)
        {
            $this->user_email();
            $this->admin_email();
        }
    }
    
    function user_info()
    {
    global $current_user;
        echo 'Username: ' . $current_user->user_login . '<br />';
        echo 'User email: ' . $current_user->user_email . '<br />';
        echo 'User first name: ' . $current_user->user_firstname . '<br />';
        echo 'User last name: ' . $current_user->user_lastname . '<br />';
        echo 'User display name: ' . $current_user->display_name . '<br />';
        echo 'User ID: ' . $current_user->ID . '<br />';
    }
    function user_form1() { 
            global $wpdb;
            global $PLUGIN_ADDRESS;
            ?>
    <form method="post" action="">
        <table class="form-table">
        
            <tr valign="top">
            <th scope="row">Phone</th>
            <td><input type="text" name="option_phone" value="<?php echo get_option('option_etc'); ?>" /></td>
            </tr>
            
            <tr valign="top">
            <th scope="row">Course</th>
            <td>
            <select name="option_course" onchange="showUser(this.value)">
            <?php
            $table_name = $wpdb->prefix . "tc_courses";
            $courses = $wpdb->get_results("SELECT id,course_name FROM $table_name WHERE course_status = 'active'");
            foreach ($courses as $c_select) 
            {
                echo"<option name='course_select' value='".$c_select->id."'>".$c_select->course_name."</option>";
            }
            ?>
            </select>
            </td>
            </tr>
                    
            <tr>
            <td><div id="txtHint"></div></td>
            </tr>
    
            </tr>
        </table>
        <p class="submit">
        <input type="submit" class="button-primary" name="submit" value="<?php _e('Save') ?>" />
        </p>
    
    </form>
    <?php }
    function user_form() {
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
    <?php }
    function user_login_form() {?>
    	      <form id="form" name="loginform" method="post" action="<?php echo get_settings('siteurl'); ?>/wp-login.php">
                <div id="stylized" class="myform">
                    <h1>Singn-in Form</h1>
                    <p>Enter username and password</p>
                    <label for="login">Login:</label>
        	        <input type="text" name="log" value="" id="login" /><br />
        	        <label for="password">Password:</label>
        	        <input type="password" name="pwd" value="" id="password" />
                    <button type="submit" name="submit" value="Login">Login</button>
                    <div class="spacer"></div>
        	        <div class="rememberme">
                    <label for="rememberme">Remember me <input name="rememberme" id="rememberme" type="checkbox" value="forever" /></label>
                    </div>
        	        <input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
        	        <p><?php wp_register('', ''); ?><br /> <a href="<?php bloginfo('wpurl'); ?>/wp-login.php?action=lostpassword">Lost your password?</a></p>
                </div>
    	      </form>
    <?php }
    function user_delete()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "tc_users";
        $courses = $wpdb->query("DELETE FROM $table_name where id= '".$_GET['delete']."'");
    }
    function user_deleteall()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "tc_users";
        $courses = $wpdb->query("DELETE FROM $table_name where name = '".$_GET['deleteall']."'");
    }
    function user_view()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_users";
            $users = $wpdb->get_results("SELECT * FROM $table_name WHERE name = '".$_GET['view']."' ORDER BY course_name ASC");
    ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
      <tr>
        <td class="contactDept"><b>Name</b></td>
        <td class="contactDept"><b>Course Name</b></td>
        <td class="contactDept"><b>Register Date</b></td>
        <td class="contactDept"><b>Status</b></td>
     </tr>
     <?php 
    foreach ($users as $user) 
    {
    echo '
        <tr>
            <td class="contact" >'.$user->name.'</td>
            <td class="contact" >'.$user->course_name.'</td>
            <td class="contact" >'.$user->date_time.'</td>
            <td class="contact" >'.$user->status.'</td>
        </tr>
        ';
    }
    ?>
    </table>
    </div>
    <?php
    }
    function user_status($set_id,$set_status)
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "tc_users";
        $wpdb->query("UPDATE $table_name SET status = '$set_status' WHERE name = '$set_id'");
    }
     function user_email()
    { 
        global $wpdb;
        $table_name = $wpdb->prefix . "options";
        $blogs = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'blogname'");
        foreach ($blogs as $blog){} 
        $course = explode(",", $_POST['option_courses']);
    
    // Receiving variables
    @$pfw_ip= $_SERVER['REMOTE_ADDR'];
    
    // Validation
    //Sending Email to form owner
    $pfw_header = "From: ".$blog->option_value."\n";
    $pfw_subject = "Course Enrollment";
    $pfw_email_to = $_POST['option_email'];
    $pfw_message = "Dear ".$_POST['option_name'].",\n"
    ."Welcome to ".$blog->option_value."!\n\n\n"
    ."Thank you for joining your provided data listed below\n"
    . "Visitor's IP: $pfw_ip\n"
    . "Name: ".$_POST['option_name']."\n"
    . "Email:  ".$_POST['option_email']."\n"
    . "Phone Number: ".$_POST['option_phone']."\n"
    . "Course: ".$course[1]."\n\n\n"
    . "This message was sent through ".$blog->option_value." \n\n";
    @mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header );
    //Sending auto respond Email to visitor
    //Available only in the full version
     }
     
    function admin_email()
    { 
        global $wpdb;
        $table_name = $wpdb->prefix . "options";
        $admins = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'admin_email'");
        $blogs = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'blogname'");
        foreach ($blogs as $blog){} 
        foreach ($admins as $admin){} 
        $course = explode(",", $_POST['option_courses']);
    
    // Receiving variables
    @$pfw_ip= $_SERVER['REMOTE_ADDR'];
    
    // Validation
    //Sending Email to form owner
    $pfw_header = "From: ".$blog->option_value."\n";
    $pfw_subject = "Course Enrollment";
    $pfw_email_to = $admin->option_value;
    $pfw_message = "NEW REGISTRATION!\n\n\n\n\n"
    . "Visitor's IP: $pfw_ip\n"
    . "Name: ".$_POST['option_name']."\n"
    . "Email:  ".$_POST['option_email']."\n"
    . "Phone Number: ".$_POST['option_phone']."\n"
    . "Course: ".$course[1]."\n\n\n"
    . "This message was sent through ".$blog->option_value." \n\n";
    @mail($pfw_email_to, $pfw_subject ,$pfw_message ,$pfw_header );
    //Sending auto respond Email to visitor
    //Available only in the full version
    }
    function user_excel($file)
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
    function category_list($course_edit) { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $categorys = $wpdb->get_results("SELECT * FROM $table_name");
    
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
        			<h1>Category</h1>
           
    			<form>
    			<div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    	<thead>
     <tr>
        <th><b>id</b></th>
        <th><b>Name</b></th>
        <th><b>Type</b></th>
        <th><b>Status</b></th>
        <th width="10%"><b>Action</b></th>
     </tr>
    		</tr>
    	</thead>
    	<tfoot>
    		<tr>
        <th><b>id</b></th>
        <th><b>Name</b></th>
        <th><b>Type</b></th>
        <th><b>Status</b></th>
        <th width="10%"><b>Action</b></th>
    		</tr>
    	</tfoot>
        <tbody>
    		
    			<?php
    foreach ($categorys as $category) 
    {
    echo '
        <tr class="odd_gradeX">
            <td>'.$category->id.'</td>
            <td>'.$category->name.'</td>
            <td>'.$category->type.'</td>
            <td>'.$category->status.'</td>
            <td width="10%"><a href="?page=CATEGORY&edit='.$category->id.'">Edit</a>|<a href="?page=CATEGORY&delete='.$category->id.'">Delete</a></td>
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
    function category_before_submit() { ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        
        <tr>
            <td class="contactDept"><b>Category Name</b></td>
            <td class="contact"><b><?php echo $_POST['option_category_name'] ?></b></td>
        </tr> 
            
        <tr>
            <td class="contactDept"><b>Category Type</b></td>
            <td class="contact"><b><?php echo $_POST['option_category_type'] ?></b></td>
        </tr> 
        
        <tr>
            <td class="contactDept"><b>CCategory Status</b></td>
            <td class="contact"><b><?php echo $_POST['option_category_status'] ?></b></td>
        </tr>
    
    </table>
    </div>
    
    <script type="text/javascript">
      function askuser()
      {
       var answer="   "
       var answer=prompt("Do you like to Continue type (yes)?")
       if ( answer == "yes")
        {  
        }
        else
        {
          location = '<?php bloginfo('url'); ?>/wp-admin/admin.php?page=CATEGORY';  
        }
        }
      askuser();
    </script>
    <?php }
    function category_add()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $category = $wpdb->get_results("SELECT * FROM $table_name WHERE course_name = '".$_POST['option_category_name']."'");
        if($category)
        {
            echo "<h3><font color='red'> Same name with location course already register</font></h3>";
            return(0);
        }
        else
        {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $rows_affected = $wpdb->insert( $table_name, 
        array( 
        'id' => 'NULL', 
        'name' => $_POST['option_category_name'], 
        'type' => $_POST['option_category_type'], 
        'status' => $_POST['option_category_status']));
        
        return($rows_affected);
        }
    }
    function category_update()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $category = $wpdb->get_results("SELECT * FROM $table_name WHERE category = '".$_POST['option_category_name']."'");
        if($category<1)
        {
            echo "<h3><font color='red'> Same name course already register</font></h3>";
            return(0);
        }
        else
        {
        $rows_affected = $wpdb->update( $table_name, 
        array(  
        'name' => $_POST['option_category_name'], 
        'type' => $_POST['option_category_type'], 
        'status' => $_POST['option_category_status']),
        array('id' => $_POST['edited']));
        return($rows_affected);
        }
    }
    function category_form($category_edit)
    {
            global $wpdb;
            global $PLUGIN_ADDRESS;
            if(!$category_edit)
            {}
            else{
            $table_name = $wpdb->prefix . "tc_category";
            $categorys = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".$category_edit."'");
            foreach($categorys as $category){}
            }
    
    
       //script_datetime();
       //$page ="course_add_page";
       //add_action('wp_head', 'script_datetime' );  
       ?>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/uni-form.css" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/demo1.css" media="screen" rel="stylesheet"/>
    <form action="" class="uniForm" method="post">  
          <fieldsets>
            <h3><?php if(!$category_edit){?>Add New Category<?php }else{?>Edit Course<?php }?></h3>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Category Name</label>
              <input name="option_category_name" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $category->name?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Category Type</label>
              <input name="option_category_type" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $category->type?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for="">Category Status</label>
              <select name="option_category_status" id="" class="selectInput">
                <option data-default-value="Placeholder text" <?php if($category->status=="active") {?>selected=""<?php }?>>Active</option>
                <option data-default-value="Placeholder text" <?php if($category->status=="deactive") {?>selected=""<?php }?>>Deactive</option>
              </select>
            </div>
    
          <div class="buttonHolder">
            <input type="hidden" name="edited" value="<?php echo $category->id ?>"/>
            <button type="submit" class="primaryAction" name="<?php if(!$category_edit){?>submit<?php }else{?>update<?php }?>"><?php if(!$category_edit){?>Submit<?php }else{?>Update<?php }?></button>
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
    function category_delete()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "tc_category";
        $wpdb->query("DELETE FROM $table_name where id= '".$_GET['delete']."'");
    }
    function categorye_view()
    {
            global $wpdb;
            $table_name = $wpdb->prefix . "tc_category";
            $courses = $wpdb->get_results("SELECT * FROM $table_name WHERE course_location = '".$_GET['view']."' ORDER BY course_name ASC");
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
    function category_excel($file)
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
    <form action="<?php echo $PLUGIN_ADDRESS.'excel_category.php'?>" method="post" >
    <input type="hidden" name="course" value=""/>
    <input type="submit" name="excel" value="Download Excel Doc" id="stylized"/>
    </form>
    <?php }
    function category_addbutton($file) {?>
    <form action="" method="GET" >
    <input type="hidden" name="page" value="CATEGORY"/>
    <input type="submit" name="new" value="Add new category" id="stylized"/>
    </form>
    <?php
    }
    function script_table($width)
    {
        echo '
        <STYLE type=text/css>
    table.contacts
    { width: '.$width.'px;
    background-color: #fafafa;
    border: 1px #000000 solid;
    border-collapse: collapse;
    border-spacing: 0px; }
    
    
    td.contactDept
    { background-color: #99CCCC;
    border: 1px #000000 solid;
    font-family: Verdana;
    font-weight: bold;
    font-size: 12px;
    color: #404040; }
    
    
    td.contact
    { border-bottom: 1px #6699CC dotted;
    text-align: left;
    font-family: Verdana, sans-serif, Arial;
    font-weight: normal;
    font-size: .7em;
    color: #404040;
    background-color: #fafafa;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 8px;
    padding-right: 0px; }
    </STYLE>';
    }
    function script_ajax()
    {
        global $PLUGIN_ADDRESS;
        echo '<SCRIPT type=text/javascript>
    function showUser(str)
    {
    if (str=="")
      {
      document.getElementById("txtHint").innerHTML="";
      return;
      } 
    if (window.XMLHttpRequest)
      {// code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
      }
    else
      {// code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
    xmlhttp.onreadystatechange=function()
      {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
        }
      }
    xmlhttp.open("GET","'.$PLUGIN_ADDRESS.'select_course.php?q="+str,true);
    xmlhttp.send();
    }
    </SCRIPT>';
    }
    function script_userform(){
        echo'
        <STYLE type=text/css>
    p, h1, form, button{border:0; margin:0; padding:0;}
    .spacer{clear:both; height:1px;}
    /* ----------- My Form ----------- */
    .myform{
    margin:0 auto;
    width:150px;
    padding:14px;
    }
    
    /* ----------- stylized ----------- */
    #stylized{
    border:solid 2px #b7ddf2;
    background:#ebf4fb;
    }
    #stylized h1 {
    font-size:14px;
    font-weight:bold;
    margin-bottom:8px;
    }
    #stylized p{
    font-size:11px;
    color:#666666;
    margin-bottom:20px;
    border-bottom:solid 1px #b7ddf2;
    padding-bottom:10px;
    }
    #stylized label{
    display:block;
    font-weight:bold;
    text-align:left;
    width:140px;
    float:left;
    }
    #stylized .small{
    color:#666666;
    display:block;
    font-size:11px;
    font-weight:normal;
    text-align:right;
    width:140px;
    }
    #stylized input{
    float:left;
    font-size:12px;
    padding:4px 2px;
    border:solid 1px #aacfe4;
    width:120px;
    margin:2px 0 20px 10px;
    }
    #stylized select{
    float:left;
    font-size:12px;
    padding:4px 2px;
    border:solid 1px #aacfe4;
    width:120px;
    margin:2px 0 20px 10px;
    }
    #stylized button{
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
    }
    </STYLE>';
    }
    function script_datetime()
    {
        global $PLUGIN_ADDRESS;
        $PLUGIN_ADDRESS_ = $PLUGIN_ADDRESS.'datepicker/';
        echo '
        <link rel="stylesheet" href="'.$PLUGIN_ADDRESS_.'css/jquery.ui.theme.css"  media="screen"/>
        <link rel="stylesheet" href="'.$PLUGIN_ADDRESS_.'css/jquery.ui.datepicker.css"  media="screen"/>
    	<script src="'.$PLUGIN_ADDRESS_.'js/jquery-1.6.2.js"></script>
    	<script src="'.$PLUGIN_ADDRESS_.'js/jquery.ui.core.js"></script>
    	<script src="'.$PLUGIN_ADDRESS_.'js/jquery.ui.widget.js"></script>
    	<script src="'.$PLUGIN_ADDRESS_.'js/jquery.ui.datepicker.js"></script>
    	<link rel="stylesheet" href="'.$PLUGIN_ADDRESS_.'css/demos.css"  media="screen"/>
    	<script>
    	$(function() {
    		$( "#datepicker" ).datepicker();
    		$( "#format" ).change(function() {
    			$( "#datepicker" ).datepicker( "option", "dateFormat", $( this ).val() );
    		});
    	});
    	</script>';
    }
    function script_sides()
    {
    echo'
    <style type="text/css">
    .rightside{
        float: right;
        margin-right: 5px 5px 5px;
    }
    .leftsidea{
        float:left;
        margin-right: 5px 5px 5px;
    }
    </style>';
    }
}?>