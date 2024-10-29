<?php

/**
 * @author karim salim
 * @copyright 2011
 */

class category_course extends user_course
{
    public function category_list($course_edit) { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $categorys = $wpdb->get_results("SELECT * FROM $table_name");
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
        			<h1>Category</h1>
           
    			<form>
    			<div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    	<thead>
     <tr>
        <th><b>id</b></th>
        <th><b>Category Name</b></th>
        <th><b>Status</b></th>
        <th><b>Action</b></th>
     </tr>
    	</thead>
        <tbody>
    		
    			<?php
    foreach ($categorys as $category) 
    {
    echo '
        <tr class="odd_gradeX">
            <td>'.$category->id.'</td>
            <td>'.$category->category_name.'</td>
            <td>'.$category->status.'</td>
            <td><a href="?page=CATEGORY&edit='.$category->id.'">Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;
            <a href="?page=CATEGORY&delete='.$category->id.'" onclick="return confirmAction()">Delete</a></td>
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
    public function category_before_submit() { ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        
        <tr>
            <td class="contactDept"><b>Category Name</b></td>
            <td class="contact"><b><?php echo $_POST['option_category_name'] ?></b></td>
        </tr> 

        <tr>
            <td class="contactDept"><b>Category Status</b></td>
            <td class="contact"><b><?php echo $_POST['option_category_status'] ?></b></td>
        </tr>
    
    </table>
    </div>
    <?php 
        
        $this->script_before_submit();
    
    }
    public function category_add()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $category = $wpdb->get_results("SELECT * FROM $table_name WHERE category_name = '".$_POST['option_category_name']."'");
        if($category)
        {
            echo "<h3><font color='red'> Same name with Category already register</font></h3>";
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
        'category_name' => $_POST['option_category_name'], 
        'status' => $_POST['option_category_status']));
        
        return($rows_affected);
        }
    }
    public function category_update()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_category";
        $category = $wpdb->get_results("SELECT * FROM $table_name WHERE category = '".$_POST['option_category_name']."'");
        if($category<1)
        {
            echo "<h3><font color='red'> Same name category already register</font></h3>";
            return(0);
        }
        else
        {
        $rows_affected = $wpdb->update( $table_name, 
        array(  
        'category_name' => $_POST['option_category_name'], 
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
            <h3><?php if(!$category_edit){?>Add New Category<?php }else{?>Edit Category<?php }?></h3>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Category Name</label>
              <input name="option_category_name" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $category->category_name?>"/>
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
    public function category_addbutton($file) {?>
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
    <form action="" method="GET" >
    <input type="hidden" name="page" value="CATEGORY"/>
    <input type="submit" name="new" value="Add new category" id="stylized"/>
    </form>
    <?php
    }
}
?>