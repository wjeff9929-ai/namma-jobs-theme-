<article>
    <h2><?php the_title(); ?></h2>
    <div><?php the_content(); ?></div>
    <p><strong>Location:</strong> <?php echo get_post_meta(get_the_ID(), 'location', true); ?></p>
</article>
