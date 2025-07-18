// Register Job Custom Post Type
function namma_register_job_post_type() {
    register_post_type('job', array(
        'labels' => array(
            'name' => __('Jobs'),
            'singular_name' => __('Job')
        ),
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'jobs'),
        'supports' => array('title', 'editor', 'excerpt', 'custom-fields'),
        'menu_icon' => 'dashicons-id',
    ));
    
    // Register Job Category taxonomy
    register_taxonomy('job_category', 'job', array(
        'labels' => array(
            'name' => 'Job Categories',
            'singular_name' => 'Job Category',
        ),
        'hierarchical' => true,
        'show_admin_column' => true,
        'rewrite' => array('slug' => 'job-category'),
    ));
}
add_action('init', 'namma_register_job_post_type');
