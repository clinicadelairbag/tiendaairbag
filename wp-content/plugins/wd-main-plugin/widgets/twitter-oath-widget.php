<?php
/*
  Plugin Name: Twitter Tweets widget
  Plugin URI: http://code.tutsplus.com
  Description: Displays latest twitter tweets
  Author: Agbonghama Collins
  Author URI: http://tech4sky.com
 */

class Twitter_Tweets_Widget extends WP_Widget {

    function __construct() {
        parent::__construct(
                'twitter-tweets-widget',
                __('Twitter Tweets widget',
                'ajzaa'),
                array('description' => __('Displays latest twitter tweets', 'ajzaa'),)
        );
    }

    public function tweet_time( $time ) {
        //get current timestamp
        $b	=	strtotime("now");
		
        //get timestamp when tweet created
        $c	=	strtotime($time);
		
        //get difference
        $d 	= 	$b - $c;
		
        //calculate different time values
        $minute	= 	60;
        $hour 	= 	$minute * 60;
        $day 	= 	$hour * 24;
        $week 	= 	$day * 7;

        if ( is_numeric($d) && $d > 0 ) {
            	
            //if less then 3 seconds
            if ($d < 3)
                return "right now";
            
            //if less then minute
            if ($d < $minute)
            
			    return floor($d) . " seconds ago";
            
            //if less then 2 minutes
            if ($d < $minute * 2)
                return "about 1 minute ago";
           
		    //if less then hour
            if ($d < $hour)
                return floor($d / $minute) . " minutes ago";
            
            //if less then 2 hours
            if ($d < $hour * 2)
                return "about 1 hour ago";
            
            //if less then day
            if ($d < $day)
                return floor($d / $hour) . " hours ago";
            
            //if more then day, but less then 2 days
            if ($d > $day && $d < $day * 2)
                return "yesterday";
            
            //if less then year
            if ($d < $day * 365)
                return floor($d / $day) . " days ago";
            
            //else return more than a year
            return "over a year ago";
        }
    }

    public function twitter_timeline( $username, $limit, $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret ) {
        require_once 'TwitterAPIExchange.php';

        /** Set access tokens here - see: https://dev.twitter.com/apps/ * */
        $settings = array(
            'oauth_access_token' => $oauth_access_token,
            'oauth_access_token_secret' => $oauth_access_token_secret,
            'consumer_key' => $consumer_key,
            'consumer_secret' => $consumer_secret
        );

        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=' . $username . '&count=' . $limit;
        $request_method = 'GET';
        $twitter_instance = new TwitterAPIExchange($settings);
        $query = $twitter_instance->setGetfield($getfield)
                ->buildOauth($url, $request_method)
                ->performRequest();
        $timeline = json_decode($query);

        return $timeline;
    }

    public function widget($args, $instance) {
        $title 						= 	apply_filters('widget_title', $instance['title']);
		$username 					= 	$instance['twitter_username'];
        $limit 						= 	$instance['update_count'];
        $oauth_access_token 		= 	$instance['oauth_access_token'];
        $oauth_access_token_secret 	= 	$instance['oauth_access_token_secret'];
        $consumer_key 				= 	$instance['consumer_key'];
        $consumer_secret 			= 	$instance['consumer_secret'];
		
        echo $args['before_widget'];
        if (!empty($title))
            echo $args['before_title'] . $title . $args['after_title'];
		
		// get the tweets
        $timelines = $this->twitter_timeline( $username, $limit, $oauth_access_token, $oauth_access_token_secret, $consumer_key, $consumer_secret );


        if ($timelines) {
        	
			// linkify URL and username mention in tweets
            $patterns = array('@(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)@', '/@([A-Za-z0-9_]{1,15})/');
            $replace = array('<a href="$1">$1</a>', '<a href="http://twitter.com/$1">@$1</a>');

            foreach ( $timelines as $timeline ) {

                	$result = preg_replace($patterns, $replace, $timeline->text);

                	echo '<div>';
                	echo $result . '<br/>';
                	echo $this->tweet_time($timeline->created_at);
                	echo "</div><br/>";
            }
			
        } 
        
        else {

            echo "Error fetching feeds. Please verify the twitter settings in the widget.";
        }


        echo $args['after_widget'];
    }

    public function form( $instance ) {
    	
        $twitter_username = $instance['twitter_username'];
        $update_count = isset($instance['update_count']) ? $instance['update_count'] : 5;
        $oauth_access_token = $instance['oauth_access_token'];
        $oauth_access_token_secret = $instance['oauth_access_token_secret'];
        $consumer_key = $instance['consumer_key'];
        $consumer_secret = $instance['consumer_secret'];


        if (isset($instance['title'])) {
            $title = $instance['title'];
        } 
        
        else {
            $title = __('Twitter feed', 'ajzaa');
        }
        ?>
        <p>
            <label for="<?php echo $this -> get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('title'); ?>" name="<?php echo $this -> get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('twitter_username'); ?>"><?php _e('Twitter username (without <b>@</b>):'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('twitter_username'); ?>" name="<?php echo $this -> get_field_name('twitter_username'); ?>" type="text" value="<?php echo esc_attr($twitter_username); ?>">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('update_count'); ?>"><?php _e('Number of tweets to display:'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('update_count'); ?>" name="<?php echo $this -> get_field_name('update_count'); ?>" type="number" value="<?php echo esc_attr($update_count); ?>">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('oauth_access_token'); ?>"><?php _e('OAuth Access Token:'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('oauth_access_token'); ?>" name="<?php echo $this -> get_field_name('oauth_access_token'); ?>" type="text" value="<?php echo esc_attr($oauth_access_token); ?>">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('oauth_access_token_secret'); ?>"><?php _e('OAuth Access Token Secret:'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('oauth_access_token_secret'); ?>" name="<?php echo $this -> get_field_name('oauth_access_token_secret'); ?>" type="text" value="<?php echo esc_attr($oauth_access_token_secret); ?>">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('consumer_key'); ?>"><?php _e('Consumer Key:'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('consumer_key'); ?>" name="<?php echo $this -> get_field_name('consumer_key'); ?>" type="text" value="<?php echo esc_attr($consumer_key); ?>">
        </p>

        <p>
            <label for="<?php echo $this -> get_field_id('consumer_secret'); ?>"><?php _e('Consumer Secret:'); ?></label>
            <input class="widefat" id="<?php echo $this -> get_field_id('consumer_secret'); ?>" name="<?php echo $this -> get_field_name('consumer_secret'); ?>" type="text" value="<?php echo esc_attr($consumer_secret); ?>">
        </p>


        <?php
		}

		public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title']						= 	( !empty($new_instance['title']) ) 	? strip_tags( $new_instance['title'] ) : '';
		$instance['title'] 						= 	(!empty($new_instance['title']) ) 	? strip_tags( $new_instance['title'] ) : '';
		$instance['twitter_username'] 			= 	(!empty($new_instance['twitter_username']) ) 	? strip_tags( $new_instance['twitter_username'] ) : '';
		$instance['update_count'] 				= 	(!empty($new_instance['update_count']) ) 	? strip_tags( $new_instance['update_count'] ) : '';
		$instance['oauth_access_token'] 		= 	(!empty($new_instance['oauth_access_token']) ) 	? strip_tags( $new_instance['oauth_access_token'] ) : '';
		$instance['oauth_access_token_secret'] 	= 	(!empty($new_instance['oauth_access_token_secret']) ) 	? strip_tags( $new_instance['oauth_access_token_secret']) : '';
		$instance['consumer_key'] 				= 	(!empty($new_instance['consumer_key']) ) 	? strip_tags( $new_instance['consumer_key']) : '';
		$instance['consumer_secret'] 			= 	(!empty($new_instance['consumer_secret']) ) 	? strip_tags( $new_instance['consumer_secret']) : '';

		return $instance;
		}

		}


		function register_foo_widget() {
		register_widget('Twitter_Tweets_Widget');
		}

		add_action('widgets_init', 'register_foo_widget');
	