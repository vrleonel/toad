<?php
add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

 
// Registrando widget
register_sidebar( array(
    'id'          => 'side1',
    'name'        => 'Side 1',
    'description' => 'Esse sidebar é o primeiro que aparece na lateral',
) );


function new_excerpt_more($more) {
	return '[.....]';
}
add_filter('excerpt_more', 'new_excerpt_more');



/*** Theme setup - GAROTAS NERDS ***/

add_theme_support( 'post-thumbnails' );
add_theme_support( 'automatic-feed-links' );

function sight_setup() {
	update_option('thumbnail_size_w', 290);
    update_option('thumbnail_size_h', 290);
    add_image_size( 'mini-thumbnail', 50, 50, true );
    add_image_size( 'slide', 640, 290, true );
    register_nav_menu('Navigation', __('Navigation'));
    register_nav_menu('Top menu', __('Top menu'));
}
add_action( 'init', 'sight_setup' );

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
    update_option( 'posts_per_page', 12 );
    update_option( 'paging_mode', 'default' );
}

/************* Slideshow ************/

$prefix = 'sgt_';

$meta_box = array(
    'id' => 'slide',
    'title' => 'Slideshow Options',
    'page' => 'post',
    'context' => 'side',
    'priority' => 'low',
    'fields' => array(
        array(
            'name' => 'Show in slideshow',
            'id' => $prefix . 'slide',
            'type' => 'checkbox'
        )
    )
);
add_action('admin_menu', 'sight_add_box');

// Add meta box
function sight_add_box() {
    global $meta_box;

    add_meta_box($meta_box['id'], $meta_box['title'], 'sight_show_box', $meta_box['page'], $meta_box['context'], $meta_box['priority']);
}

// Callback function to show fields in meta box
function sight_show_box() {
    global $meta_box, $post;

    // Use nonce for verification
    echo '<input type="hidden" name="sight_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

    echo '<table class="form-table">';

    foreach ($meta_box['fields'] as $field) {
        // get current post meta data
        $meta = get_post_meta($post->ID, $field['id'], true);

        echo '<tr>',
                '<th style="width:50%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
                '<td>';
                echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
        echo     '<td>',
            '</tr>';
    }

    echo '</table>';
}

add_action('save_post', 'sight_save_data');

// Save data from meta box
function sight_save_data($post_id) {
    global $meta_box;

    // verify nonce
    if (!wp_verify_nonce($_POST['sight_meta_box_nonce'], basename(__FILE__))) {
        return $post_id;
    }

    // check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if ('page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return $post_id;
        }
    } elseif (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    foreach ($meta_box['fields'] as $field) {
        $old = get_post_meta($post_id, $field['id'], true);
        $new = $_POST[$field['id']];

        if ($new && $new != $old) {
            update_post_meta($post_id, $field['id'], $new);
        } elseif ('' == $new && $old) {
            delete_post_meta($post_id, $field['id'], $old);
        }
    }
}


/******** Funções do tema ********/
 function smart_excerpt($string, $limit) {
    $words = explode(" ",$string);
    if ( count($words) >= $limit) $dots = '...';
    echo implode(" ",array_splice($words,0,$limit)).$dots;
}
?>