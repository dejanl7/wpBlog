<?php
/**
 *@package my_portfolio_theme
 */

?>
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
	<?php global $my_portfolio; ?>
	
	<?php if( empty($my_portfolio["copyrights_author_name"]) && empty($my_portfolio['copyrights_info_id']) ): ?>
		<div class="site-info text-center">
			<?php echo 'Powered by: <b>Dejan Lončar</b>' ; ?><br>
			<span class="sep"> || </span><br>
			<span>
				Copyrights: You can use this wp theme FREE	
			</span>
		</div><!-- .site-info -->	
	
	<?php else: ?>
		<div class="site-info text-center">
			<?php echo 'Powered by: <b>'.$my_portfolio["copyrights_author_name"].'</b>' ; ?> <br>
			<span class="sep"> || </span><br>
			<span>
				<?php echo $my_portfolio['copyrights_info_id']; ?>	
			</span>
		</div><!-- .site-info -->

	<?php endif; ?>
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
