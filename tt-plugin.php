<?php
  /* 
    Plugin Name: TrafficTrain Prize Promotion
    Plugin URI: http://www.traffictrain.com
    Description: Plugin for displaying TrafficTrain campaign slider
    Author: TrafficTrain
    Version: 2.0.3
    Author URI: http://www.traffictrain.com 
  */  

  define('TRAFFICTRAIN_VERSION', '2.0.3');

  add_action('admin_menu', 'tt_admin');  
  add_action('wp_footer', 'tt_footerSnippet');

  function tt_admin() {  
    add_menu_page( __('TrafficTrain'), __('TrafficTrain'), 'manage_options', __FILE__, 'tt_admin_screen', plugins_url( 'images/tt-icon.png', __FILE__ ) , 90);
    add_action('admin_init', 'tt_register_settings');       
  }  

  function tt_register_settings() {
    register_setting( 'tt_main', 'tt_snippet_code' );
  }  

  function tt_admin_screen() {
    ?>
    <div class="wrap" style='padding-left:50px;'>
      <img src='<?php echo plugins_url( 'images/tt-logo.png', __FILE__ ); ?>'><br>
      <hr noshade size='1'>
      <h2><strong>Running a prize promotion campaign is simple!</strong></h2>
      <h3>Why you ask? Watch this video for a better explanation:</h3>      
      <iframe width="640" height="360" src="http://www.youtube.com/embed/ohjsY0o_yDk?rel=0" frameborder="0" allowfullscreen></iframe>
      
      <h3>Then, simply follow these instructions:</h3>
      <ul style='margin-left:50px; list-style: square;'>
        <li><a href='https://secure.traffictrain.com' target='_blank'>Login</a> to your TrafficTrain account (<a href='http://www.traffictrain.com/sign-up' target='_blank'>Create account</a>)</li>
        <li>Click Manage Campaigns</li>
        <li>Click Get Code on your desired campaign</li>
        <li>Copy this code to your clipboard (CTRL-C)</li>
        <li>Paste the code into the space below (CTRL-V)</li>
      </ul>
      <br>
      <form method="post" action="options.php">
        <?php settings_fields( 'tt_main' ); ?>
        <b>HTML Code Snippet from TrafficTrain:</b><br>
        <textarea name="tt_snippet_code" style='resize:none; width:450px; height:260px; border:1px solid #000000;'><?php echo get_option('tt_snippet_code'); ?></textarea>
        <table>
          <tr>
            <td width='140'><?php submit_button('Save Code Snippet'); ?></td>
            <td><?php if($_GET['settings-updated'] == 'true') {
                        echo "<img src='" .plugins_url( 'images/tt-checkmark.png', __FILE__ ) . "' align='absmiddle'>&nbsp;<span style='color:#0000ff; font-size:16px; padding-top:3px;'>Your code has been saved!</span>";
                      } ?></td>
          </tr>
        </table>
      </form>
    </div>
    <?php
  } 

  function tt_footerSnippet() {
    echo get_option('tt_snippet_code')."\n";
  }
  
?>