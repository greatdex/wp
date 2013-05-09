<?php

add_action('init', 'business_register');

function business_register() {
	//Arguments to create post type
	$args = array(
		'label' => __('Dex Bizs'),
		'singular_label' => __('Dex Business'),
		'public' => true,
		'show_ui' => true,
		'capability_type' => 'post',
		'hierarchical' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'rewrite' => array('slug' => 'businesses', 'with_front' => false),
		);

	//Register type and custom taxonomy for type.
	register_post_type( 'businesses', $args );

	register_taxonomy("biz-type", array('businesses'), array("hierarchical" => true, "label" => "DeX Biz Types", "singular_label" => "DeX Biz Type", "rewrite" => true, "slug" => "business-type"));
}


if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 220, 150 );
	add_image_size( 'storefront', 620, 270, true );
}

add_action( 'admin_init', 'dex_biz_add_meta');

function dex_biz_add_meta() {
	add_meta_box( "business-meta", "Business Options", "dex_biz_meta_options", "businesses", "normal", "high" );
}

function dex_biz_meta_options() {
	global $post;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
			return $post_id;
	$custom = get_post_custom($post->ID);
	$address = $custom['address'][0];
	$address_two = $custom['address_two'][0];
	$city = $custom['city'][0];
	$state = $custom['state'][0];
	$zip = $custom['zip'][0];
	$website = $custom['website'][0];
	$phone = $custom['phone'][0];
	$email = $custom['email'][0];
?>
	<style type='text/css'>
	<?php include('biz.css'); ?>
	</style>
	<div class="biz_extras">
		<?php 
			$website = ($website =="") ? "http://" : $website;
		?>
		<div><label for="">Web Site : </label><input name="website" value="<?=$website; ?>"/></div>
		<div><label for="">Phone : </label><input name="phone" value="<?=$phone; ?>"/></div>		
		<div><label for="">Email : </label><input name="email" value="<?=$email; ?>"/></div>		
		<div><label for="">Address : </label><input name="address" value="<?=$address; ?>"/></div>		
		<div><label for="">Address 2 : </label><input name="address_two" value="<?=$address_two; ?>"/></div>
		<div><label for="">City : </label><input name="city" value="<?=$city; ?>"/></div>		
		<div><label for="">State : </label><input name="state" value="<?=$state; ?>"/></div>		
		<div><label for="">Zip : </label><input name="zip" value="<?=$zip; ?>"/></div>		
	</div>
<?php 
}

add_action( 'save_post', 'biz_save_extras');

function biz_save_extras(){
	global $post;
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) {
		return $post_id;
	} else {
		update_post_meta($post->ID, "website", $_POST["website"]);
		update_post_meta($post->ID, "city", $_POST["city"]);
		update_post_meta($post->ID, "state", $_POST["state"]);
		update_post_meta($post->ID, "address", $_POST["address"]);
		update_post_meta($post->ID, "address_two", $_POST["address_two"]);
		update_post_meta($post->ID, "zip", $_POST["zip"]);
		update_post_meta($post->ID, "phone", $_POST["phone"]);
		update_post_meta($post->ID, "email", $_POST["email"]);
	}
}

add_filter("manage_edit-businesses_columns", "biz_edit_columns");

function biz_edit_columns($columns) {
	$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Business Name",
			"description" => "Description",
			"address" => "Address",
			"phone" => "Phone",
			"email" => "Email",
			"website" => "Website",
			"cat" => "Category",
		);
	return $columns;
}

add_action("manage_businesses_posts_custom_column", "biz_manage_cols");

function biz_manage_cols($column) {
	global $post;
	$custom = get_post_custom();
	switch ($column) {
		case "description":
			the_excerpt();
			break;
		case "address":
			$address = $custom["address"][0].'<br />';
			if($custom["address_two"][0] != "")
				$address .= $custom["address_two"][0].'<br />';
			$address .= $custom["city"][0].', '.$custom["state"][0].' '.$custom["zip"][0];
			echo $address;
			break;
		case "phone":
			echo $custom["phone"][0];
			break;	
		case "email":
			echo $custom["email"][0];
			break;
		case "website":
			echo $custom["website"][0];
			break;
		case "cat":
			echo get_the_term_list($post->ID, 'biz-type');
			break;		
	}
}

/*add_action('init', 'biz_rewrite');

function biz_rewrite() {
	global $wp_rewrite;
	$wp_rewrite->add_permastruct('typename', 'typename/%year%/%postname%/', true, 1);
	add_rewrite_rule('typename/([0-9]{4})/(.+)/?$', 'index.php?typename=$matches[2]', 'top');
	$wp_rewrite->flush_rules();
}
*/

?>