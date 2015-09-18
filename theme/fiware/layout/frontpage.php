<?php
include "..lib/outputrenderers.php";
$hassidepre = $PAGE->blocks->region_has_content('side-pre', $OUTPUT);
$hassidepost = $PAGE->blocks->region_has_content('side-post', $OUTPUT);

$custommenu = $OUTPUT->custom_menu();
$hascustommenu = (empty($PAGE->layout_options['nocustommenu']) && !empty($custommenu));

$bodyclasses = array();
if ($hassidepre && !$hassidepost) {
    $bodyclasses[] = 'side-pre-only';
} else if ($hassidepost && !$hassidepre) {
    $bodyclasses[] = 'side-post-only';
} else if (!$hassidepost && !$hassidepre) {
    $bodyclasses[] = 'content-only';
} 

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes() ?>>
<head>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->pix_url('favicon', 'theme')?>" />
    <meta name="description" content="<?php p(strip_tags(format_text($SITE->summary, FORMAT_HTML))) ?>" />
    <?php echo $OUTPUT->standard_head_html() ?>    
	<link href="/theme/fiware/css/custom_style.css" rel="stylesheet" type="text/css">
	<script src="/theme/fiware/js/jquery.js"></script>
    <script type="text/javascript">
        window.onload = function()
        {
            if(!window.jQuery)
            {
                alert('jQuery not loaded');
            }
            else
            {
                $(document).ready(function(){
                    $('.yui3-widget-hd').tooltip({'placement':'top', 'trigger' : 'hover'});
                });
            }
        }
    </script>
	<link href="/theme/fiware/cookies/cookies_policy.css" rel="stylesheet" type="text/css">
    <script src="/theme/fiware/cookies/cookies_policy.js"></script>
</head>
<body id="<?php p($PAGE->bodyid) ?>" class="<?php p($PAGE->bodyclasses.' '.join(' ', $bodyclasses)) ?>">
<?php echo $OUTPUT->standard_top_of_body_html() ?>

<div id="page">

<!-- START OF HEADER -->
    <div id="page-header" class="clearfix">
		<div id="page-header-wrapper">
	        <div class="headerlogo"></div> 
            <div class="mac"></div>
    	    <div class="headermenu">
        		<?php
	        	    echo $OUTPUT->login_info();
    	        	echo $OUTPUT->lang_menu();
	        	    echo $PAGE->headingmenu;
		        ?>
	    	</div>
	    </div>
    </div>

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
	<li><a href="/mod/forum/view.php?id=1">News</a></li>
<?php
}
?>
        
        <!--<li><a href="/calendar/view.php?view=month">My Dates</a></li>
        <li><a href="/mod/assign/index.php?id=1">My Activities</a></li>-->
       </ul>
  	</div>
	<?php } ?>

<!-- END OF HEADER -->

<!-- START OF CONTENT -->

<div id="page-content-wrapper">
    <div id="page-content">
        <div id="region-main-box">
        			
            <div id="region-post-box">

                <div id="region-main-wrap">
                
                    <div id="region-main">
                        <div class="region-content">
                        	<div id="logininfo"> <?php  $realuser = session_get_realuser();
            							$fullname = fullname($realuser, true);
										;?>
                    			<h1 class="benvenuto">	<?php echo "Welcome   $fullname" ?> </div>
										
                    		</h1>
							<?php echo $OUTPUT->main_content() ?>
                        </div>
                    </div>
                </div>

                <?php if ($hassidepre) { ?>
                <div id="region-pre">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-pre') ?>
                    </div>
                </div>
                <?php } ?>

                <?php if ($hassidepost) { ?>
                <div id="region-post">
                    <div class="region-content">
                        <?php echo $OUTPUT->blocks_for_region('side-post') ?>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</div>

<!-- END OF CONTENT -->

<!-- START OF FOOTER -->

    <div id="page-footer">
        <div class="crediti">
        © 2014 FIWARE (Core Platform for the Future Internet)
        </div>

       
    </div>

<!-- END OF FOOTER -->

</div>
<?php echo $OUTPUT->standard_end_of_body_html() ?>
</body>
</html>