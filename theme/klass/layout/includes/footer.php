<?php
/* UNUSED in FIWARE
$footnote = theme_klass_get_setting('footnote', 'format_html');

$fburl    = theme_klass_get_setting('fburl');
$pinurl   = theme_klass_get_setting('pinurl');
$twurl    = theme_klass_get_setting('twurl');
$gpurl    = theme_klass_get_setting('gpurl');

$address  = theme_klass_get_setting('address');
$emailid  = theme_klass_get_setting('emailid');
$phoneno  = theme_klass_get_setting('phoneno');
$copyright_footer = theme_klass_get_setting('copyright_footer');
$infolink = theme_klass_get_setting('infolink');
<footer id="footer">    
  <div class="footer-main">
          <div id="copyright" class="span6">
          	<p>2011-2014 Fiware - FIWARE co-founded by 
          	  <a href="https://ec.europa.eu/research/fp7/index_en.cfm">
              	<img src="<?php echo get_logo_url('footer'); ?>" alt="7th Framework Programme">
              </a>
            </p></div>
          <div id="social_widget" class="span6">
          
          </div>
  </div>
</footer>
*/
?>
<footer class="footer">
    <div class="container-fluid">
      <div class="cred">
        <span>
          <div id="copyright" class="span6">
          <p>
            <a style="text-decoration:underline" href="http://www.fiware.org/disclaimer/">Disclaimer</a><br>
            &copy; 2011-2015 
            <a href="http://fiware.org">FIWARE (Core Platform of the Future Internet)</a>
           </p>
          </div>
           <div id="social_widget" class="span6">
          <p> 
          <span>Contact us on&nbsp;</span> 
          <span> 
          <a target="blank" class="social" title="Fiware Twitter" href="https://twitter.com/fiware"><i class="fa fa-twitter"></i></a> 
          <a target="blank" class="social" title="Fiware Facebook" href="https://www.facebook.com/eu.fiware"><i class="fa fa-facebook"></i></a> 
          <a target="blank" class="social" title="Fiware Google Plus" rel="publisher" href="https://plus.google.com/+Fi-wareEu"><i class="fa fa-google-plus"></i></a> 
          <a target="blank" class="social" title="Fiware Linkedin" href="http://www.linkedin.com/company/fi-ware"><i class="fa fa-linkedin"></i></a> 
          <a target="blank" class="social" title="Fiware Youtube Channel" href="http://www.youtube.com/user/fiware"><i class="fa fa-youtube"></i></a> 
          <a target="blank" class="social" title="Fiwate Flickr" href="http://www.flickr.com/photos/fi-ware/"><i class="fa fa-flickr"></i></a> 
          <a target="blank" class="social" title="Fiware Slideshare" href="http://www.slideshare.net/fi-ware"><i class="fa fa-slideshare"></i></a> 
          </span> 
            <img alt="cofounder" src="theme/klass/images/fi-ware_logos.png">
             </p>
          </div>
        </span></div>
      
    </div>
  </footer>
<!--E.O.Footer-->

<?php  echo $OUTPUT->standard_end_of_body_html() ?>