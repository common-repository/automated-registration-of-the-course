<?php

/**
 * @author karim salim
 * @copyright 2011
 */

add_shortcode( 'courseform', 'user_register_shortcodes' );

add_shortcode( 'course', 'courses_page_shortcodes' );

function user_register_shortcodes()
{
    global $course;
    $course->user_register_courses_shortcodes();
    //$course->user_register_courses();
}
function courses_page_shortcodes()
{
                $user_id = get_current_user_id();
                global $course;
                if(isset($_GET['course']))
                {
                    $course->script_table(700);
                    $course->course_view_shortcodes();
                }
                elseif(isset($_GET['enroll']))
                {
                    
                    if($user_id){
                    $course->user_register_courses_shortcodes();
                    }
                    else
                    {
                        echo"<h3 style='color:red;'>User must login for enroll!</h3>";  
                    }
                }
                elseif(isset($_GET['contact']))
                {
                    if($user_id){
                    $course->contact_register_courses_shortcodes();
                    }
                    else
                    {
                        echo"<h3 style='color:red;'>User must login for contact!</h3>";  
                    }
                }
                else
                {
                //$course->script_table(1003);
                //$edit = 0;
                //$course->script_sides();
                $course->course_list_shortcode();
                }
            
        
}

?>