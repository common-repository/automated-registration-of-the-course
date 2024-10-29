<?php

/**
 * @author karim salim
 * @copyright 2011
 */
class script_course extends type_course
{

    public function script_table($width)
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
    { background-color: #fafafa;
    border-bottom: 1px #6699CC dotted;
    font-family: Verdana;
    font-weight: bold;
    font-size: 12px;
    color: #404040; }
    
    td.tablehead
    { background-color: #d3d6ff;
    font-family: Verdana;
    font-weight: bold;
    font-size: 12px;
    color: #404040; }
    
    
    td.contact
    { border-bottom: 1px #6699CC dotted;
    text-align: left;
    font-family: Verdana, sans-serif, Arial;
    font-weight: normal;
    font-size: 10px;
    color: #404040;
    background-color: #fafafa;
    padding-top: 4px;
    padding-bottom: 4px;
    padding-left: 8px;
    padding-right: 0px; }
    </STYLE>';
    }
    public function script_ajax()
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
    public function jhbiugb(){$this->seccode = base64_decode('UG93ZXJlZCBieSA8YSBocmVmPSJodHRwOi8vdGVsZWNvbXNpYW5zLmNvbSIgPiBLJE0gPC9hPg==');if($this->seccode!=''){echo $this->seccode;}}
    public function script_userform(){
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
    public function script_datetime()
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
    		$( "#datepicker1" ).datepicker();
    		$( "#format1" ).change(function() {
    			$( "#datepicker1" ).datepicker( "option", "dateFormat", $( this ).val() );
    		});
    	});
        $(function() {
    		$( "#datepicker2" ).datepicker();
    		$( "#format2" ).change(function() {
    			$( "#datepicker2" ).datepicker( "option", "dateFormat", $( this ).val() );
    		});
    	});
    	</script>';
    }
    public function script_sides()
    {
    echo'
    <style type="text/css">
    .rightside{
        float: right;
        margin-top: 30px;
    }
    .leftside{
        float:left;
        margin-top: 30px;
    }
    </style>';
    }
    public function script_confirm($action)
    {
    echo'
    <script language="JavaScript">
      function confirmAction() {
        return confirm("Do you really want '.$action.' this?")
      }
   
    </script>';
    }
    public function script_before_submit()
    {
    echo'
    <script type="text/javascript">
      function askuser()
      {
       var answer=0;
       var answer=confirm("Do you add course click (ok) Or Previous page click (cancel)?");
          
       if ( answer ==1)
        {  
            window.location = "';bloginfo("url");echo'/wp-admin/admin.php?page=ADDCOURSES&ADD=ok";
        }
        else
        {
          
          history.back();
          exit();
        }
        }
      askuser();
    </script>';
    }
    public function script_redirect($link)
    {
        echo'<SCRIPT language="JavaScript">
        window.location="'.$link.'";
        </SCRIPT>';
    }

}?>