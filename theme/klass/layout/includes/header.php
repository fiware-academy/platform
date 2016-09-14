<?php
$PAGE->requires->js('/theme/klass/javascript/bootstrap-carousel.js');
$PAGE->requires->js('/theme/klass/javascript/bootstrap-transition.js');
// Need to overload old css definitions
$PAGE->requires->css('/theme/klass/style/custom.css');
$courserenderer = $PAGE->get_renderer('core', 'course');

echo $OUTPUT->doctype() ?>
<html <?php echo $OUTPUT->htmlattributes(); ?>>
<head>
    <title><?php echo $OUTPUT->page_title(); ?></title>
    <link rel="shortcut icon" href="<?php echo $OUTPUT->favicon(); ?>" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <?php echo $OUTPUT->standard_head_html() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body <?php echo $OUTPUT->body_attributes(); ?>>
<?php 
echo $OUTPUT->standard_top_of_body_html();
//$surl = new moodle_url('/course/search.php');
?>
<header id="header">

	<div class="header-main">
	  <div class="header-main-content">
    	<div class="container-fluid">
    	<img class="pattern" src="http://edu.fiware.org/images/pattern.png">
      	<div class="row-fluid">
        	<div class="span6">
          	<div id="logo"><a href="<?php echo $CFG->wwwroot;?>"><img src="<?php echo $OUTPUT->pix_url('fiware_academy','theme');//get_logo_url(); ?>" alt="FIWARE Academy"></a></div>
          </div>
           <?php /* if(! $PAGE->url->compare($surl, URL_MATCH_BASE)): ?>
        	<div class="span6">
          	<div class="top-search">
           <form action="<?php echo new moodle_url('/course/search.php'); ?>" method="get">
              <input type="text" placeholder="<?php echo get_string('searchcourses'); ?>" name="search" value="">
              <input type="submit" value="Search">
           </form>    
            </div>
            <div class="clearfix"></div>
          </div>
           <?php endif; */?>  
        </div>
      </div>
    </div>
  
    <div class="header-main-menubar">
      <div class="navbar">
        <div class="navbar-inner">
          <div class="container">
            <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <a href="#" class="brand" style="display: none;">Title</a>
            <p class="navbar-text"><a href="<?php echo $CFG->wwwroot;?>"><i class="fa fa-home"></i>Home</a></p>
            <div class="nav-collapse collapse navbar-responsive-collapse">
              <p class="navbar-text"><a href="<?php echo $CFG->wwwroot;?>"><i class="fa fa-home"></i>Home</a></p>
              <?php echo $OUTPUT->custom_menu(); ?>
              <ul class="nav pull-right">
                  <li><?php echo $OUTPUT->page_heading_menu(); ?></li>
                  <?php if($CFG->branch < "28"): ?>
                   <li class="navbar-text"><?php echo $OUTPUT->login_info() ?></li>
                 <?php endif; ?> 
              </ul>
            </div>
            <div class="navbar-right">
		    <?php if($CFG->branch > "27"):
		   		echo $OUTPUT->user_menu();
		   	endif; ?> 
          </div>
        </div>
      </div>
    </div>
  </div>
  
</header>
<!--E.O.Header-->