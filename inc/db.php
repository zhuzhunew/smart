<?php
/**
 * DB access related functions.
 */

/**
 * Add Platform.
 */
function add_platform($arr) {
    global $wpdb;
    $wpdb->insert('smart_z_platform', $arr);
}

/**
 * Add manufacturer.
 */
function add_manufacturer($arr) {
    global $wpdb;
    $wpdb->insert('smart_z_manufacturer', $arr);
}

/**
 * Insert/update Product into/in the database.
 * 
 * @param array $product Elements to insert.
 * @return int Value 0 on failure. The product ID on success.
 */
function insert_product($product) {
    global $wpdb;

    $defaults = array( 'product_id' => 0, 'product_name' => '', 'product_image' => '');

    $args = wp_parse_args( $product, $defaults );

    $product_id = $args['product_id'];
	$product_name = $args['product_name'];
	$product_image = $args['product_image'];

	$insert = empty( $product_id );
    
    if ( trim( $product_name ) == '' || trim( $product_image ) == '') {
        return 0;
    }

	$product_description = ( ! empty( $args['product_description'] ) ) ? $args['product_description'] : '';
	$product_url = ( ! empty( $args['product_url'] ) ) ? $args['product_url'] : '';
    $product_publish_date = ( ! empty( $args['product_publish_date'] ) ) ? get_date_from_gmt($args['product_publish_date']) : '0000-00-00 00:00:00';
    $product_post_date = ( ! empty( $args['product_post_date'] ) ) ? get_date_from_gmt($args['product_post_date']) : current_time( 'mysql' );
    $product_manufacturer_id = ( ! empty( $args['product_manufacturer_id'] ) ) ? $args['product_manufacturer_id'] : 0;
    
    if ( $insert ) {
        if (false === $wpdb->insert( 'smart_z_product', compact( 'product_name', 'product_image', 'product_description', 'product_url', 'product_publish_date', 'product_post_date', 'product_manufacturer_id' ) ) ) {
            return 0;
        }
        $link_id = (int) $wpdb->insert_id;
    } else {
        if ( false === $wpdb->update( 'smart_z_product', compact( 'product_name', 'product_image', 'product_description', 'product_url', 'product_publish_date', 'product_post_date', 'product_manufacturer_id' ), compact( 'product_id' ) ) ) {
            return 0;
        }
    }
    return $product_id;
}

/**
 * Get poducts from database.
 */
function get_products() {
    global $wpdb;
    $products = $wpdb->get_results( $wpdb->prepare( "
		SELECT *
		FROM smart_z_product
		WHERE product_manufacturer_id = %d AND product_name = %s
    ", 0, 'googlgdot' ) );
    
    $product_count = count($products);
    echo $product_count;
    echo '<br>';
    foreach ($products as $product) {
        echo 'PRODUCT_ID: ' . $product->product_id . ' product_name: ' . $product->product_name . ' product_publish_date: ' . $product->product_publish_date;
        echo '<br>';
    }
}