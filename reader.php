<?php
/*
Plugin Name: Facebook RSS Reader 
Plugin URI: http://www.muzedon.com
Description: RSS Reader from Facebook page feed
Author: Simone 'Muzedon' Usai
Version: 1.0
Author URI: http://www.muzedon.com
*/
?>


<?php

class RSS_Facebook_Widget extends WP_Widget {
	
	public function __construct() {
        parent::__construct(
             'RSS_Facebook_Widget',
             'RSS Facebook Widget', 
              array('description' => 'RSS Reader from Facebook page feed')
        );
	}
	
	public function widget($args, $instance) {
		extract($args);
        echo $before_widget;
        echo $before_title.$instance['title'].$after_title;
		
		// Set charset to UTF8 to manage special chars
		@header('Content-Type: text/html; charset=utf-8');
		// To get the date in local language (optional)
		@setlocale(LC_TIME, "it_IT");
		
		// RSS Reader based on Kayla Knight "Reading a Facebook Page RSS Feed with PHP"
		// http://www.kaylaknight.com/reading-a-facebook-page-rss-feed-with-php/
		
		// Without this "ini_set" Facebook's RSS url is all screwy for reading!
		// This is the most essential line, don't forget it.
		@ini_set('user_agent', 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.9) Gecko/20071025 Firefox/2.0.0.9');
		
		// This URL is the URL to the Facebook Page's RSS feed.
		// To get it, go to the page's profile, and on the left-hand side click "Get Updates vis RSS"
		// i.e. $rssUrl = "http://www.facebook.com/feeds/page.php?format=rss20&id=128676533832080";
		$rssUrl = $instance['rssfeed'];
		$xml = simplexml_load_file($rssUrl); // Load the XML file
	
		// This creates an array called "entry" that puts each <item> in FB's XML format into the array
		$entry = $xml->channel->item;
	
		// String to add to as I loop through our FB feed.
		$returnMarkup = '';
	
		// Loop 
		$number = $instance['number'];
		for ($i = 0; $i < $number; $i++) {
			
			//Replace the small thumb with the big image 
			$entry[$i]->description = str_replace('_s.jpg" ', '_n.jpg" style="width:100%;" ', $entry[$i]->description); 
			
			$returnMarkup .= '<div class="featuredpost lastpost">';
			$returnMarkup .= '<h2 class="posttitle"><a href="'.$entry[$i]->link.'" rel="bookmark" title="'.$entry[$i]->title.'">'.$entry[$i]->title.'</a></h2>';			
			$returnMarkup .= '<p>'.$entry[$i]->description.'</p>
								<p class="postmeta"> 
									<span class="meta_date">'.strftime("%d %B %Y", strtotime($entry[$i]->pubDate)).'</span>
									<span class="meta_permalink"> <a style="color:#cd1713;" href="'.$entry[$i]->link.'"> Leggi</a></span>
							</p>'; // Full content
			$returnMarkup .= '</div>';
		}
	
		// Return our formatted string with our Facebook page feed data in it!
		echo $returnMarkup;
		echo $after_widget;
    }
	
	function update( $new_instance, $old_instance ) {
        return $new_instance;
    }
	
    function form($instance) {
		// Parameters to instance from Control Panel -> Widget
        $title = esc_attr($instance['title']); 
		$rssfeed = esc_attr($instance['rssfeed']);
		$number = esc_attr($instance['number']);
		echo'<p><label for="'.$this->get_field_id('title').'">Title<br /> <input class="widefat" id="'.$this->get_field_id('title').'" name="'.$this->get_field_name('title').'" type="text" value="'.$title.'" />
        	</label></p>';
		echo'<p><label for="'.$this->get_field_id('rssfeed').'">RSS feed<br /> <input class="widefat" id="'.$this->get_field_id('rssfeed').'" name="'.$this->get_field_name('rssfeed').'" type="text" value="'.$rssfeed.'" />
        	</label></p>';	
		echo'<p><label for="'.$this->get_field_id('number').'">Number<br /> <input class="widefat" id="'.$this->get_field_id('number').'" name="'.$this->get_field_name('number').'" type="text" value="'.$number.'" />
        	</label></p>';		
    }
}

add_action('widgets_init', create_function('', 'return register_widget("RSS_Facebook_Widget");'));
?>