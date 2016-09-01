<?php 
	$gallery = get_post_meta( get_the_id(), 'portfolio_gallery_images',  true ); 

	global $sm;
	$gallery_images = portfolio_smeta_images( 'portfolio_gallery_images', get_the_ID(), array() );			
?>

	<div class="media-gallery">
		<?php 
			if( !empty($gallery_images) && has_post_thumbnail() ):
		?>
			<ul class="rslides portfolio-gallery-posts">
					<li style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_ID) ); ?>');"></li>
				<?php
					foreach( $gallery_images as $gallery_image ):
						$show_images = wp_get_attachment_url( $gallery_image);
				?>	
						<li style="background-image: url('<?php echo $show_images; ?>'); "></li>
						
				<?php 
					endforeach;
				?>
			</ul>

			<?php endif; ?>


		<?php if( !empty($gallery_images) && !has_post_thumbnail() ): ?>
			<ul class="rslides portfolio-gallery-posts">
				<?php
					foreach( $gallery_images as $gallery_image ):
						$show_images = wp_get_attachment_url( $gallery_image);
				?>	
						<li style="background-image: url('<?php echo $show_images; ?>')"; ></li>
						
				<?php 
					endforeach;
				?>
			</ul>
		<?php endif; ?>


		<?php if( empty($gallery_images) && has_post_thumbnail() ): ?>
			<ul class="rslides portfolio-gallery-posts">
				<li style="background-image:url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_ID) ); ?>'); "></li>
			</ul>
		<?php endif; ?> 
	</div>