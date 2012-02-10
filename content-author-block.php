<div class="author-info">
    <h3 class="author-info-title">About the Author:</h3>
    <h4 class="author-name"><?php echo esc_textarea(get_post_meta($post->ID, 'author_name', true)); ?></h4>
    <?php if ( get_post_meta($post->ID, 'author_pic') ): ?>
        <img class="author-pic" src="<?php echo esc_url(get_post_meta($post->ID, 'author_pic', true)); ?>" alt="<?php echo esc_attr(get_post_meta($post->ID, 'author_name', true)); ?>" />
    <?php endif; ?>
    <?php if ( get_post_meta($post->ID, 'author_bio') ): ?>
    <p class="author-bio">
        <?php echo esc_textarea(get_post_meta($post->ID, 'author_bio', true)); ?>
    </p>
    <?php endif; ?>
    <div style="clear:both"></div>
</div>
