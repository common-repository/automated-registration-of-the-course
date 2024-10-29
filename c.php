<?php
function widget_courses($args) 
{
    global $course;

  extract($args);
  echo $before_widget;
  echo $before_title;?><?php echo $after_title;
    $course->script_ajax();
    $course->user_register_courses();
  echo $after_widget;
}
function courses_init()
{
  register_sidebar_widget(__('Register Courses'), 'widget_courses');
}
?>