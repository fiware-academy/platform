<?php
/**
 * @package    theme_klass
 * @copyright  2015 onwards Nephzat Dev Team (http://www.nephzat.com)
 * @authors    Nephzat Dev Team , nephzat.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
defined ( 'MOODLE_INTERNAL' ) || die ();

require_once ($CFG->dirroot . "/course/renderer.php");
class theme_klass_core_course_renderer extends core_course_renderer {
	public function new_courses() {
		/* New Courses */
		global $CFG, $OUTPUT;
		$new_course = get_string ( 'newcourses', 'theme_klass' );
		
		$header = '<div id="frontpage-course-list">
			<h2>' . $new_course . '</h2>
				<div class="courses frontpage-course-list-all">
					<div class="row-fluid">';
		
		$footer = '</div>
				</div>
		</div>';
		$co_cnt = 1;
		$content = '';
		
		if ($ccc = get_courses ( 'all', 'c.id DESC,c.sortorder ASC', 'c.id,c.shortname,c.visible' )) {
			foreach ( $ccc as $cc ) {
				if ($co_cnt > 8) {
					break;
				}
				if ($cc->visible == "0" || $cc->id == "1") {
					continue;
				}
				$course_id = $cc->id;
				$course = get_course ( $course_id );
				
				// $noimg_url = $OUTPUT->pix_url('no-image', 'theme');
				$noimg_url = $this->get_random_image ();
				$course_url = new moodle_url ( '/course/view.php', array (
						'id' => $course_id 
				) );
				
				if ($course instanceof stdClass) {
					require_once ($CFG->libdir . '/coursecatlib.php');
					$course = new course_in_list ( $course );
				}
				
				$img_url = '';
				$context = context_course::instance ( $course->id );
				
				foreach ( $course->get_course_overviewfiles () as $file ) {
					$isimage = $file->is_valid_image ();
					$img_url = file_encode_url ( "$CFG->wwwroot/pluginfile.php", '/' . $file->get_contextid () . '/' . $file->get_component () . '/' . $file->get_filearea () . $file->get_filepath () . $file->get_filename (), ! $isimage );
					if (! $isimage) {
						$img_url = $noimg_url;
					}
				}
				
				if (empty ( $img_url )) {
					$img_url = $noimg_url;
				}
				
				$content .= '<div class="span3">
			<div class="fp-coursebox">
				<div class="fp-coursethumb">
					<a href="' . $course_url . '">
						<img src="' . $img_url . '" width="243" height="165" alt="' . $course->fullname . '">
					</a>
				</div>
				<div class="fp-courseinfo">
					<h5><a href="' . $course_url . '">' . $course->fullname . '</a></h5>
						<div class="readmore"><a href="' . $course_url . '">Read more<i class="fa fa-angle-double-right"></i></a></div>
				</div>
			</div>
			</div>';
				
				if (($co_cnt % 4) == "0") {
					$content .= '<div class="clearfix hidexs"></div>';
				}
				
				$co_cnt ++;
			}
		}
		
		$course_html = $header . $content . $footer;
		$frontpage = isset ( $CFG->frontpage ) ? $CFG->frontpage : '';
		$frontpageloggedin = isset ( $CFG->frontpageloggedin ) ? $CFG->frontpageloggedin : '';
		
		$f1_pos = strpos ( $frontpage, '6' );
		$f2_pos = strpos ( $frontpageloggedin, '6' );
		$btn_html = '';
		if ($co_cnt <= 1 && ! $this->page->user_is_editing () && has_capability ( 'moodle/course:create', context_system::instance () )) {
			$btn_html = $this->add_new_course_button ();
		}
		
		if (! isloggedin () or isguestuser ()) {
			if ($f1_pos === false) {
				if ($co_cnt > 1) {
					echo $course_html;
				}
			}
		} else {
			if ($f2_pos === false) {
				echo $course_html . "<br/>" . $btn_html;
			}
		}
	}
	private function get_random_image() {
		$dire = "theme/klass/images/no-image/";
		$images = glob ( $dire . '*.{jpg,jpeg,png,gif}', GLOB_BRACE );
		return $images [array_rand ( $images )];
	}
	
	private function get_recursive_courses_count(coursecat $coursecat){
		$courses_count=$coursecat->get_courses_count();
		if($coursecat->has_children()){
			foreach($coursecat->get_children() as $cc){
				$courses_count+=$this->get_recursive_courses_count($cc);
			}
		}
		return $courses_count;
	}
	public function frontpage_available_courses() {
		/* available courses */
		global $CFG, $OUTPUT;
		require_once ($CFG->libdir . '/coursecatlib.php');
		
		$chelper = new coursecat_helper ();
		$chelper->set_show_courses ( self::COURSECAT_SHOW_COURSES_EXPANDED )->set_courses_display_options ( array (
				'recursive' => true,
				'limit' => $CFG->frontpagecourselimit,
				'viewmoreurl' => new moodle_url ( '/course/index.php' ),
				'viewmoretext' => new lang_string ( 'fulllistofcourses' ) 
		) );
		
		$chelper->set_attributes ( array (
				'class' => 'frontpage-course-list-all' 
		) );
		$courses = coursecat::get ( 0 )->get_courses ( $chelper->get_courses_display_options () );
		$totalcount = coursecat::get ( 0 )->get_courses_count ( $chelper->get_courses_display_options () );
		
		$course_ids = array_keys ( $courses );
		$new_course = get_string ( 'availablecourses' );
		
		$header = '<div id="frontpage-course-list">
			<h2>' . $new_course . '</h2>
				<div class="courses frontpage-course-list-all">
					<div class="row-fluid">';
		
		$footer = '</div>
				</div>
		</div>';
		$co_cnt = 1;
		$content = '';
		
		if ($ccc = get_courses ( 'all', 'c.sortorder ASC', 'c.id,c.shortname,c.visible' )) {
			foreach ( $course_ids as $course_id ) {
				$course = get_course ( $course_id );
				
				// $noimg_url = $OUTPUT->pix_url('no-image', 'theme');
				$noimg_url = $this->get_random_image ();
				$course_url = new moodle_url ( '/course/view.php', array (
						'id' => $course_id 
				) );
				
				if ($course instanceof stdClass) {
					require_once ($CFG->libdir . '/coursecatlib.php');
					$course = new course_in_list ( $course );
				}
				
				$img_url = '';
				$context = context_course::instance ( $course->id );
				
				foreach ( $course->get_course_overviewfiles () as $file ) {
					$isimage = $file->is_valid_image ();
					$img_url = file_encode_url ( "$CFG->wwwroot/pluginfile.php", '/' . $file->get_contextid () . '/' . $file->get_component () . '/' . $file->get_filearea () . $file->get_filepath () . $file->get_filename (), ! $isimage );
					if (! $isimage) {
						$img_url = $noimg_url;
					}
				}
				
				if (empty ( $img_url )) {
					$img_url = $noimg_url;
				}
				
				$content .= '<div class="span3">
				<div class="fp-coursebox">
					<div class="fp-coursethumb">
							<a href="' . $course_url . '">
								<img src="' . $img_url . '" width="243" height="165" alt="' . $course->fullname . '">
							</a>
						</div>
						<div class="fp-courseinfo">
							<h5><a href="' . $course_url . '">' . $course->fullname . '</a></h5>
							<div class="readmore"><a href="' . $course_url . '">Read more<i class="fa fa-angle-double-right"></i></a></div>
						</div>
					</div>
				</div>';
				
				if (($co_cnt % 4) == "0") {
					$content .= '<div class="clearfix hidexs"></div>';
				}
				
				$co_cnt ++;
			}
		}
		
		$course_html = $header . $content . $footer;
		echo $course_html;
		
		if (! $totalcount && ! $this->page->user_is_editing () && has_capability ( 'moodle/course:create', context_system::instance () )) {
			// Print link to create a new course, for the 1st available category.
			echo $this->add_new_course_button ();
		}
	}
	protected function render_custom_menu(custom_menu $menu) {
		require_once ($CFG->dirroot . '/course/lib.php');
		
		$branch = $menu->add ( get_string ( 'courses', 'theme_klass' ), null, null, 10000 );
		
		$categorytree = get_course_category_tree ();
		foreach ( $categorytree as $category ) {
			$this->add_category_to_custommenu ( $branch, $category );
		}
		
		return parent::render_custom_menu ( $menu );
	}
	protected function add_category_to_custommenu(custom_menu_item $parent, stdClass $category) {
		$branch = $parent->add ( $category->name, new moodle_url ( '/course/category.php', array (
				'id' => $category->id 
		) ) );
		if (! empty ( $category->categories )) {
			foreach ( $category->categories as $subcategory ) {
				$this->add_category_to_custommenu ( $branch, $subcategory );
			}
		}
		if (! empty ( $category->courses )) {
			foreach ( $category->courses as $course ) {
				$branch->add ( $course->shortname, new moodle_url ( '/course/view.php', array (
						'id' => $course->id 
				) ), $course->fullname );
			}
		}
	}
	
	/**
	 * Returns HTML to display a course category as a part of a tree
	 *
	 * This is an internal function, to display a particular category and all its contents
	 * use {@link core_course_renderer::course_category()}
	 *
	 * @param coursecat_helper $chelper
	 *        	various display options
	 * @param coursecat $coursecat        	
	 * @param int $depth
	 *        	depth of this category in the current tree
	 * @return string
	 */
	protected function coursecat_category(coursecat_helper $chelper, $coursecat, $depth) {
		// open category tag
		$classes = array (
				'category',
				'category-'.$depth
		);
		if (empty ( $coursecat->visible )) {
			$classes [] = 'dimmed_category';
		}
		/*
		 * if ($chelper->get_subcat_depth() > 0 && $depth >= $chelper->get_subcat_depth()) {
		 * // do not load content
		 * $categorycontent = '';
		 * $classes[] = 'notloaded';
		 * if ($coursecat->get_children_count() ||
		 * ($chelper->get_show_courses() >= self::COURSECAT_SHOW_COURSES_COLLAPSED && $coursecat->get_courses_count())) {
		 * $classes[] = 'with_children';
		 * $classes[] = 'collapsed';
		 * }
		 * } else {
		 * // load category content
		 * $categorycontent = $this->coursecat_category_content($chelper, $coursecat, $depth);
		 * $classes[] = 'loaded';
		 * if (!empty($categorycontent)) {
		 * $classes[] = 'with_children';
		 * }
		 * }
		 */
		// load category content
		//$categorycontent = $this->coursecat_category_content ( $chelper, $coursecat, $depth );
		//if (! empty ( $categorycontent )) {
		if($coursecat->get_children_count()>0 || $coursecat->get_courses_count()>0){
			$classes [] = 'with_children';
			//if ($depth > 1){
				$classes [] = 'notloaded';
				$classes [] = 'collapsed';
			//}else{
				//$classes [] = 'loaded';
			//}
		}
		//}
		
		// Make sure JS file to expand category content is included.
		$this->coursecat_include_js ();
		
		$content = html_writer::start_tag ( 'div', array (
				'class' => join ( ' ', $classes ),
				'data-categoryid' => $coursecat->id,
				'data-depth' => $depth,
				'data-showcourses' => $chelper->get_show_courses (),
				'data-type' => self::COURSECAT_TYPE_CATEGORY 
		) );
		
		// category name
		$categoryname = $coursecat->get_formatted_name ();
		// Here click on Category name to browse to category page
		/*
		$categoryname = html_writer::link ( new moodle_url ( '/course/index.php', array (
				'categoryid' => $coursecat->id 
		) ), $categoryname ,array ('title' => get_string ( 'browsetocategory' )));
		*/
		// Link to categoruy page
		$moreinfo .= html_writer::start_tag('div', array('class' => 'moreinfo'));
		if ($chelper->get_show_courses() < self::COURSECAT_SHOW_COURSES_EXPANDED) {
			$url = new moodle_url ( '/course/index.php', 
						array ('categoryid' => $coursecat->id),
						$categoryname ,array ('title' => get_string ( 'browsetocategory', 'theme_klass'  )));
			$image = html_writer::empty_tag('img', array('src' => $this->output->pix_url('e/fullpage'),
						'alt' => $this->strings->summary));
			$moreinfo .= html_writer::link($url, $image, array('title' => 'Browse to category' ));
			// Make sure JS file to expand course content is included.
			// UNUSED? $this->coursecat_include_js();
		}
		$moreinfo .= html_writer::end_tag('div'); // .moreinfo
		
		// Informations about course number
		$coursescount = $this->get_recursive_courses_count($coursecat);
		//if ($chelper->get_show_courses () == self::COURSECAT_SHOW_COURSES_COUNT && ($coursescount = $coursecat->get_courses_count ())) {
		if($coursescount>0){
			if($coursescount>1){
				$coursescount .= ' '.get_string ( 'courses', 'theme_klass'  );
			}else{
				$coursescount .= ' '.get_string ( 'course', 'theme_klass'  );
			}
			$coursescount = html_writer::tag ( 'span', ' (' . $coursescount . ')', array (
					'title' => get_string ( 'numberofcourses', 'theme_klass' ),
					'class' => 'numberofcourse' 
			) );
			$categoryname .= $coursescount;
		}
		$content .= html_writer::start_tag ( 'div', array (
				'class' => 'info'
		) );
		//*
		$content .= html_writer::tag ('div' , $categoryname, array ('class' => 'categoryname') );
		//$content .= $spancoursescount;
		/*/
		$content .= html_writer::tag ( ($depth > 1) ? 'h4' : 'h3', $categoryname, array (
				'class' => 'categoryname' 
		) );
		//*/         
		$content .= $moreinfo;
		$content .= html_writer::tag('div','',array('style'=>'clear:both'));
		$content .= html_writer::end_tag ( 'div' ); // .info
		// add category content to the output
		$content .= html_writer::tag ( 'div', $categorycontent, array (
				'class' => 'content' 
		) );
		
		$content .= html_writer::end_tag ( 'div' ); // .category
		                                         
		// Return the course category tree HTML
		return $content;
	}
	
	/**
	 * Renders HTML to display particular course category - list of it's subcategories and courses
	 *
	 * Invoked from /course/index.php
	 *
	 * @param int|stdClass|coursecat $category        	
	 */
	public function course_category($category) {
		global $CFG;
		require_once ($CFG->libdir . '/coursecatlib.php');
		$coursecat = coursecat::get ( is_object ( $category ) ? $category->id : $category );
		$site = get_site ();
		$output = '';
		
		if (can_edit_in_category ( $coursecat->id )) {
			// Add 'Manage' button if user has permissions to edit this category.
			$managebutton = $this->single_button ( new moodle_url ( '/course/management.php', array (
					'categoryid' => $coursecat->id 
			) ), get_string ( 'managecourses' ), 'get' );
			$this->page->set_button ( $managebutton );
		}
		$maincategorypage = (! $coursecat->id);
		if (! $coursecat->id) {
			if (coursecat::count_all () == 1) {
				// There exists only one category in the system, do not display link to it
				$coursecat = coursecat::get_default ();
				$strfulllistofcourses = get_string ( 'fulllistofcourses' );
				$this->page->set_title ( "$site->shortname: $strfulllistofcourses" );
			} else {
				$strcategories = get_string ( 'categories' );
				$this->page->set_title ( "$site->shortname: $strcategories" );
			}
		} else {
			$this->page->set_title ( "$site->shortname: " . $coursecat->get_formatted_name () );
			/*
			 * // Print the category selector
			 * $output .= html_writer::start_tag('div', array('class' => 'categorypicker'));
			 * $select = new single_select(new moodle_url('/course/index.php'), 'categoryid',
			 * coursecat::make_categories_list(), $coursecat->id, null, 'switchcategory');
			 * $select->set_label(get_string('categories').':');
			 * $output .= $this->render($select);
			 * $output .= html_writer::end_tag('div'); // .categorypicker
			 */
		}
		
		if (! $maincategorypage) {
			// Print current category name
			$output .= html_writer::start_div ( "categorylist" );
			$output .= html_writer::tag ( 'h2', str_replace ( "$site->shortname: ", "", $this->page->title ) );
			$output .= html_writer::end_div ();
		}
		// Print current category description
		$chelper = new coursecat_helper ();
		if ($description = $chelper->get_category_formatted_description ( $coursecat )) {
			$output .= $this->box ( $description, array (
					'class' => 'generalbox info' 
			) );
		}
		
		// Prepare parameters for courses and categories lists in the tree
		$chelper->set_show_courses ( self::COURSECAT_SHOW_COURSES_AUTO )->set_attributes ( array (
				'class' => 'category-browse category-browse-' . $coursecat->id 
		) );
		
		$coursedisplayoptions = array ();
		$catdisplayoptions = array ();
		$browse = optional_param ( 'browse', null, PARAM_ALPHA );
		$perpage = optional_param ( 'perpage', $CFG->coursesperpage, PARAM_INT );
		$page = optional_param ( 'page', 0, PARAM_INT );
		$baseurl = new moodle_url ( '/course/index.php' );
		if ($coursecat->id) {
			$baseurl->param ( 'categoryid', $coursecat->id );
		}
		if ($perpage != $CFG->coursesperpage) {
			$baseurl->param ( 'perpage', $perpage );
		}
		$coursedisplayoptions ['limit'] = $perpage;
		$catdisplayoptions ['limit'] = $perpage;
		if ($browse === 'courses' || ! $coursecat->has_children ()) {
			$coursedisplayoptions ['offset'] = $page * $perpage;
			$coursedisplayoptions ['paginationurl'] = new moodle_url ( $baseurl, array (
					'browse' => 'courses' 
			) );
			$catdisplayoptions ['nodisplay'] = true;
			$catdisplayoptions ['viewmoreurl'] = new moodle_url ( $baseurl, array (
					'browse' => 'categories' 
			) );
			$catdisplayoptions ['viewmoretext'] = new lang_string ( 'viewallsubcategories' );
		} else if ($maincategorypage || $browse === 'categories' || ! $coursecat->has_courses ()) {
			$catdisplayoptions ['offset'] = $page * $perpage;
			$catdisplayoptions ['paginationurl'] = new moodle_url ( $baseurl, array (
					'browse' => 'categories' 
			) );
			if ($maincategorypage) {
				$coursedisplayoptions ['nodisplay'] = true;
			} else {
				$coursedisplayoptions ['offset'] = $page * $perpage;
				$coursedisplayoptions ['paginationurl'] = new moodle_url ( $baseurl, array (
						'browse' => 'courses' 
				) );
				/*
				 * $coursedisplayoptions ['viewmoreurl'] = new moodle_url ( $baseurl, array (
				 * 'browse' => 'courses'
				 * ) );
				 * $coursedisplayoptions ['viewmoretext'] = new lang_string ( 'viewallcourses' );
				 */
			}
		} else {
			// we have a category that has both subcategories and courses, display pagination separately
			$coursedisplayoptions ['viewmoreurl'] = new moodle_url ( $baseurl, array (
					'browse' => 'courses',
					'page' => 1 
			) );
			$catdisplayoptions ['viewmoreurl'] = new moodle_url ( $baseurl, array (
					'browse' => 'categories',
					'page' => 1 
			) );
		}
		$chelper->set_categories_display_options ( $catdisplayoptions );
		$chelper->set_courses_display_options ( $coursedisplayoptions );
		// Add course search form.
		$output .= $this->course_search_form ();
		// Display course category tree.
		$output .= $this->coursecat_tree ( $chelper, $coursecat, $maincategorypage );
		
		// Add action buttons
		$output .= $this->container_start ( 'buttons' );
		$context = get_category_or_system_context ( $coursecat->id );
		if (has_capability ( 'moodle/course:create', $context )) {
			// Print link to create a new course, for the 1st available category.
			if ($coursecat->id) {
				$url = new moodle_url ( '/course/edit.php', array (
						'category' => $coursecat->id,
						'returnto' => 'category' 
				) );
			} else {
				$url = new moodle_url ( '/course/edit.php', array (
						'category' => $CFG->defaultrequestcategory,
						'returnto' => 'topcat' 
				) );
			}
			$output .= $this->single_button ( $url, get_string ( 'addnewcourse' ), 'get' );
		}
		ob_start ();
		if (coursecat::count_all () == 1) {
			print_course_request_buttons ( context_system::instance () );
		} else {
			print_course_request_buttons ( $context );
		}
		$output .= ob_get_contents ();
		ob_end_clean ();
		$output .= $this->container_end ();
		
		return $output;
	}
	
	/**
	 * Renders the list of courses
	 *
	 * This is internal function, please use {@link core_course_renderer::courses_list()} or another public
	 * method from outside of the class
	 *
	 * If list of courses is specified in $courses; the argument $chelper is only used
	 * to retrieve display options and attributes, only methods get_show_courses(),
	 * get_courses_display_option() and get_and_erase_attributes() are called.
	 *
	 * @param coursecat_helper $chelper
	 *        	various display options
	 * @param array $courses
	 *        	the list of courses to display
	 * @param int|null $totalcount
	 *        	total number of courses (affects display mode if it is AUTO or pagination if applicable),
	 *        	defaulted to count($courses)
	 * @return string
	 */
	protected function coursecat_courses(coursecat_helper $chelper, $courses, $totalcount = null) {
		global $CFG;
		if ($totalcount === null) {
			$totalcount = count ( $courses );
		}
		if (! $totalcount) {
			// Courses count is cached during courses retrieval.
			return '';
		}
		
		if ($chelper->get_show_courses () == self::COURSECAT_SHOW_COURSES_AUTO) {
			// I want always collapsed courses list
			$chelper->set_show_courses ( self::COURSECAT_SHOW_COURSES_COLLAPSED );
		}
		
		// prepare content of paging bar if it is needed
		$paginationurl = $chelper->get_courses_display_option ( 'paginationurl' );
		$paginationallowall = $chelper->get_courses_display_option ( 'paginationallowall' );
		if ($totalcount > count ( $courses )) {
			// there are more results that can fit on one page
			if ($paginationurl) {
				// the option paginationurl was specified, display pagingbar
				$perpage = $chelper->get_courses_display_option ( 'limit', $CFG->coursesperpage );
				$page = $chelper->get_courses_display_option ( 'offset' ) / $perpage;
				$pagingbar = $this->paging_bar ( $totalcount, $page, $perpage, $paginationurl->out ( false, array (
						'perpage' => $perpage 
				) ) );
				if ($paginationallowall) {
					$pagingbar .= html_writer::tag ( 'div', html_writer::link ( $paginationurl->out ( false, array (
							'perpage' => 'all' 
					) ), get_string ( 'showall', '', $totalcount ) ), array (
							'class' => 'paging paging-showall' 
					) );
				}
			} else if ($viewmoreurl = $chelper->get_courses_display_option ( 'viewmoreurl' )) {
				// the option for 'View more' link was specified, display more link
				$viewmoretext = $chelper->get_courses_display_option ( 'viewmoretext', new lang_string ( 'viewmore' ) );
				$morelink = html_writer::tag ( 'div', html_writer::link ( $viewmoreurl, $viewmoretext ), array (
						'class' => 'paging paging-morelink' 
				) );
			}
		} else if (($totalcount > $CFG->coursesperpage) && $paginationurl && $paginationallowall) {
			// there are more than one page of results and we are in 'view all' mode, suggest to go back to paginated view mode
			$pagingbar = html_writer::tag ( 'div', html_writer::link ( $paginationurl->out ( false, array (
					'perpage' => $CFG->coursesperpage 
			) ), get_string ( 'showperpage', '', $CFG->coursesperpage ) ), array (
					'class' => 'paging paging-showperpage' 
			) );
		}
		
		// display list of courses
		$attributes = $chelper->get_and_erase_attributes ( 'courses' );
		$content = html_writer::start_tag ( 'div', $attributes );
		
		if (! empty ( $pagingbar )) {
			$content .= $pagingbar;
		}
		
		$coursecount = 0;
		foreach ( $courses as $course ) {
			$coursecount ++;
			$classes = ($coursecount % 2) ? 'odd' : 'even';
			if ($coursecount == 1) {
				$classes .= ' first';
			}
			if ($coursecount >= count ( $courses )) {
				$classes .= ' last';
			}
			$content .= $this->coursecat_coursebox ( $chelper, $course, $classes );
		}
		
		if (! empty ( $pagingbar )) {
			$content .= $pagingbar;
		}
		if (! empty ( $morelink )) {
			$content .= $morelink;
		}
		
		$content .= html_writer::end_tag ( 'div' ); // .courses
		return $content;
	}
	
	/**
	 * Renders html to display a name with the link to the course module on a course page
	 *
	 * If module is unavailable for user but still needs to be displayed
	 * in the list, just the name is returned without a link
	 *
	 * Note, that for course modules that never have separate pages (i.e. labels)
	 * this function return an empty string
	 *
	 * @param cm_info $mod
	 * @param array $displayoptions
	 * @return string
	 */
	public function klass_course_section_cm_name(cm_info $mod, $displayoptions = array()) {
		global $CFG;
		$output = '';
		if (!$mod->uservisible && empty($mod->availableinfo)) {
			// nothing to be displayed to the user
			return $output;
		}
		$url = $mod->url;
		if (!$url) {
			return $output;
		}
	
		//Accessibility: for files get description via icon, this is very ugly hack!
		$instancename = $mod->get_formatted_name();
		$altname = $mod->modfullname;
		// Avoid unnecessary duplication: if e.g. a forum name already
		// includes the word forum (or Forum, etc) then it is unhelpful
		// to include that in the accessible description that is added.
		if (false !== strpos(core_text::strtolower($instancename),
				core_text::strtolower($altname))) {
					$altname = '';
			}
			// File type after name, for alphabetic lists (screen reader).
			if ($altname) {
				$altname = get_accesshide(' '.$altname);
			}

			// For items which are hidden but available to current user
			// ($mod->uservisible), we show those as dimmed only if the user has
			// viewhiddenactivities, so that teachers see 'items which might not
			// be available to some students' dimmed but students do not see 'item
			// which is actually available to current student' dimmed.
			$linkclasses = '';
			$accesstext = '';
			$textclasses = '';
			if ($mod->uservisible) {
				$conditionalhidden = $this->is_cm_conditionally_hidden($mod);
				$accessiblebutdim = (!$mod->visible || $conditionalhidden) &&
				has_capability('moodle/course:viewhiddenactivities', $mod->context);
				if ($accessiblebutdim) {
					$linkclasses .= ' dimmed';
					$textclasses .= ' dimmed_text';
					if ($conditionalhidden) {
						$linkclasses .= ' conditionalhidden';
						$textclasses .= ' conditionalhidden';
					}
					// Show accessibility note only if user can access the module himself.
					$accesstext = get_accesshide(get_string('hiddenfromstudents').':'. $mod->modfullname);
				}
			} else {
				$linkclasses .= ' dimmed';
				$textclasses .= ' dimmed_text';
			}

			// Get on-click attribute value if specified and decode the onclick - it
			// has already been encoded for display (puke).
			$onclick = htmlspecialchars_decode($mod->onclick, ENT_QUOTES);

			$groupinglabel = $mod->get_grouping_label($textclasses);
			// Display link itself.
			$activitylink = html_writer::start_tag('div', array('class' => 'activityinstanceimg'));
			$activitylink .= html_writer::empty_tag('img', array('src' => $mod->get_icon_url(),
					'class' => 'iconlarge activityicon', 'alt' => ' ', 'role' => 'presentation')) . $accesstext;
			$activitylink .= html_writer::end_tag('div');//activityinstanceimg
			// span
			$activitylink .= html_writer::start_tag('div', array('class' => 'activityinstancespan'));
			$activitylink .= html_writer::tag('span', $instancename . $altname, array('class' => 'instancename'));
			$activitylink .= html_writer::end_tag('div');//activityinstancespan
			//clear both
			$activitylink .= html_writer::start_tag('div', array('style' => 'clear: both'));
			$activitylink .= html_writer::end_tag('div');//clear both
					
			if ($mod->uservisible) {
				$output .= html_writer::link($url, $activitylink, array('class' => $linkclasses, 'onclick' => $onclick)) .
				$groupinglabel;
			} else {
				// We may be displaying this just in order to show information
				// about visibility, without the actual link ($mod->uservisible)
				$output .= html_writer::tag('div', $activitylink, array('class' => $textclasses)) .
				$groupinglabel;
			}
			return $output;
	}
}
