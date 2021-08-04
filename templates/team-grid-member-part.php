<?php
$post_id  = get_the_ID();
$image_id = get_post_meta( $post_id, 'team_grid_grid_image', true );
if ( ! $image_id ) {
	$image_id = get_post_thumbnail_id( $post_id );
}
$intro        = get_post_meta( $post_id, 'team_grid_intro', true );
$job_title    = get_post_meta( $post_id, 'team_grid_job_title', true );
$short_bio    = get_post_meta( $post_id, 'team_grid_short_bio', true );
$show_desktop = get_post_meta( $post_id, 'team_grid_show_desktop', true ) ? 'show-desktop' : 'hide-desktop';
$show_mobile  = get_post_meta( $post_id, 'team_grid_show_mobile', true ) ? 'show-mobile' : 'hide-mobile';

$css_classes = implode( ' ', [ $show_desktop, $show_mobile ] );
?>
<div class="team-grid__box single__team-grid__box team-grid__box__in-active <?php echo $css_classes; ?>">
    <div class="team-grid__box__content-image">
		<?php
		if ( $image_id ) {
			echo wp_get_attachment_image( $image_id );
		} else {
			printf( '<img src="%s" alt="%s"/>',
				'https://via.placeholder.com/150',
				esc_html__( 'placeholder-image', 'team-grid' )
			);
		}
		?>
    </div>
    <div class="team-grid__box__content-title">
        <div class="close__btn">
            <!--            <i class="fas fa-times" aria-hidden="true"></i>-->
            <svg xmlns="http://www.w3.org/2000/svg" width="24" data-name="Layer 1" viewBox="0 0 64 64">
                <line x1="9.37" x2="54.63" y1="9.37" y2="54.63" fill="none" stroke="#010101" stroke-miterlimit="10"
                      stroke-width="4"/>
                <line x1="9.37" x2="54.63" y1="54.63" y2="9.37" fill="none" stroke="#010101" stroke-miterlimit="10"
                      stroke-width="4"/>
            </svg>
        </div>
        <h3><?php the_title() ?></h3>
		<?php if ( $job_title || $intro ): ?>
            <div class="team-grid__box__content-short_description">
				<?php
				echo ! empty( $job_title )
					? sprintf( '<p class="team-grid__box__job-title">%s</p>', $job_title )
					: '';

				echo ! empty( $intro )
					? sprintf( '<p class="team-grid__box__intro">%s</p>', $intro )
					: '';
				?>
            </div>
		<?php endif; ?>
    </div>
	<?php if ( $short_bio ): ?>
        <div class="team-grid__box__content-description">
			<?php echo wpautop( $short_bio ); ?>
        </div>
	<?php endif; ?>
</div>