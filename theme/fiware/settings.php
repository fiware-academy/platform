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
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * @package   theme_fiware
 * @copyright 2015 Nephzat Dev Team, nephzat.com
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
$settings = null;

if (is_siteadmin()) {

    $ADMIN->add('themes', new admin_category('theme_fiware', 'Fiware'));
				
	/* Header Settings */
	$temp = new admin_settingpage('theme_fiware_header', get_string('headerheading', 'theme_fiware'));	

	    // Logo file setting.
	    $name = 'theme_fiware/logo';
	    $title = get_string('logo','theme_fiware');
	    $description = get_string('logodesc', 'theme_fiware');
	    $setting = new admin_setting_configstoredfile($name, $title, $description, 'logo');
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);
	
	    // Custom CSS file.
	    $name = 'theme_fiware/customcss';
	    $title = get_string('customcss', 'theme_fiware');
	    $description = get_string('customcssdesc', 'theme_fiware');
	    $default = '';
	    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);
					
		$ADMIN->add('theme_fiware', $temp);
				
	/* Front Page Settings */
	$temp = new admin_settingpage('theme_fiware_frontpage', get_string('frontpageheading', 'theme_fiware'));	

	     // Who we are title
	    $name = 'theme_fiware/whoweare_title';
	    $title = get_string('whoweare_title', 'theme_fiware');
	    $description = '';
	    $default = get_string('whoweare_title_default','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
	
	     // Who we are content
	    $name = 'theme_fiware/whoweare_description';
	    $title = get_string('whoweare_description', 'theme_fiware');
	    $description = get_string('whowearedesc', 'theme_fiware');
	    $default = get_string('whowearedefault', 'theme_fiware');
	    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);
		
	    /* display navigator module */
	    $name = 'theme_fiware/togglenavigator';
	    $title = get_string('togglenavigator', 'theme_fiware');
	    $description = get_string('togglenavigatordesc', 'theme_fiware');
	    $yes = get_string('yes');
	    $no = get_string('no');
	    $default = 0;
	    $choices = array(0 => $yes , 1 => $no);
	    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);
	    
		$ADMIN->add('theme_fiware', $temp);
	
    /* Slideshow Settings Start */
				
	$temp = new admin_settingpage('theme_fiware_slideshow', get_string('slideshowheading', 'theme_fiware'));
    $temp->add(new admin_setting_heading('theme_fiware_slideshow', get_string('slideshowheadingsub', 'theme_fiware'),
    format_text(get_string('slideshowdesc', 'theme_fiware'), FORMAT_MARKDOWN)));
				
	// Display Slideshow.
    $name = 'theme_fiware/toggleslideshow';
    $title = get_string('toggleslideshow', 'theme_fiware');
    $description = get_string('toggleslideshowdesc', 'theme_fiware');
    $yes = get_string('yes');
    $no = get_string('no');
    $default = 1;
    $choices = array(1 => $yes , 0 => $no);
    $setting = new admin_setting_configselect($name, $title, $description, $default, $choices);
    $setting->set_updatedcallback('theme_reset_all_caches');
    $temp->add($setting);
				
	// Number of slides.
    $name = 'theme_fiware/numberofslides';
    $title = get_string('numberofslides', 'theme_fiware');
    $description = get_string('numberofslides_desc', 'theme_fiware');
    $default = 3;
    $choices = array(
        1 => '1',
        2 => '2',
        3 => '3',
        4 => '4',
        5 => '5',
        6 => '6',
        7 => '7',
        8 => '8',
        9 => '9',
        10 => '10',
        11 => '11',
        12 => '12',
    );
    $temp->add(new admin_setting_configselect($name, $title, $description, $default, $choices));
				
    $numberofslides = get_config('theme_fiware', 'numberofslides');
    for ($i = 1; $i <= $numberofslides; $i++) {
		// This is the descriptor for Slide One
        $name = 'theme_fiware/slide' . $i . 'info';
        $heading = get_string('slideno', 'theme_fiware', array('slide' => $i));
        $information = get_string('slidenodesc', 'theme_fiware', array('slide' => $i));
        $setting = new admin_setting_heading($name, $heading, $information);
        $temp->add($setting);
		
		// Slide Image.
        $name = 'theme_fiware/slide' . $i . 'image';
        $title = get_string('slideimage', 'theme_fiware');
        $description = get_string('slideimagedesc', 'theme_fiware');
        $setting = new admin_setting_configstoredfile($name, $title, $description, 'slide' . $i . 'image');
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);

        // Slide Caption.
        $name = 'theme_fiware/slide' . $i . 'caption';
        $title = get_string('slidecaption', 'theme_fiware');
        $description = get_string('slidecaptiondesc', 'theme_fiware');
        $default = get_string('slidecaptiondefault','theme_fiware', array('slideno' => sprintf('%02d', $i) ));
        $setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_TEXT);
        $setting->set_updatedcallback('theme_reset_all_caches');
        $temp->add($setting);
								
		// Slide Description Text.
		$name = 'theme_fiware/slide' . $i . 'url';
		$title = get_string('slideurl', 'theme_fiware');
		$description = get_string('slideurldesc', 'theme_fiware');
		$default = 'http://www.example.com/';
		$setting = new admin_setting_configtext($name, $title, $description, $default, PARAM_URL);
		$setting->set_updatedcallback('theme_reset_all_caches');
		$temp->add($setting);
								
		}
				
		$ADMIN->add('theme_fiware', $temp);
		/* Slideshow Settings End*/
				
		/* Footer Settings start */
			
		$temp = new admin_settingpage('theme_fiware_footer', get_string('footerheading', 'theme_fiware'));
				
	    // Footer Logo file setting.
	    $name = 'theme_fiware/footerlogo';
	    $title = get_string('footerlogo','theme_fiware');
	    $description = get_string('footerlogodesc', 'theme_fiware');
	    $setting = new admin_setting_configstoredfile($name, $title, $description, 'footerlogo');
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);

				
		/* Footer Content */
	    /* UNUSED in FIWARE
		$name = 'theme_fiware/footnote';
	    $title = get_string('footnote', 'theme_fiware');
	    $description = get_string('footnotedesc', 'theme_fiware');
	    $default = get_string('footnotedefault', 'theme_fiware');
	    $setting = new admin_setting_confightmleditor($name, $title, $description, $default);
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);
	
		// INFO Link
	
		$name = 'theme_fiware/infolink';
	    $title = get_string('infolink', 'theme_fiware');
	    $description = get_string('infolink_desc', 'theme_fiware');
	    $default = get_string('infolinkdefault', 'theme_fiware');
	    $setting = new admin_setting_configtextarea($name, $title, $description, $default);
	    $setting->set_updatedcallback('theme_reset_all_caches');
	    $temp->add($setting);
	
		// copyright 
	
		$name = 'theme_fiware/copyright_footer';
	    $title = get_string('copyright_footer', 'theme_fiware');
	    $description = '';
	    $default = get_string('copyright_default','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
		*/

		/* Address , Email , Phone No */
	    /* UNUSED in FIWARE
		$name = 'theme_fiware/address';
	    $title = get_string('address', 'theme_fiware');
	    $description = '';
	    $default = get_string('defaultaddress','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
				
				
		$name = 'theme_fiware/emailid';
	    $title = get_string('emailid', 'theme_fiware');
	    $description = '';
	    $default = get_string('defaultemailid','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
				
		$name = 'theme_fiware/phoneno';
	    $title = get_string('phoneno', 'theme_fiware');
	    $description = '';
	    $default = get_string('defaultphoneno','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
	    */
		
		/* Facebook,Pinterest,Twitter,Google+ Settings */
		/* UNUSED in FIWARE
	    $name = 'theme_fiware/fburl';
	    $title = get_string('fburl', 'theme_fiware');
	    $description = get_string('fburldesc', 'theme_fiware');
	    $default = get_string('fburl_default','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
				
		$name = 'theme_fiware/pinurl';
	    $title = get_string('pinurl', 'theme_fiware');
	    $description = get_string('pinurldesc', 'theme_fiware');
	    $default = get_string('pinurl_default','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
				
		$name = 'theme_fiware/twurl';
	    $title = get_string('twurl', 'theme_fiware');
	    $description = get_string('twurldesc', 'theme_fiware');
	    $default = get_string('twurl_default','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
	    $temp->add($setting);
				
		$name = 'theme_fiware/gpurl';
	    $title = get_string('gpurl', 'theme_fiware');
	    $description = get_string('gpurldesc', 'theme_fiware');
	    $default = get_string('gpurl_default','theme_fiware');
	    $setting = new admin_setting_configtext($name, $title, $description, $default);
    	$temp->add($setting);
		*/
    	$ADMIN->add('theme_fiware', $temp);
		/*  Footer Settings end */	
}
