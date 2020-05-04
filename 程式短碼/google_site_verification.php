function google_site_verification() { 
	echo '<meta name="google-site-verification" content="your-key" />';
}
add_action( 'wp_head', 'google_site_verification', 10 );
