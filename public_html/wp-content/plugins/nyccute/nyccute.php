<?php
/*
Plugin Name: NYC Cute
Description: Site specific code changes for nyccute.com
*/
/* Start Adding Functions Below this Line */



// creat guest author custom field capability
add_filter( 'the_author', 'guest_author_name' );
add_filter( 'get_the_author_display_name', 'guest_author_name' );

function guest_author_name( $name ) {
global $post;
$author = get_post_meta( $post->ID, 'guest-author', true );

if ( $author ) {
$name = $author;
return $name;
}

}



// add category image
add_action('init', 'my_category_module');
function my_category_module() {
 add_action ( 'edit_category_form_fields', 'add_image_cat');
 add_action ( 'edited_category', 'save_image');
 }
 
 function add_image_cat($tag){
 $category_images = get_option( 'category_images' );
 $category_image = '';
 
 if ( is_array( $category_images ) && array_key_exists( $tag->term_id, $category_images ) ) {
 $category_image = $category_images[$tag->term_id] ;
 }
 
 $all_categories = get_the_category();
 $category_name = $all_categories[0]->cat_name;
 ?>
 
 <tr>
 <th scope="row" valign="top">
 <label for="auteur_revue_image">Image</label></th>
 <td>
 <?php if ($category_image !="" ){ ?>
 <img src="<?php echo $category_image; ?>" alt="<?php echo $category_name; ?>" title="<?php echo $category_name; ?>" />
 <?php } ?>
 
 <br/>
 <input type="text" name="category_image" id="category_image" value="<?php echo $category_image; ?>"/><br />
 <span>This field allows you to add a picture to illustrate the category. Upload the image from the media tab WordPress and paste its URL here.</span>
 </td>
 </tr>
 <?php
 }
 
 
 function save_image($term_id){
 if ( isset( $_POST['category_image'] ) ) {
 //load existing category featured option
 $category_images = get_option( 'category_images' );
 //set featured post ID to proper category ID in options array
 $category_images[$term_id] =  $_POST['category_image'];
 //save the option array
 update_option( 'category_images', $category_images );
 }
 }

 
 
 
 


/* Stop Adding Functions Below this Line */
?>












