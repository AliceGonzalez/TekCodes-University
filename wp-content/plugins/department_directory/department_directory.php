<?php
/** 
 * Plugin Name: Department Directory
 * Description: Plugin developed to display department directory.
 * Version: 1.0
 * Author: Alice Gonzalez
 * Text Domain: department_directory
*/

//Exit if accessed directly
//Security measure code
if(!defined('ABSPATH')){
    exit;
}

// Register custom post type for Department Management
function dd_register_cpt() {
    // Array: Labels that will be used in the WP admin area for our custom post type*/
    $labels = array(
        'department'                  => _x('Departments', 'Post type general department', 'department_directory'),
        'singular_department'         => _x('Department', 'Post type singular department', 'department_directory'),
        'menu_name'             => _x('Department Directory', 'Admin Menu text', 'department_directory'),
        'department_admin_bar'        => _x('Department', 'Add New on Toolbar', 'department_directory'),
        'add_new'               => __('Add New Department', 'department_directory'),
        'add_new_item'          => __('Add New Department', 'department_directory'),
        'new_item'              => __('New Department', 'department_directory'),
        'edit_item'             => __('Edit Department', 'department_directory'),
        'view_item'             => __('View Department', 'department_directory'),
        'all_items'             => __('All Departments', 'department_directory'),
        'search_items'          => __('Search Departments', 'department_directory'),
        'not_found'             => __('No Departments found.', 'department_directory'),
        'not_found_in_trash'    => __('No Departments found in Trash.', 'department_directory'),
    );

    /** Arguments Array: Defines the settings for our custom post types */
    $args = array(
        'labels'             => $labels, /**Link to the labels array above */
        'public'             => true, /** If public is set to true it makes post visible to the public */
        'has_archive'        => true, /** Accesible on the front end, allow archive pages and suport WP block editor is public is set to true*/
        'show_in_rest'       => true, /** Same as above */
        'supports'           => array('title', 'editor', 'custom-fields'), /** List features available for the post type */
        'menu_position'      => 2, /** */
        'menu_icon'          => 'dashicons-admin-multisite', /** */
        'rewrite'            => array('slug' => 'departments'), /** Defines  URL slug for the post type (ex. www.website.com/Departments */
    );

    register_post_type('department', $args); /** This is a WP function used to register (create) a post on the site */
}
add_action('init', 'dd_register_cpt'); /** This is a hook and it connects our custom function to a specific point in the WP process using actions and filters */
/** In ths case the add_action hook tells WP to run our custom function during the init event */
/** This mean whenever someone visits the WP dashboard or any part of the site the entire function runs ans registers the CPT */

// Add custom meta boxes for additional Department details
function dd_add_department_metabox() { /** This function adds meta box to the CPT */
    add_meta_box( /** Add parameters */
        'dd_details', //Unique ID
        __('Department Details', 'department_directory'), //Title : will appear at the top of meta box
        'dd_render_department_meta_box', //Callback function not boxes box
        'department', //Post type : indicates meta boxes will only appear in this CPT (not on every post or page)
        'normal', //Context : Will display meta box of main area of edit screen and all context is together
        'default' //Priority : Determines the order of the meta box on the page
    );
}
add_action('add_meta_boxes', 'dd_add_department_metabox');

/** This function outputs an HTML form for the custom meta box */
function dd_render_department_meta_box($post) { //Handles rendering of HTML for the fields
    // Retrieve current meta values
    wp_nonce_field('dd_save+department_data', 'dd_nonce'); 

    $building = get_post_meta($post->ID, 'building', true);
    $phone = get_post_meta($post->ID, 'phone', true);
    $email = get_post_meta($post->ID, 'email', true);
    $link = get_post_meta($post->ID, 'link', true);
      //Note we are closing below to write a combination of HTML and PHP
    ?> 

    
    <label for="dd_building"><?php _e('Building', 'department_directory'); ?>:</label>
    <input type="text" id="dd_building" name="dd_building" value="<?php echo esc_attr($Department_start_date); ?>" style="width: 100%; margin-bottom: 10px;" />
    
    <label for="dd_phone"><?php _e('Phone', 'department_directory'); ?>:</label>
    <input type="text" id="dd_phone" name="dd_phone" value="<?php echo esc_attr($phone); ?>" style="width: 100%; margin-bottom: 10px;" />

    <label for="dd_email"><?php _e('Email', 'department_directory'); ?>:</label>
    <input type="email" id="dd_email" name="dd_email" value="<?php echo esc_attr($email); ?>" style="width: 100%; margin-bottom: 10px;" />

    <label for="dd_link"><?php _e('Link', 'department_directory'); ?>:</label>
    <input type="url" id="dd_link" name="dd_link" value="<?php echo esc_url($link); ?>" style="width: 100%; margin-bottom: 10px;" />

    <!-- Open PHP tag to transition between HTML to PHP again -->
    <?php
}

// Save custom meta box data
//This funtion ensures that data entered into the Department start, Department end and Department status meta boxes are saved corectly
// Save custom meta box data
function dd_save_meta_box_data($post_id) {
    // Check if this is an autosave or a revision and stop processing
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    
    // Ensure the post is not a revision
    if (wp_is_post_revision($post_id)) return;
    // Verify nonce to prevent unauthorized submissions
    if (!isset($_POST['dd_nonce']) || !wp_verify_nonce($_POST['dd_nonce'], 'dd_save_department_data')) {
        return;
    }
    // Get the department name (title)
    $department_name = get_post_field('post_title', $post_id);

    // Check if a department with the same name already exists (excluding the current post itself)
    $existing_department = get_posts(array(
        'post_type' => 'department',
        'post_title' => $department_name,
        'posts_per_page' => 1,
        'post__not_in' => array($post_id) // Exclude the current post ID
    ));

    if (!empty($existing_department)) {
        // If department exists, prevent save and return
        // Optionally, you can add an admin notice or error message here
        wp_die(__('A department with this name already exists. Please choose a different name.', 'department_directory'));
        return;
    }


    // Save other custom meta data like building, phone, email, link
    if (array_key_exists('dd_building', $_POST)) {
        update_post_meta(
            $post_id,
            'building',
            sanitize_text_field($_POST['dd_building'])
        );
    }

    if (array_key_exists('dd_phone', $_POST)) {
        update_post_meta(
            $post_id,
            'phone',
            sanitize_text_field($_POST['dd_phone'])
        );
    }

    if (array_key_exists('dd_email', $_POST)) {
        update_post_meta(
            $post_id,
            'email',
            sanitize_email($_POST['dd_email'])
        );
    }

    if (array_key_exists('dd_link', $_POST)) {
        update_post_meta(
            $post_id,
            'link',
            esc_url_raw($_POST['dd_link'])
        );
    }
}
add_action('save_post', 'dd_save_meta_box_data');


//Now that we set up CPT and what it will ask, now we need to display this on the front end of our site
// Display Department details on the front end
//This function is used to access the actual values that are input into our meta boxes & also displays on fronend of website
function dd_display_details($content) {
    if (is_singular('department')) { //Conditional check: checks if in current page is a single post or entry on our Department CPT, remember custom plugin info only on CPT set up not every post on the website
        global $post; //Gives access to the current post or CPT
        
        //Retrieve custom field values: start date, end date and status
        $building = get_post_meta($post->ID, 'building', true);
        $phone = get_post_meta($post->ID, 'phone', true);
        $email = get_post_meta($post->ID, 'email', true);
        $link = get_post_meta($post->ID, 'link', true);


        //HTML block using custom content variables to display Department details
        $custom_content = "<div class='department-details'>";
        $custom_content .= "<p><strong>Building:</strong> " . esc_html($building) . "</p>";
        $custom_content .= "<p><strong>Phone:</strong> " . esc_html($phone) . "</p>";
        $custom_content .= "<p><strong>Email:</strong> <a href='mailto:" . esc_attr($email) . "'>" . esc_html($email) . "</a></p>";
        $custom_content .= "<p><strong>Link:</strong> <a href='" . esc_url($link) . "' target='_blank'>" . esc_url($link) . "</a></p>";
        $custom_content .= "</div>";

        $content .= $custom_content; //Appends custom content to the main content post or what's in default WP editor section
    }
    return $content;
}
add_filter('the_content', 'dd_display_details');

function dd_enqueue_styles() {
    wp_enqueue_style('department_directory_styles', plugin_dir_url(__FILE__) . 'css/department_directory_styles.css');
}
add_action('wp_enqueue_scripts', 'dd_enqueue_styles');

//NOW READY TO ACTIVATE PLUGIN