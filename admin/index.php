<?php 
// create custom plugin settings menu
add_action('admin_menu', 'ytSubscribe_create_menu');

function ytSubscribe_create_menu() {

        add_menu_page('ytSubscribe Settings', 
                'ytSubscribe', 
                'administrator', 
                __FILE__, 
                'ytsubscribe_settings_page', 
                plugins_url('assets/icon.png',__FILE__),
                2
                );
	//call register settings function
	add_action( 'admin_init', 'register_ytSubscribe_settings' );
}


function register_ytSubscribe_settings() {
	//register our settings
	register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_channel' );
	register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_theme' );
	register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_count' );
	register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_layout' );
	register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_dom' );
        register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_subscribe_text');
        register_setting( 'ytSubscribe-settings-group', 'ytSubscribe_customcss');
}

function ytSubscribe_settings_page() {
    $count = array("default","hidden");
    $theme = array("default","dark","grey");
    $layout = array("default","full");
    
?>
<div class="wrap">
<h2>ytSubscsribe</h2>
<script>
(function(a){a.fn.ytSubscribe=function(k){var c=a.extend({button:{channel:"mycodingtricks",theme:"dark",count:"default",layout:"full",onytevent:function(l){return false}},structure:"<div class='ytSubscribe-btn'></div>"},k);if(c.button.channel.match(/^UC/)&&c.button.channel.length==24){c.button.channelid=c.button.channel;delete c.button.channel}f();b();return this.each(function(){var l=this;setInterval(function(){var m=a(l);var n=m.find("iframe");if(n.length>0){n.each(function(){var p=a(this),o=p.attr("src");if(typeof(o)!=="undefined"){if(i(o)!==false){if(p.parent().hasClass("ytSubscribe-iframe")!=true){p.wrap("<div class='ytSubscribe-iframe "+c.button.theme+"'></div>");g(p);h(l)}e(this)}}})}},1000)});function d(l){a(l).each(function(){a(this).find(".ytSubscribe-btn").each(function(){if(a(this).html()==""){var m="ytSubscribe-btn-"+j();a(this).attr("id",m);gapi.ytsubscribe.render(m,c.button)}})})}function b(){a("head").append("<style>@media (max-width:480px){ytSubscribe-inner h3{margin:0px 5px 0px 5px;}.ytSubscribe-inner>* {float:none;}}.ytSubscribe-iframe .ytSubscribe{background:#F9F9F9;}.ytSubscribe-iframe.grey .ytSubscribe h3 {color: #fff !important;}.ytSubscribe-iframe.grey .ytSubscribe{background: #202020;color: #fff !important;}.ytSubscribe-iframe.dark .ytSubscribe{background:black;color:#fff !important;}.ytSubscribe{position:absolute;height:40px;width:100%;text-align:center;}.ytSubscribe-iframe>iframe{border:0px;margin-bottom:0px!important;}.ytSubscribe-btn{display:inline-block;width:190px;}.ytSubscribe-inner>*{float:left;}</style>")}function h(m){var l=setInterval(function(){if(typeof gapi!="undefined"){d(m);clearInterval(l)}else{f()}},1000)}function f(){a.getScript("https://apis.google.com/js/platform.js")}function g(l){l.after("<div class='ytSubscribe'><div class='ytSubscribe-inner'>"+c.structure+"</div></div>")}function e(l){var p=a(l);var v=p.parent();var m=v.find(".ytSubscribe");var n=m.height(),s=m.width(),r=p.position();var o=v.find(".ytSubscribe-inner");var u=o.innerWidth(),q=o.innerHeight();o.css({position:"absolute",marginTop:((n-q)/2)+"px",marginLeft:((s-u)/2)+"px"});var t=q+10;m.css({position:"absolute",top:(r.top+p.height())+"px",left:(r.left)+"px",height:t+"px",width:p.width()});p.width(v.width()).height(v.width()*0.562766).css("position","relative");v.css("margin-bottom",t+10+"px")}function j(){return Math.floor(Math.random()*100)+1}function i(l){var m=/^(?:https?:)?(?:\/\/)?(?:www\.)?(?:youtu\.be\/|youtube\.com\/(?:embed\/|v\/|watch\?v=|watch\?.+&v=))((\w|-){11})(?:\S+)?$/;return(l.match(m))?true:false}}})(jQuery);
jQuery(document).ready(function($){$("form").ytSubscribe()});
</script>
<form method="post" action="options.php">
    <?php settings_fields( 'ytSubscribe-settings-group' ); ?>
    <?php do_settings_sections( 'ytSubscribe-settings-group' ); ?>
    <table class="form-table">
        
        <tr valign="top">
        <th scope="row">Youtube Channel Id</th>
        <td><input type="text" name="ytSubscribe_channel" value="<?php echo esc_attr( get_option('ytSubscribe_channel',"MyCodingTricks") ); ?>" /></td>
        <td>For Example: <strong><a href="http://mycodingtricks.com" target="_blank">MyCodingTricks</a></strong> is my Youtube Channel Id where <strong><a href="http://youtube.com/mycodingtricks" target="_blank">http://youtube.com/mycodingtricks</a></strong> is my youtube channel url.<br/><br/><a href="https://www.youtube.com/watch?v=kxSWWSJkaMY" onclick="document.getElementById('channelId_video').style.display='table-row';return false;">How to Find My YouTube Channel Id [Video]</a></td>
        </tr>
        <tr id="channelId_video" style="display:none;" valign="top">
        <td></td>
        <td></td>
        <td><iframe style='width:100%' height="480" src="https://www.youtube.com/embed/kxSWWSJkaMY" frameborder="0" allowfullscreen></iframe></td>
        </tr>
         
        <tr valign="top">
        <th scope="row">Button Theme</th>
        <td>
            <select name="ytSubscribe_theme">
        <?php
            foreach($theme as $t){
                $option = esc_attr(get_option("ytSubscribe_theme"));
                echo "<option value='{$t}' ".(($t==$option) ? "selected":"").">{$t}</option>";
            }
        ?>
            </select>
        </td><td></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">Button Count</th>
        <td>
            <select name="ytSubscribe_count">
        <?php
            foreach($count as $c){
                $option = esc_attr(get_option("ytSubscribe_count"));
                echo "<option value='{$c}' ".(($c==$option) ? "selected":"").">{$c}</option>";
            }
        ?>
            </select>
        </td><td></td>
        </tr>
        <tr valign="top">
        <th scope="row">Button Layout</th>
        <td>
            <select name="ytSubscribe_layout">
        <?php
            foreach($layout as $l){
                $option = esc_attr(get_option("ytSubscribe_layout"));
                echo "<option value='{$l}' ".(($l==$option) ? "selected":"").">{$l}</option>";
            }
        ?>
            </select>
        </td>
        <td></td>
        </tr>
        
        <tr valign="top">
        <th scope="row">jQuery DOM Selector</th>
        <td><input type="text" name="ytSubscribe_dom" value="<?php echo esc_attr( get_option('ytSubscribe_dom',"body") ); ?>" /></td>
        <td>If "<strong>body</strong>" is not working, then replace it to <strong>.single-content</strong> or <strong>.post-single-content</strong></td>
        </tr>    
        <tr valign="top">
        <th scope="row">Subscribe Text</th>
        <td><input type="text" name="ytSubscribe_subscribe_text" value="<?php echo esc_attr( get_option('ytSubscribe_subscribe_text',"Subscribe to My Coding Tricks") ); ?>" /></td>
        <td></td>
        </tr>
    
        <tr valign="top">
        <th scope="row">Custom CSS</th>
        <td><textarea name="ytSubscribe_customcss" style="min-height:150px"><?php echo esc_attr( get_option('ytSubscribe_customcss',".ytSubscribe-inner h3{padding:0px;float:left;color:#000;margin:9px 5px 0px 0px;line-height: 20px;font-size: 18px;}") ); ?></textarea></td>
        <td></td>
        </tr>
         
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php } ?>