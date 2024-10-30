<?php
/*
Plugin Name: Blog Promotion - BlogUpp 
Plugin URI: http://www.blogupp.com/
Description: All-in-one blog promotion service and selected blog network connecting via interactive blog widget, social web cross posting, content discovery toolbar and blog directory. 
Author: The BlogUpp Team
Version: 2.0
Author URI: http://www.blogupp.com/
*/

class blogupp_widget extends WP_Widget{

	// Init
  function blogupp_widget(){
		$widget_ops = array('classname' => 'blogupp_widget_ops', 'description' => "All-in-one blogger service & community" );
		$control_ops = array('width' => 235, 'height' => 250);
		$this->WP_Widget('blogupp_widget_id', 'Blog Promotion - BlogUpp', $widget_ops, $control_ops);
	}
	
	// Display Widget
	function widget($args, $instance){
		extract($args);
		$blogupp_title = $instance['blogupp_title'];
		$blogupp_content = empty($instance['blogupp_content']) ? '' : $instance['blogupp_content'];
		
		$blogupp_content_display = $before_widget . "\n<!-- BlogUpp widget begin-->\n" . $before_title . $blogupp_title . $after_title . $blogupp_content . "\n<!-- BlogUpp widget closing-->\n" . $after_widget;
		
		echo $blogupp_content_display;
	}

	// Update Options
	function update($new_instance, $old_instance){
		$instance = $old_instance;
		$instance['blogupp_title'] = stripslashes($new_instance['blogupp_title']);
		$instance['blogupp_content'] = stripslashes($new_instance['blogupp_content']);
		
		return $instance;
	}
  
	// Widget Settings
	function form($instance){
		$instance = wp_parse_args( (array) $instance, array('blogupp_title'=>'', 'blogupp_content'=>'' ) );
		
		$blogupp_title = htmlspecialchars($instance['blogupp_title']);
		$blogupp_content = htmlspecialchars($instance['blogupp_content']);
?>
    <div class="intro">
      <b>Thanks for choosing BlogUpp</b><br/><br/>
      Please enter below your widget-code from <a href="http://www.blogupp.com/" target="_blank">blogupp.com</a>, save & preview.
    </div>

		<div class="options">
			<label>Title (optional)<br />
				<input id="<?php echo $this->get_field_id('blogupp_title');?>" name="<?php echo $this->get_field_name('blogupp_title'); ?>" type="text" value="<?php echo ($blogupp_title=='' ? 'BlogUpp' : $blogupp_title); ?>" class="widefat"/>
			</label>
		</div>
		
		<div class="options">
			<label>Widget-code</label>
			<textarea rows="6" id="<?php echo $this->get_field_id('blogupp_content'); ?>" name="<?php echo $this->get_field_name('blogupp_content'); ?>" class="blogupp_content"><?php echo $blogupp_content; ?></textarea>
		</div>
		
		<div style="clear:both"></div>

    <div class="blogupp_tips">
      Tip: Don't miss social networks <a href="http://blog.blogupp.com/2010/05/auto-share-on-social-web.html" target="_blank">cross-posting</a> & <a href="http://blog.blogupp.com/2008/07/widget-customization-introduced.html" target="_blank">customization</a>.<br/>
    </div>
		
		<div class="links">
		  <a href="http://www.blogupp.com/" target="_blank">Home</a> | <a href="http://www.blogupp.com/stats/" target="_blank">Stats</a> | <a href="http://blog.blogupp.com/2008/03/frequently-asked-questions-on-blogupp.html" target="_blank">FAQ</a> | <a href="http://www.blogupp.com/directory/" target="_blank">Blog Directory</a>
    </div>
<?php
	}
}

function blogupp_widget_init(){
	register_widget('blogupp_widget');
}
add_action('widgets_init', 'blogupp_widget_init');
 
function blogupp_widget_preload(){
	echo '<style type="text/css">';
	echo '.intro{border:1px solid #E2C822; background-color:#FFF9D7; padding:5px; margin-bottom:10px; border-radius: 3px; -webkit-border-radius: 3px; -khtml-border-radius: 3px; -moz-border-radius: 3px;}';
	echo '.options{margin: 0px 0px 10px;font-weight:bold;}';    
	echo '.blogupp_content{width: 100%; font: 10px/2em verdana, arial;}';
	echo '.blogupp_tips{border:1px solid #8888aa; background-color:#f7f8ff; padding:5px; margin-top:10px; border-radius: 3px; -webkit-border-radius: 3px; -khtml-border-radius: 3px; -moz-border-radius: 3px;}';
	echo '.links{margin: 10px 0px 0px;}';
	echo '</style>';    
}
add_action('admin_head','blogupp_widget_preload');

?>
