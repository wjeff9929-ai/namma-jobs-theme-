<?php
/* Template Name: Job Listings */
get_header(); ?>

<div class="job-listings">
    <h1><?php the_title(); ?></h1>

    <form method="GET" class="job-filter-form">
        <input type="text" name="search" placeholder="Search Jobs..." value="<?php echo get_search_query(); ?>" />
        <select name="category">
            <option value="">All Categories</option>
            <?php
            $terms = get_terms(['taxonomy' => 'job_category', 'hide_empty' => false]);
            foreach ($terms as $term) {
                echo '<option value="' . $term->slug . '" ' . selected($_GET['category'] ?? '', $term->slug, false) . '>' . $term->name . '</option>';
            }
            ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <?php
    $args = [
        'post_type' => 'job',
        'posts_per_page' => 10,
        'paged' => get_query_var('paged') ?: 1,
    ];

    if (!empty($_GET['search'])) {
        $args['s'] = sanitize_text_field($_GET['search']);
    }

    if (!empty($_GET['category'])) {
        $args['tax_query'] = [
            [
                'taxonomy' => 'job_category',
                'field' => 'slug',
                'terms' => sanitize_text_field($_GET['category']),
            ]
        ];
    }

    $jobs = new WP_Query($args);

    if ($jobs->have_posts()) :
        echo '<ul class="job-list">';
        while ($jobs->have_posts()) : $jobs->the_post();
            echo '<li class="job-item">';
            echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
            echo '<p>' . get_the_excerpt() . '</p>';
            echo '</li>';
        endwhile;
        echo '</ul>';

        the_posts_pagination();

    else :
        echo '<p>No jobs found.</p>';
    endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
