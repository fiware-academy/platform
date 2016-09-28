<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle. If not, see <http://www.gnu.org/licenses/>.

/**
 *
 * @package theme_fiware
 * @copyright 2015 Nephzat Dev Team,nephzat.com
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

// Get the HTML for the settings bits.
$html = theme_fiware_get_html_for_settings ( $OUTPUT, $PAGE );

if (right_to_left ()) {
	$regionbsid = 'region-bs-main-and-post';
} else {
	$regionbsid = 'region-bs-main-and-pre';
}
echo $OUTPUT->doctype ();
require_once (dirname ( __FILE__ ) . '/includes/header.php');
?>
<!-- layout: frontpage.php -->
<!--Custom theme header -->
<div class="container-fluid">
	 <?php
		$toggleslideshow = theme_fiware_get_setting ( 'toggleslideshow' );
		if ($toggleslideshow == 1) {
			require_once (dirname ( __FILE__ ) . '/includes/slideshow.php');
		} else {
 // FIWARE academy way         	      	<img src="<?php
			
?>
        	<div class="theme-slider">
		<div id="home-page-carousel" class="carousel slide"
			data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<div class="carousel-overlay-content floating-left">
					<div class="content-wrap">
						<h2>FIWARE Academy</h2>
						<h4>Welcome to the FIWARE Academy, where you can find training
							courses, lessons and many other contents regarding FIWARE
							technology.</h4>

					</div>
				</div>
				<div class="carousel-overlay-content floating-left">
					<!-- 
					<div class="content-wrap">
						<div class="content-wrap banner"></div>

					</div>
					 -->
					 <img alt="FIWARE Academy" src="<?php echo $OUTPUT->pix_url('banner','theme');?>">
					<form method="get"
						action="<?php echo $CFG->wwwroot;?>/course/search.php"
						id="coursesearch">
						<fieldset class="coursesearchbox">
							<label for="coursesearchbox" style="color: #ffffff;">Search
								courses: </label><input type="text" value="" name="search"
								size="30" id="coursesearchbox"><input type="submit" value="Go">
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
       <?php }?>
</div>
<!--Custom theme slider-->

<!--Custom theme Who We Are block-->
<div id="page" class="container-fluid">
	<header id="page-header" class="clearfix">
        <?php echo $html->heading; ?>
        <div id="page-navbar" class="clearfix">
			<nav class="breadcrumb-nav"><?php echo $OUTPUT->navbar(); ?></nav>
			<div class="breadcrumb-button"><?php echo $OUTPUT->page_heading_button(); ?></div>
		</div>
		<div id="course-header">
        <?php echo $OUTPUT->course_header(); ?>
        </div>
	</header>

	<div id="page-content" class="row-fluid">
		<div class="reference bg-white">
			<h2>FIWARE GENERIC ENABLERS</h2>
			<p class="p">Generic Enablers (GE) offer a number of general-purpose
				functions, offered through well-defined APIs, easing development of
				smart applications in multiple sectors. They will set the
				foundations of the architecture associated to your application.</p>
			<p class="p">Specifications of FIWARE GE APIs are public and
				royalty-free. You can search for the open source reference
				implementation, as well as alternative implementations, of each
				FIWARE GE in the FIWARE Reference Architecture.</p>
			<p>Browse the FIWARE Academy and find training on FIWARE Enablers
				through the categories listed below or from the <a href="<?php echo $CFG->wwwroot;?>/course/index.php">COURSES</a></p>
			<ul>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=7"> <img
						src="<?php echo $OUTPUT->pix_url('apps','theme');?>">
						<h5>Architecture of Applications / Services Ecosystem and Delivery
							Framework</h5>
						<p>Co-create, publish, cross-sell and consume
							applications/services, addressing all business aspects.</p></a></li>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=4"> <img
						src="<?php echo $OUTPUT->pix_url('cloud','theme');?>">
						<h5>Cloud Hosting</h5>
						<p>Provides computation, storage and network resources to manage
							services.</p>
				</a></li>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=5"> <img
						src="<?php echo $OUTPUT->pix_url('data','theme');?>">
						<h5>Data/Context Management</h5>
						<p>Easing access, gathering, processing, publication and analysis
							of context information at large scale.</p>
				</a></li>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=9"> <img
						src="<?php echo $OUTPUT->pix_url('network','theme');?>">
						<h5>Advanced middleware and interfaces to Network and Devices
							(I2ND)</h5>
						<p>Build communication-efficient distributed applications, exploit
							advanced network capabilities and easily manage robotic devices.
						</p></a></li>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=6"> <img
						src="<?php echo $OUTPUT->pix_url('i_of_thinks','theme');?>">
						<h5>Internet of Things (IoT) Services Enablement</h5>
						<p>Make connected things available, searchable, accessible, and
							usable.</p>
				</a></li>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=8"> <img
						src="<?php echo $OUTPUT->pix_url('security','theme');?>">
						<h5>Security</h5>
						<p>Make delivery and usage of services trustworthy by meeting
							security and privacy requirements.</p>
				</a></li>
				<li><a
					href="<?php echo $CFG->wwwroot;?>/course/index.php?categoryid=12">
						<img src="<?php echo $OUTPUT->pix_url('avanced','theme');?>">
						<h5>Advanced Web-based User Interface</h5>
						<p>3D &amp; AR capabilities for web-based UI.</p>
				</a></li>
			</ul>
			<div style="clear: both"></div>
		</div>
        <?php
								$togglenavigator = theme_fiware_get_setting ( 'togglenavigator' );
								if ($togglenavigator != 1 || is_siteadmin ()) {
									echo $OUTPUT->blocks ( 'side-pre', 'span3' );
									?>
			<div id="<?php echo $regionbsid ?>" class="span9">
			<?php
									echo $courserenderer->new_courses ();
									echo $OUTPUT->course_content_header ();
									echo $OUTPUT->main_content ();
									echo $OUTPUT->course_content_footer ();
									?>
			</div>
		<?php }else{ ?>
			<div id="<?php echo $regionbsid ?>" class="just-content-wrapper">
			<?php
									echo $courserenderer->new_courses ();
									echo $OUTPUT->course_content_header ();
									echo $OUTPUT->main_content ();
									// echo $OUTPUT->course_content_footer();
									?>
			</div>
		<?php }?>
    </div>
</div>
<div class="reference">
	<ul>
		<li class="icon catalogue">
			<p>
				<a target="_new" href="http://catalogue.fiware.org/">Catalogue</a>
			</p>
		</li>
		<li class="icon tutorials">
			<p>
				<a target="_new"
					href="https://www.youtube.com/playlist?list=PLR9elAI9JscSOuSnwIkGzSVW1QKgfDk6d">Tutorials</a>
			</p>
		</li>
		<li class="icon community">
			<p>
				<a target="_new" href="https://www.fiware.org/fiware-community/">Community</a>
			</p>
		</li>
	</ul>
	<div style="clear: both"></div>
</div>
<?php  require_once(dirname(__FILE__) . '/includes/footer.php');  ?>
<!--Custom theme footer-->

</body>
</html>
