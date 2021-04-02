<?php
$post_id  = get_the_ID();
$image_id = get_post_meta( $post_id, 'team_grid_grid_image', true );
$intro     = get_post_meta( $post_id, 'team_grid_intro', true );
$job_title     = get_post_meta( $post_id, 'team_grid_job_title', true );
$short_bio = get_post_meta( $post_id, 'team_grid_short_bio', true );

?>

<div class="box single__box">
    <div class="box__content-image">
		<?php echo wp_get_attachment_image( $image_id ) ?>
    </div>
    <div class="box__content-title">
        <div class="close__btn">x</div>
        <h3><?php the_title() ?></h3>
        <div class="box__content-job-title">
            <p><?php echo $job_title; ?></p>
        </div>
        <div class="box__content-short_discription">
            <p><?php echo $intro; ?></p>
        </div>
    </div>
    <div class="box__content-discription">
        <p><?php echo $short_bio; ?></p>
    </div>
</div>