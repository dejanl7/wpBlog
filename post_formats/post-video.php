<?php 
	$video_clip = get_post_meta( get_the_ID(), 'portfolio_video', true );	
	$video_type = get_post_meta( get_the_ID(), 'portfolio_video_type', true );
?>

<?php if( $video_type === 'remote' ): ?>
	<div class="embed-responsive embed-responsive-16by9">
		<iframe class="embed-responsive-item" src="<?php echo portfolio_parse_video_url($video_clip); ?>" frameborder="0" allowfullscreen ></iframe>
	</div>
<?php endif; ?>

<?php 
	if( $video_type === 'self' ): 
 
		$uploads = wp_upload_dir();
		$path_to_the_video = $uploads['baseurl'].$video_clip;
?>
	<div align="center" class="embed-responsive embed-responsive-16by9">
		<video class="embed-responsive-item" controls>
			<source src="<?php echo esc_url( $path_to_the_video ); ?>" type="video/mp4">
		</video>	
	</div>

<?php endif; ?>