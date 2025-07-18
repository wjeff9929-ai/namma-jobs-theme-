<?php get_header(); ?>

<h1>Available Jobs</h1>
<?php
$args = array('post_type' => 'job', 'posts_per_page' => 10);
$jobs = new WP_Query($args);

if ($jobs->have_posts()) :
    while ($jobs->have_posts()) : $jobs->the_post();
        get_template_part('template-parts/content', 'job');
    endwhile;
    the_posts_pagination();
else :
    echo '<p>No jobs found.</p>';
endif;
wp_reset_postdata();
?>

<?php get_footer(); ?>
