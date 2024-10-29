<?php
/**

 * @author karim salim

 * @copyright 2011

 */

class contact_course extends fileupload_course

{
    public function contact_list() { 

        global $wpdb;

        global $PLUGIN_ADDRESS;

        $table_name = $wpdb->prefix . "tc_contact";

        $users = $wpdb->get_results("SELECT * FROM $table_name  ORDER BY id DESC");

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

        			<h1>Contact</h1>

    			<form>

    			<div id="demo">

    <table cellpadding="0" cellspacing="0" border="2" class="display" id="example" style="width: 900px;">

    	<thead>

     <tr>


        <th><b>Name</b></th>

        <th><b>Email</b></th>

        <th><b>Phone</b></th>

        <th><b>Message</b></th>
        
        <th><b>Date</b></th>
        
        <th><b>Action</b></th>

     </tr>

    	</thead>

        <tbody>

    		

    			<?php

    foreach ($users as $user) 

    {

    echo '

        <tr>

            <td class="contact">'.$user->name.'</td>
            <td class="contact">'.$user->email.'</td>
            <td class="contact">'.$user->phone.'</td>
            <td class="contact">'.the_coures_content($user->comments,50).'</td>
            <td class="contact">'.$user->date_time.'</td>
            <td class="contact"><a href=?page=CONTACT&view='.$user->id.'>View</a> | <a href=?page=CONTACT&reply='.$user->id.'>Reply</a>| <a href=?page=CONTACT&delete='.$user->id.' onclick="return confirmAction()">Delete</a></td>

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

    public function contact_add()
    {

        global $wpdb;

        $table_name = $wpdb->prefix . "tc_contact";

            $rows_affected = $wpdb->insert( $table_name, 

            array( 'id' => 'NULL', 

            'name' => $_POST['option_name'], 

            'email' => $_POST['option_email'], 

            'phone' => $_POST['option_phone'], 

            'date_time' => current_time('mysql'), 

            'comments' => $_POST['option_comments']

            ));

        

        if($rows_affected)

        {

            
            //$this->contact_admin_email();

        }

    }

    

    function contact_register_courses_shortcodes() 

    { 

    if(isset($_POST['submit'])) 

    {

            //session_start();

        if($_SESSION['security_code'] == $_POST['option_captcha'])

        {

        if(($_POST['option_name']!='')&&

        ($_POST['option_email']!='')&&

        ($_POST['option_phone']!='')&&

        ($_POST['option_comments'])!='')

        {

                    $update = $this->contact_add();

                    echo "<h3><font color='blue'> Data submit sucessfully </font></h3>";

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

        $this->contact_form_shortcodes();

    ?>

    <?php }

    public function contact_form_shortcodes()

    {

            global $wpdb;

            global $PLUGIN_ADDRESS;

            if(isset($_GET['contact']))

            {

                $table_name = $wpdb->prefix . "tc_courses";

                $courses = $wpdb->get_results("SELECT id,course_name FROM $table_name WHERE id = '".base64_decode($_GET['contact'])."'");

                foreach ($courses as $course){} 

            }

       ?>

        <link href="<?php echo $PLUGIN_ADDRESS?>css/uni-form.css" media="screen" rel="stylesheet"/>

        <link href="<?php echo $PLUGIN_ADDRESS?>css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>

        <link href="<?php echo $PLUGIN_ADDRESS?>css/demo1.css" media="screen" rel="stylesheet"/>

    <form action="" class="uniForm" method="POST">  

          <fieldsets>

            <h2>Contact form</h2>

            

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

              <label for=""> Message</label>

              <textarea name="option_comments" id="" rows="20" cols="20"></textarea>

            </div>

            

            <div class="ctrlHolder">

              <label for=""><em>*</em> <img src="<?php echo $PLUGIN_ADDRESS?>captcha.php"/></label>

              <input name="option_captcha" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required"/>

              <p class="formHint">Add captcha code</p>

            </div>

            

          <div class="buttonHolder">

            <button type="submit" class="primaryAction" name="submit">Submit</button>

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

    public function contact_delete()

    {

        global $wpdb;

        $table_name = $wpdb->prefix . "tc_contact";

        $courses = $wpdb->query("DELETE FROM $table_name where id= '".$_GET['delete']."'");

    }

    public function contact_view()

    {

            global $wpdb;

            $table_name = $wpdb->prefix . "tc_contact";

            $users = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".$_GET['view']."'");

    foreach ($users as $user) 

    { ?>

    <div class="wrap">
    
    <h1>Contact (<?php echo $user->name ?>) Details</h1>
    
    <table class="contacts" cellspacing="1" summary="Contacts template">

    <tr>

        <td class="contactDept"><b>Name</b></td>
        <td class="contact" ><?php echo $user->name ?></td>

    </tr>
    
    <tr>

        <td class="contactDept"><b>Email</b></td>
        <td class="contact" ><?php echo $user->email ?></td>

    </tr>
    
    <tr>

        <td class="contactDept"><b>Phone</b></td>
        <td class="contact" ><?php echo $user->phone ?></td>

    </tr>
    <tr>

        <td class="contactDept"><b>DateTime</b></td>
        <td class="contact" ><?php echo $user->date_time ?></td>

    </tr>
    <tr>

        <td class="contactDept"><b>Message</b></td>
        <td class="contact" ><?php echo $user->comments ?></td>

    </tr>

    </table>

    </div>

    <?php }

    }
    public function contact_admin_email()

    { 

        global $wpdb;

        $table_name = $wpdb->prefix . "options";
        
        $admins = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'admin_email'");

        $blogs = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'blogname'");

        foreach ($blogs as $blog){} 

        foreach ($admins as $admin){} 

    // Receiving variables

    @$pfw_ip= $_SERVER['REMOTE_ADDR'];

    //OWNER EMAIL
                
    $pfw_header = "MIME-Version: 1.0" . "\r\n"; 
    $pfw_header .= "Content-type: text/html; charset=iso-8859-1rn"; 
    
    $pfw_header .= "From: no-reply@courseenrollment.com " . "\r\n";

    $admin_subject = "New Course Contact";

    $admin_email_to = $admin->option_value;

    $admin_message = "\n\n\n\n\n
    <html>
    <head>
    <title>Course Contact</title>
    </head>
    <body>
    <p>NEW CONTACT!</p>
    
    <p>Visitor's IP: $pfw_ip</p>\n
    
    <table border='1' cellspacing='1' cellpadding='1' bgcolor='#f7f7f7'>
    
   <tr><td>Name:</td><td> ".$_POST['option_name']."</td></tr>\n

    <tr><td>Email:</td><td>  ".$_POST['option_email']."</td></tr>\n

    <tr><td>Phone Number:</td><td> ".$_POST['option_phone']."</td></tr>\n
    
    <tr><td>Message:</td><td> ".$_POST['option_comments']."</td></tr>\n

    <p>This message was sent through ".$blog->option_value."</p> \n\n
    
    
    </body>
    </html>\n\n\n";

    

    @mail($admin_email_to, $admin_subject ,$admin_message ,$pfw_header );

    }
    public function contact_reply_email()

    { 

        global $wpdb;

        $table_name = $wpdb->prefix . "options";
        
        $admins = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'admin_email'");

        $blogs = $wpdb->get_results("SELECT * FROM $table_name WHERE option_name = 'blogname'");

        foreach ($blogs as $blog){} 

        foreach ($admins as $admin){} 

        // Receiving variables
    
        @$pfw_ip= $_SERVER['REMOTE_ADDR'];
    
        //OWNER EMAIL
                    
        $pfw_header = "MIME-Version: 1.0" . "\r\n"; 
        $pfw_header .= "Content-type: text/html; charset=iso-8859-1rn"; 
        
        $pfw_header .= "From: no-reply@courseenrollment.com " . "\r\n";
    
        $admin_subject = "Reply ".$blog->option_value;
    
        $admin_email_to = $_POST['option_contact_email'];
    
        $admin_message = $_POST['option_contact_comments'];
    
    
        $sent = @mail($admin_email_to, $admin_subject ,$admin_message ,$pfw_header );
    

    }
    
    function contact_reply($userid)
    {
     global $wpdb;
     global $PLUGIN_ADDRESS;
     $table_name = $wpdb->prefix . "tc_contact";
     $contacts = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '$userid'");
     foreach ($contacts  as $contact) 
     {
        
    ?>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/uni-form.css" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/default.uni-form.css" title="Default Style" media="screen" rel="stylesheet"/>
        <link href="<?php echo $PLUGIN_ADDRESS?>css/demo1.css" media="screen" rel="stylesheet"/>
        <form action="" class="uniForm" method="post">  
          <fieldsets>
            <h3>Reply (<?php echo $contact->name ?>)</h3>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em>Email</label>
              <input name="option_contact_email" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" value="<?php echo $contact->email?>" readonly="1"/>
            </div>
            
            <div class="ctrlHolder">
              <label for="">Message</label>
              <?php the_editor($contact->comments, "option_contact_comments", "", true) ?>
            </div>
    
          <div class="buttonHolder">
            <button type="submit" class="primaryAction" name="submit">Send</button>
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
    <?php
        }
    }

}

?>