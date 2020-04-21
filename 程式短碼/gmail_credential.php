function gmail_credential() { 
	echo '<meta name="google-site-verification" content="your-key" />';
}
add_action( 'wp_head', 'gmail_credential', 10 );
