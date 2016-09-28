<?php
/* UNUSED in FIWARE
$footnote = theme_fiware_get_setting('footnote', 'format_html');

$fburl    = theme_fiware_get_setting('fburl');
$pinurl   = theme_fiware_get_setting('pinurl');
$twurl    = theme_fiware_get_setting('twurl');
$gpurl    = theme_fiware_get_setting('gpurl');

$address  = theme_fiware_get_setting('address');
$emailid  = theme_fiware_get_setting('emailid');
$phoneno  = theme_fiware_get_setting('phoneno');
$copyright_footer = theme_fiware_get_setting('copyright_footer');
$infolink = theme_fiware_get_setting('infolink');
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
    <!--
    	<table style="width:100%">
    	<tr>
    	<td id="copyright">
          <p>
            <a style="text-decoration:underline" href="http://www.fiware.org/disclaimer/">Disclaimer</a><br/>
            &copy; 2011-2015
 <a href="http://fiware.org">FIWARE (Core Platform of the Future Internet)</a>
           </p>
    	</td>
    	<td id="social-widget">
          Contact us on&nbsp; 
          <a target="blank" class="social" title="Fiware Twitter" href="https://twitter.com/fiware"><i class="fa fa-twitter"></i></a> 
          <a target="blank" class="social" title="Fiware Facebook" href="https://www.facebook.com/eu.fiware"><i class="fa fa-facebook"></i></a> 
          <a target="blank" class="social" title="Fiware Google Plus" rel="publisher" href="https://plus.google.com/+Fi-wareEu"><i class="fa fa-google-plus"></i></a> 
          <a target="blank" class="social" title="Fiware Linkedin" href="http://www.linkedin.com/company/fi-ware"><i class="fa fa-linkedin"></i></a> 
          <a target="blank" class="social" title="Fiware Youtube Channel" href="http://www.youtube.com/user/fiware"><i class="fa fa-youtube"></i></a> 
          <a target="blank" class="social" title="Fiwate Flickr" href="http://www.flickr.com/photos/fi-ware/"><i class="fa fa-flickr"></i></a> 
          <a target="blank" class="social" title="Fiware Slideshare" href="http://www.slideshare.net/fi-ware"><i class="fa fa-slideshare"></i></a> 
    	</td>
    	<td id="fiware-7fp">
            <a target="blank" href="https://ec.europa.eu/research/fp7/index_en.cfm">
            <img alt="cofounder" src="<?php echo $OUTPUT->pix_url('fi-ware_logos','theme');?>">
            </a>
    	</td>
    	</tr>
    	</table>
    	--> 
          <div id="copyright">
          <p>

 <a style="text-decoration:underline" href="http://www.fiware.org/disclaimer/">Disclaimer</a><br/>
            &copy; 2011-2016 
            <a href="http://fiware.org">FIWARE</a><br/>
            <nobr><a href="http://wiki.fiware.org/FIWARE_Privacy_Policy">FIWARE Privacy Policy</a></nobr><nobr></nobr>&nbsp;-&nbsp;<a href="http://wiki.fiware.org/Cookies_Policy_FIWARE">Cookies Policy</a></nobr>

           </p>
          </div>
           <div id="social-widget">
          Contact us on&nbsp; 
          <a target="blank" class="social" title="Fiware Twitter" href="https://twitter.com/fiware"><i class="fa fa-twitter"></i></a> 
          <a target="blank" class="social" title="Fiware Facebook" href="https://www.facebook.com/eu.fiware"><i class="fa fa-facebook"></i></a> 
          <a target="blank" class="social" title="Fiware Google Plus" rel="publisher" href="https://plus.google.com/+Fi-wareEu"><i class="fa fa-google-plus"></i></a> 
          <a target="blank" class="social" title="Fiware Linkedin" href="http://www.linkedin.com/company/fi-ware"><i class="fa fa-linkedin"></i></a> 
          <a target="blank" class="social" title="Fiware Youtube Channel" href="http://www.youtube.com/user/fiware"><i class="fa fa-youtube"></i></a> 
          <a target="blank" class="social" title="Fiwate Flickr" href="http://www.flickr.com/photos/fi-ware/"><i class="fa fa-flickr"></i></a> 
          <a target="blank" class="social" title="Fiware Slideshare" href="http://www.slideshare.net/fi-ware"><i class="fa fa-slideshare"></i></a> 
           
          </div>
          <div id="fiware-7fp">
            <a target="blank" href="https://ec.europa.eu/research/fp7/index_en.cfm">
            <img alt="cofounder" src="<?php echo $OUTPUT->pix_url('fi-ware_logos','theme');?>">
            </a>
          </div>
      
    </div>
	  <div id="cookiemsg" class="cookiesmsg">
	    We use proprietary and third party's cookies to improve your experience and our services, 
	    identifying your Internet Browsing preferences on our website; develop analytic activities 
	    and display advertising based on your preferences. If you keep browsing, you accept its use.
	    You can get more information on our <a href="http://wiki.fiware.org/Cookies_Policy_FIWARE">Cookies policy Activity</a>.
	    <button onclick="controlcookies()">Accept</button>
	  </div>
	  <script type="text/javascript">
	  function getCookie(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i = 0; i < ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0) == ' ') {
	            c = c.substring(1);
	        }
	        if (c.indexOf(name) == 0) {
	            return c.substring(name.length, c.length);
	        }
	    }
	    return "";
	  }

	  if (getCookie("popup_cookie") == "0") {
	    cookiemsg.style.display='none';
	  }
	  function controlcookies() {
		  // IE dowsn't support max-age, so we need to set expires
		  var expdate=new Date();
		  expdate.setMonth(expdate.getMonth()+1);
		  
	    document.cookie = "popup_cookie=0; max-age="+(60*60*24*30)+"; expires="+expdate.toUTCString()+"; path=/";
	    cookiemsg.style.display='none'; // Hide cookies message
	  }
	  </script>
  </footer>
<!--E.O.Footer-->

<?php  echo $OUTPUT->standard_end_of_body_html() ?>
