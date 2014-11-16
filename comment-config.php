<?php

function add_sc_options_to_menu(){
	add_comments_page( '', 'Semantic Comments', 'manage_options', 'sc_options', 'sc_options_form');
}

add_action('admin_menu', 'add_sc_options_to_menu');

add_action( 'admin_init', 'sc_options_init' );
function sc_options_init() {
    register_setting( 'sc_options', 'sc_options' );
    add_settings_section( 'sc-content', 'Content Options', 'sc_options_callback', 'sc_options' );
    add_settings_field( 'comments', 'Use Theme Comments', 'sc_callback', 'sc_options', 'sc-content' ,  array( 'name' => 'comments') );
}

function sc_options_callback()
   {
	echo 'Semantic Comments Options';
   }

function sc_callback(array $args)
   {
        $options = get_option('sc_options');
        $name = $args['name'];
        $checked = $options[$name];
        echo "<input name='sc_options[$name]' type='hidden' value='0' />";
        echo "<input name='sc_options[$name]' type='checkbox' value='1' " . checked( 1, $checked, false ) . " /> ";
   }

function sc_options_form() 
  {
    ?>
     <div class="wrap">
        <h2>Semantic Comments</h2>  
        <p>Display Options for the Semantic Linkbacks Plugin</p>

        <hr />
        <form method="post" action="options.php">
        <?php settings_fields( 'sc_options' ); ?>

         <?php do_settings_sections( 'sc_options' ); ?>
         <?php submit_button(); ?>
       </form>
     </div>
    <?php
 }

?>
