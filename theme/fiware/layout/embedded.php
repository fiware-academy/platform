<?php echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <title><?php echo $PAGE->title ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <?php echo $OUTPUT->standard_head_html() ?>
    <link href="/theme/fiware/css/custom_style.css" rel="stylesheet" type="text/css">
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">

<?php if ($hasheading || $hasnavbar) { ?>

    <div id="page-header" class="clearfix">
		<div id="page-header-wrapper">
  <div class="headerlogo"></div> 
            <div class="mac"></div>
	        <?php if ($hasheading) { ?>
    		    <div class="headermenu">
        			<?php
            			echo $OUTPUT->login_info();
		           		if (!empty($PAGE->layout_options['langmenu'])) {
		        	       	echo $OUTPUT->lang_menu();
			    	    }
    			       	echo $PAGE->headingmenu
        			?>
	        	</div>
	        <?php } ?>

	    </div>
    </div>

    <?php if ($hasheading) { ?>
      <?php if ($hascustommenu) { ?>
        <div id="custommenu"><?php echo $custommenu; ?></div>
      <?php } else { ?>
        <div id="page-navigation">
      <ul id="voci-menu" class="clearfix">
        <li><a href="/index.php/">Home</a></li>
        <li><a href="/course/index.php">Available Courses</a></li>
<?php
if (isloggedin () and !isguestuser()) {
?>
        <li><a href="/my/">My Courses</a></li>
<?php
}
?>
    
        <!--<li><a href="/calendar/view.php?view=month">My Dates</a></li>
        <li><a href="/mod/assign/index.php">My Activities</a></li>-->
        <li><a href="/mod/forum/view.php?id=1">News</a></li>
      </ul>
  	</div>
      </ul>
  	</div>
      <?php } ?>
	<?php } ?>

    <?php if (!empty($courseheader)) { ?>
    <div id="course-header"><?php echo $courseheader; ?></div>
    <?php } ?>

    <?php if ($hasnavbar) { ?>
	    <div class="navbar clearfix">
    	    <div class="breadcrumb"><?php echo $OUTPUT->navbar(); ?></div>            
        </div>
       	<div class="navbutton"> <?php echo $PAGE->button; ?></div>
    <?php } ?>

<?php } ?>
<!-- END OF HEADER -->

    <div id="content" class="clearfix">
        <?php echo $OUTPUT->main_content() ?>
    </div>
</div>
<!-- START OF FOOTER -->

 <div id="page-footer">
        <div class="crediti">
        © 2014 FIWARE (Core Platform for the Future Internet)
        </div></div>

</body>
</html>