<?php

/**
 * @author karim salim
 * @copyright 2011
 */

class type_course extends category_course
{
    public function type_list($course_edit) { 
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_type";
        $types = $wpdb->get_results("SELECT * FROM $table_name");
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
        			<h1>Type</h1>
           
    			<form>
    			<div id="demo">
    <table cellpadding="0" cellspacing="0" border="0" class="display" id="example">
    	<thead>
     <tr>
        <th><b>id</b></th>
        <th><b>Type Name</b></th>
        <th><b>Status</b></th>
        <th><b>Action</b></th>
     </tr>
    	</thead>
        <tbody>
    		
    			<?php
    foreach ($types as $type) 
    {
    echo '
        <tr class="odd_gradeX">
            <td>'.$type->id.'</td>
            <td>'.$type->type_name.'</td>
            <td>'.$type->status.'</td>
            <td width="10%"><a href="?page=TYPE&edit='.$type->id.'">Edit</a>&nbsp;&nbsp;-&nbsp;&nbsp;
            <a href="?page=TYPE&delete='.$type->id.'" onclick="return confirmAction()">Delete</a></td>
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
    public function type_before_submit() { ?>
    <div class="wrap">
    <table class="contacts" cellspacing="0" summary="Contacts template">
        
        <tr>
            <td class="contactDept"><b>Type Name</b></td>
            <td class="contact"><b><?php echo $_POST['option_type_name'] ?></b></td>
        </tr> 
            
        <tr>
            <td class="contactDept"><b>Type Status</b></td>
            <td class="contact"><b><?php echo $_POST['option_type_status'] ?></b></td>
        </tr>
    
    </table>
    </div>
    <?php 
        $this->script_before_submit();
    }
    public function type_add()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_type";
        $category = $wpdb->get_results("SELECT * FROM $table_name WHERE type_name = '".$_POST['option_type_name']."'");
        if($category)
        {
            echo "<h3><font color='red'> Same name with Type already register</font></h3>";
            return(0);
        }
        else
        {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_type";
        $rows_affected = $wpdb->insert( $table_name, 
        array( 
        'id' => 'NULL', 
        'type_name' => $_POST['option_type_name'],  
        'status' => $_POST['option_type_status']));
        
        return($rows_affected);
        }
    }
    public function type_update()
    {
        global $wpdb;
        global $PLUGIN_ADDRESS;
        $table_name = $wpdb->prefix . "tc_type";
        $category = $wpdb->get_results("SELECT * FROM $table_name WHERE type_name = '".$_POST['option_category_name']."'");
        if($category<1)
        {
            echo "<h3><font color='red'> Same name Type already register</font></h3>";
            return(0);
        }
        else
        {
        $rows_affected = $wpdb->update( $table_name, 
        array(  
        'type_name' => $_POST['option_type_name'], 
        'status' => $_POST['option_type_status']),
        array('id' => $_POST['edited']));
        return($rows_affected);
        }
    }
    function type_form($type_edit)
    {
            global $wpdb;
            global $PLUGIN_ADDRESS;
            if(!$type_edit)
            {}
            else{
            $table_name = $wpdb->prefix . "tc_type";
            $types = $wpdb->get_results("SELECT * FROM $table_name WHERE id = '".$type_edit."'");
            foreach($types as $type){}
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
            <h3><?php if(!$type_edit){?>Add New Type<?php }else{?>Edit tYPE<?php }?></h3>
            
            <div class="ctrlHolder">
              <label for=""><em>*</em> Type Name</label>
              <input name="option_type_name" id="" data-default-value="Placeholder text" size="35" maxlength="50" type="text" class="textInput required" value="<?php echo $type->type_name?>"/>
              <p class="formHint">Required element</p>
            </div>
            
            <div class="ctrlHolder">
              <label for="">Type Status</label>
              <select name="option_type_status" id="" class="selectInput">
                <option data-default-value="Placeholder text" <?php if($type->status=="active") {?>selected=""<?php }?>>Active</option>
                <option data-default-value="Placeholder text" <?php if($type->status=="deactive") {?>selected=""<?php }?>>Deactive</option>
              </select>
            </div>
    
          <div class="buttonHolder">
            <input type="hidden" name="edited" value="<?php echo $type->id ?>"/>
            <button type="submit" class="primaryAction" name="<?php if(!$type_edit){?>submit<?php }else{?>update<?php }?>"><?php if(!$type_edit){?>Submit<?php }else{?>Update<?php }?></button>
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
    function type_delete()
    {
        global $wpdb;
        $table_name = $wpdb->prefix . "tc_type";
        $wpdb->query("DELETE FROM $table_name where id= '".$_GET['delete']."'");
    }
    public function type_addbutton($file) {?>
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
    <input type="hidden" name="page" value="TYPE"/>
    <input type="submit" name="new" value="Add new type" id="stylized"/>
    </form>
    <?php
    }
}
?>