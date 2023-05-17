<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Welcome to JDC Management System</title>
    
	<!-- bootstrap -->
    <link href="<?php echo site_url(); ?>/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url(); ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo site_url(); ?>/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- bootsrap -->
    <link href="<?php echo site_url(); ?>/template/css/reset.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url(); ?>/template/css/text.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url(); ?>/template/css/grid.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url(); ?>/template/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url(); ?>/template/css/nav.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo site_url(); ?>/template/css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo site_url(); ?>/template/css/jquery.jqplot.min.css" rel="stylesheet" type="text/css"  />
    <link href="<?php echo site_url(); ?>/template/css/fancy-button/fancy-button.css" rel="stylesheet" type="text/css" />
    
    <!-- BEGIN: load jquery -->
   

	<link rel="stylesheet" href="<?php echo site_url(); ?>/css/datepicker.css" type="text/css" />
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css" />
	
   <!-- datepicker -->
    <!-- END: load jquery -->
    <!-- BEGIN: load jqplot -->
    <script src="<?php echo site_url(); ?>/template/js/jquery-1.6.4.min.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.core.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script> 
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.datepicker.min.js" type="text/javascript"></script>
   	<script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.progressbar.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/external/jquery.bgiframe-2.1.2.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.draggable.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.position.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.resizable.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.ui.dialog.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.effects.blind.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/jquery-ui/jquery.effects.explode.min.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/fancy-button/fancy-button.js" type="text/javascript"></script>
    <script src="<?php echo site_url(); ?>/template/js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    
    <script src="<?php echo site_url(); ?>/template/js/setup.js" type="text/javascript"></script>
   
    
   <script type="text/javascript">

        $(document).ready(function () {
            setupLeftMenu();
			setSidebarHeight();
			 $( "#datepicker" ).datepicker({
      			changeMonth: true,
      			changeYear: true,
                beforeShowDay: $.datepicker.noWeekends,
    		});
			//$( "#datepicker" ).datepicker( "option", "firstDay", 1 );
			//$( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" ); 

		if(jQuery('div').find('.message').length != 0)
        {
                jQuery('div.message').delay('2000').slideUp('200');
        }
		
        });
    </script>
   <style>
   a{text-decoration: none;}
   .ui-state-disabled{
    background: #CCE5FF;
    }
    .ui-state-hover{
        background: #CCE5FF;
    }
   </style>
   
    </head>
    <body>
   
    