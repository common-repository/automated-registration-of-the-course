<?php

/**

 * @author karim salim

 * @copyright 2011

 */

$PLUGIN_ADDRESS = plugins_url('/', __FILE__);
$course->courses_plugin_permalink();
$table_name = $wpdb->prefix . "tc_courses";

function courses_create_menu() 

{

	add_menu_page('Courses Plugin Settings', 'Courses', 'administrator','COURSES', 'courses_settings_page',plugins_url('/images/icon_course.gif', __FILE__));

    add_submenu_page('COURSES', 'Courses Plugin Settings', 'Add Courses', 'administrator','ADDCOURSES', 'courses_add_page');
    
    add_submenu_page('COURSES', 'Courses Plugin Settings', 'Category', 'administrator','CATEGORY', 'category_settings_page');
    
    add_submenu_page('COURSES', 'Courses Plugin Settings', 'Type', 'administrator','TYPE', 'type_settings_page');
    
    add_submenu_page('COURSES', 'Courses Plugin Settings', 'Contact', 'administrator','CONTACT', 'contact_settings_page');
    
    add_submenu_page('users.php', 'Your Courses', 'Your Courses', 'manage_options', 'YOURCOURSES', 'your_courses');

	

 }



function courses_add_page () 

{
    
    global $course;

    echo '<div class="wrap">';
    
    if($_GET['ADD']=='ok')
    {
        $rows_affected = $course->course_add();
            
            if($rows_affected)

            {

                echo "<h2><font color='green'>Courses Added</font></h2>";

            }
    }
    else
    {
        if(isset($_POST['submit'])) 
        {
            if(isset($_FILES['uploadfiles']))
            {
                $course->fileupload_process();
            }
            else
            {
                $_POST['upload_path'] = '';
            }
            
            $course->script_table(700);
            
    
            $submit = $course->course_before_submit();
    
    
        } 
    
        else 
    
        {
    
            $course->course_form('0');
    
        } 
    
        echo '</div>';
        //$course->jhbiugb();
    }

} 

function courses_settings_page()

{

    global $course;
    if(isset($_POST['update'])) 

    {

        $rows_affected = $course->course_update();

        if($rows_affected)

        {

            echo "<h2><font color='green'>Courses Updated</font></h2>";

        }

    }

    if(isset($_GET['delete']))

    {

        $course->course_delete();

    }

    if(isset($_GET['edit']))

    {



        $edit = $_GET['edit'];

        $course->course_form($edit);

    }

    elseif(isset($_GET['view_location']))

    {

        $width = 300;

        $course->script_table($width);

        $course->course_view_location();

    }

    elseif(isset($_GET['view_category']))

    {

        $width = 300;

        $course->script_table($width);

        $course->course_view_category();

    }
    
    elseif(isset($_GET['view_type']))

    {

        $width = 300;

        $course->script_table($width);

        $course->course_view_type();

    }
    
    elseif(isset($_GET['view_enrollment']))
    {
            
        global $course;
        if(isset($_GET['delete']))
    
        {
    
            $course->user_delete();
    
        }
    
        $width = 650;
    
        $course->script_table($width);
    
        if(isset($_GET['view']))
    
        {
    
            $course->user_view();
    
        }
    
        else
    
        {
            $course->user_list();
    
        } 

    }

    else

    {

        

            //$course->course_excel("");

            

            $edit = 0;

            $course->script_sides();
            
            $course->script_table('300');

            $course->course_list($sortby);

            //$course->course_list_location();
            
            echo '<div class="leftside">';

            $course->course_list_category();
            
            echo'</div>';
            
            echo '<div class="leftside">';
            
            $course->course_list_type();
            
            echo'</div>';

            

        

    }

        //$course->jhbiugb();

}

function category_settings_page()

{

    global $course;
    if(isset($_POST['update'])) 

    {

        $rows_affected = $course->category_update();

        if($rows_affected)

        {

            echo "<h2><font color='green'>Category Updated</font></h2>";

        }

    }

    elseif(isset($_GET['delete']))

    {

        $course->category_delete();

        $width = 300;

        $course->script_table($width);

        $course->category_list($sortby);



    }

    elseif(isset($_GET['edit']))

    {

        $edit = $_GET['edit'];

        $course->category_form($edit);



    }

    elseif(isset($_GET['new'])||isset($_POST['submit']))

    {

        echo '<div class="wrap">';

        if(isset($_POST['submit'])) 

        {

            //$width = 500;

            //$course->script_table($width);

            //$submit = $course->category_before_submit();

                $rows_affected = $course->category_add();

                if($rows_affected)

                {

                    echo "<h2><font color='green'>Category Added</font></h2>";

                }

        } 

        else 

        {

            $course->category_form('0');

        } 

        echo '</div>';

    }

    else

    {

        $course->script_sides();


            $width = 300;

            $course->script_table($width);

            $course->category_list($sortby);
            
            
            echo '<div class="leftside">';
    
            $course->category_addbutton("");
    
            echo '</div>';

    }
    //$course->jhbiugb();

        

}

function type_settings_page()

{

    global $course;
    if(isset($_POST['update'])) 

    {

        $rows_affected = $course->type_update();
        if($rows_affected)

        {

            echo "<h2><font color='green'>Type Updated</font></h2>";

        }

    }

    elseif(isset($_GET['delete']))

    {

        $course->type_delete();

        $width = 300;

        $course->script_table($width);

        $course->type_list($sortby);



    }

    elseif(isset($_GET['edit']))

    {

        $edit = $_GET['edit'];

        $course->type_form($edit);



    }

    elseif(isset($_GET['new'])||isset($_POST['submit']))

    {

        echo '<div class="wrap">';

        if(isset($_POST['submit'])) 

        {

            //$width = 500;

            //$course->script_table($width);

            //$submit = $course->type_before_submit();

                $rows_affected = $course->type_add();

                if($rows_affected)

                {

                    echo "<h2><font color='green'>Type Added</font></h2>";

                }

        } 

        else 

        {

            $course->type_form('0');

        } 

        echo '</div>';

    }

    else

    {

        $course->script_sides();

            $width = 300;

            $course->script_table($width);

            $course->type_list($sortby);
            
            echo '<div class="leftside">';

            $course->type_addbutton("");

            echo '</div>';

    }
    //$course->jhbiugb();

        

}
function contact_settings_page()
{
            global $course;
        if(isset($_GET['delete']))
    
        {
    
            $course->contact_delete();
    
        }
    
        $width = 650;
    
        $course->script_table($width);
    
        if(isset($_GET['view']))
    
        {
    
            $course->contact_view();
    
        }
        elseif(isset($_GET['reply']))
        {
            if(isset($_POST['submit']))
            {
                $course->contact_reply_email();
                echo "<h2><font color='green'>Email sent sucessfully.!</font></h2>";
            }
            else
            {
              $course->contact_reply($_GET['reply']);  
            }
        }
    
        else
    
        {
            $course->contact_list();
    
        } 

}
function your_courses()
{
        global $course;
        if(isset($_GET['delete']))
    
        {
    
            $course->user_delete();
    
        }
    
        $width = 650;
    
        $course->script_table($width);
    
        if(isset($_GET['view']))
    
        {
    
            $course->user_view();
    
        }
    
        else
    
        {
            $user_id = get_current_user_id();
            $course->user_list($user_id);
    
        }
}
?>