<?php
/**
* Callout section actions used by Business Pro.
*
* Author: Tyler Cunningham
* Copyright: © 2012
* {@link http://cyberchimps.com/ CyberChimps LLC}
*
* Released under the terms of the GNU General Public License.
* You should have received a copy of the GNU General Public License,
* along with this software. In the main directory, see: /licensing/
* If not, see: {@link http://www.gnu.org/licenses/}.
*
* @package Business Pro
* @since 3.0
*/

/**
* Pro callout actions
*/
add_action ( 'business_callout_section', 'business_callout_section_content' );

/**
* Retrieves the Callout Section options and sets up the HTML
*
* @since 3.0
*/
function business_callout_section_content() {

	global $options, $themeslug, $post, $wp_query; //call globals
	$root = get_template_directory_uri();  

/* Define variables. */	

	
	if (is_page()) {
		$tcolor = get_post_meta($post->ID, 'custom_callout_text_color' , true);
		$text = get_post_meta($post->ID, 'callout_text' , true);
	}
	
	else {
		$tcolor = $options->get($themeslug.'_blog_callout_text_color');
		$text = $options->get($themeslug.'_blog_callout_text');
	}
		
/* End variable definition. */	

/* Echo custom text color. */

	if ($tcolor != "") {
		echo '<style type="text/css" media="screen">';
		echo "#callout_text {color: $tcolor ;}";
		echo '</style>';
	}
			
/* End CSS. */	

/* Define Callout text. */	

	if ($text == '') {
		$callouttext = '<div style="margin-bottom:10px; font-size:20px;"><i>"Business Pro from CyberChimps WordPress Themes is a Professional Responsive WordPress Theme perfect for any business on any device."</i><br /></div> Learn more about <a href="http://cyberchimps.com/businesspro">Business Pro</a>.';
	}
	else {
		$callouttext = $text;
	}
	
/* End define Callout title. */	


?>
	<div class="calloutbg">
		<div class="container">
		<div class="row">
			<div id="callout_text" class="twelve columns">
				<?php echo $callouttext ?>
			</div>
		</div>
		</div>
	</div>

<?php
	
}

/**
* End
*/

?>