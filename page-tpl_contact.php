<?php
/*
	Template Name: Contact Page
*/
get_header();
the_post();
?>
<section class="container page-contact">	
	<div class="blog-item-content page_contact">
		<h2 class="post-title page"><?php the_title() ?></h2>
	</div>

	<div class="blog-item-content contact-page-content">
		<div class="post-content post-content-contact-page clearfix">
			<?php the_content(); ?>
		</div>

		<form id="contact-page-form" class="contact-page-form">
			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="name" name="name" placeholder="<?php esc_attr_e( 'Your name', 'portfolio' ); ?>" aria-required="true" />
			</div>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" id="email" name="email" placeholder="<?php esc_attr_e( 'Your email', 'portfolio' ) ?>" aria-required="true" />
			</div>
			<div class="form-group has-feedback">
				<textarea rows="10" cols="120" class="form-control" id="message" name="message" placeholder="<?php esc_attr_e( 'Your message', 'portfolio' ) ?>" aria-required="true"></textarea>															
			</div>
			<p class="form-submit">
				<a href="javascript:;" class="submit-contact-message btn"><?php _e( 'Send Message', 'portfolio' ) ?> </a>
			</p>
			<div class="send_result"></div>
		</form>	
	</div>
</section>
<?php get_footer(); ?>