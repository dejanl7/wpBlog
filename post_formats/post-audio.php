<?php 
	$audio_clip = get_post_meta( get_the_ID(), 'portfolio_audio', true );	
?>

<iframe width="100%" height="200" scrolling="no" frameborder="yes" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo portfolio_parse_audio_url($audio_clip); ?>"></iframe>

