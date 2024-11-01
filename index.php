<?php
/**
 * Plugin Name: ytSubscribe - Youtube Subscribe Button
 * Plugin URI: http://mycodingtricks.com
 * Description: ytSubscribe is a Youtube Subscribe Button jQuery Plugin that automatically inserts Youtube Subscribe Button Below each Video in your WordPress Post.
 * Version: 2016.10.2.3
 * Author: Shubham Kumar
 * Author URI: http://mycodingtricks.com
 * Text Domain: ytsubscribe
 * Network: true
*/
include __DIR__.'/admin/index.php';
$config = array(
    "channel"=>get_option("ytSubscribe_channel","MyCodingTricks"), //Your Youtube Channel Id
    "theme"  =>get_option("ytSubscribe_theme","default"),
    "count"  =>get_option("ytSubscribe_count","default"),
    "layout" => get_option("ytSubscribe_layout","default")
);

function ytSubscribe_action_links($links){
    $mylinks = array(
        "<a href='".admin_url('admin.php?page=ytsubscribe/admin/index.php')."'>Settings</a>",
        "<a href='http://mycodingtricks.com/wordpress/ytsubscribe-wordpress-plugin/' target=_blank>Tutorial</a>"
    );
    return array_merge($links,$mylinks);
}


//Don't Edit after this

function load_ytSubscribe(){
    global $ver;
    wp_enqueue_script('ytSubscribe',plugins_url('ytSubscribe.js',__FILE__),array('jquery'),"2016.10.2.3");
}
function ytSubscribe_customcss(){
    echo "<style>".esc_attr( get_option('ytSubscribe_customcss',".ytSubscribe-inner h3{padding:0px;float:left;color:#000;margin:9px 5px 0px 0px;line-height: 20px;font-size: 18px;}") )."</style>".  get_ytSubscribe_script();
}
function get_ytSubscribe_script(){
    global $config;
    $code = "<script>jQuery(document).ready(function($){
            $('".get_option("ytSubscribe_dom","body")."').ytSubscribe({
                button: {
                  channel: '".$config['channel']."',
                  theme: '".$config['theme']."',
                  count: '".$config['count']."',
                  layout: '".$config['layout']."',
                },
                structure: \"<\"+\"h3>".esc_attr( get_option('ytSubscribe_subscribe_text',"Subscribe to My Coding Tricks") )."<\"+\"/\h3>\"+\"<\"+\"div class='ytSubscribe-btn'></\div>\"
           });
        });
        </script>";
    return $code;
}
add_action('wp_head','ytSubscribe_customcss');
add_action('wp_enqueue_scripts','load_ytSubscribe');
add_filter('plugin_action_links_'.plugin_basename(__FILE__),'ytSubscribe_action_links');