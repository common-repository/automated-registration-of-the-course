<?php

/**
 * @author karim salim
 * @copyright 2011
 */
 function the_coures_content($content,$max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    //$content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      return $content;
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        return $content."...";
   }
   else {
      return $content;
   }
}
require 'functions/course.class.php';
require 'functions/user.class.php';
require 'functions/category.class.php';
require 'functions/type.class.php';
require 'functions/script.class.php';
require 'functions/upload.class.php';
require 'functions/contact.class.php';
?>