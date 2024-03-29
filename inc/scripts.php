<?php
/**
 * Enqueue scripts and styles.
 */
function acstarter_scripts() {
	wp_enqueue_style( 'acstarter-style', get_template_directory_uri() . '/style.min.css', array(), '1.2' );

	wp_deregister_script('jquery');
		// wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', false, '1.10.2', false);
	wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', false, '3.4.1', false);
		wp_enqueue_script('jquery');

	wp_enqueue_script( 
			'acstarter-vendors', 
			get_template_directory_uri() . '/assets/js/vendors.min.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
			'acstarter-blocks', 
			get_template_directory_uri() . '/assets/js/vendors/blocks.js', 
			array(), '20120206', 
			true 
		);

	// wp_enqueue_script( 
	// 		'parallax', 
	// 		get_template_directory_uri() . '/assets/js/vendors/parallax.min.js', 
	// 		array(), '3.0.5', 
	// 		true 
	// 	);

	// wp_enqueue_script( 
	// 		'fullpage', 
	// 		get_template_directory_uri() . '/assets/js/vendors/jquery.fullPage.min.js', 
	// 		array(), '3.0.5', 
	// 		true 
	// 	);

	// wp_enqueue_script( 
	// 		'extension-fullpage', 
	// 		get_template_directory_uri() . '/assets/js/vendors/iscroll.min.js', 
	// 		array(), '5.2.0', 
	// 		true 
	// 	);

	// wp_enqueue_script( 
	// 		'scrolloverflow', 
	// 		get_template_directory_uri() . '/assets/js/vendors/scrolloverflow.min.js', 
	// 		array(), '5.2.0', 
	// 		true 
	// 	);

	// wp_enqueue_script( 
	// 		'scrollspy', 
	// 		get_template_directory_uri() . '/assets/js/vendors/scrollspy.js', 
	// 		array(), '0.1.2', 
	// 		true 
	// 	);


	wp_enqueue_script( 
			'acstarter-custom', 
			get_template_directory_uri() . '/assets/js/custom.min.js', 
			array(), '20120206', 
			true 
		);

	wp_enqueue_script( 
		'font-awesome', 
		'https://use.fontawesome.com/8f931eabc1.js', 
		array(), '20180424', 
		true 
	);



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Then... $data is the inline JS from wherever
// wp_add_inline_script('my-script', $data, 'before');
}
add_action( 'wp_enqueue_scripts', 'acstarter_scripts' );