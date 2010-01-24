<?php



/***


  == DEFAULT FUNCTION
  The function which gets executed must have the same name as the file.
  In this case, our filename is my_images.php, therefore the function which gets called by glz_custom_fields is my_images().

  You can have other functions or classes, but these will not be called by glz_custom_fields (think helpers).
  TXP plugins work in the same way. This script can in fact be regarded as a plugin for glz_custom_fields.


  == VALUES PASSED BY glz_custom_fields
  * $custom_field = 'custom_14'
  Helpful for form element names, db queries etc.
  All results generated by this script will end under $custom_field on the write tab.
  
  * $custom_id = 'custom-14'
  Helpful for form ids. This is an artifact and will be removed in the near future.
  
  * $custom_value = 'custom field value for this article'
  Used mainly for comparison with $default_value


  == AVAILABLE FUNCTIONS
  You can use any functions within the TXP scope (this includes functions defined by other plugins).
  These are the functions which glz_custom_fields uses to create all the pretty input elements:

  * fInput($type, $name, $value, $class='', $title='', $onClick='', $size='', $tab='', $id='', $disabled = false)
  This is the default TXP function for creating text fields, it resides in textpattern/lib/txplib_forms.php.

  * glz_selectInput($name = '', $id = '', $arr_values = '', $custom_value = '', $default_value = '', $multi = '')
  Had to duplicate the default selectInput() because trimming \t and \n didn't work + some other mods & multi-select.
  Part of glz_custom_fields.

  * glz_checkbox($name = '', $arr_values = '', $custom_value = '', $default_value = '')
  Had to duplicate the default checkbox() to keep the looping in here and check against existing value/s.
  Part of glz_custom_fields.

  * glz_radio($name = '', $id = '', $arr_values = '', $custom_value = '', $default_value = '')
  Had to duplicate the default radio() to keep the looping in here and check against existing value/s.
  Part of glz_custom_fields.
  
  * text_area($name, $h, $w, $thing = '', $id = '')
  This is the default TXP function for creating text areas, it resides in textpattern/lib/txplib_forms.php.

  To see what other helper functions glz_custom_fields comes with, check the code of above functions.


  == SPECIAL CUSTOM FIELDS
  They are just fInput() with specific classes. Everything gets "attached" to them via JS.
  If you're thinking to create special custom fields, you must be good, digging through code should be second nature ; ).
  To help you out, just search for GLZ_CUSTOM_FIELDS (case insensitive) and you'll stumble across all the JS used by glz_custom_fields.
  
  I must emphasize that the JS for this plugin isn't the best, but it works and it's been hacked at for over 2 years now.
  I am thinking to rewrite it all, but it would be a huge undertaking, not worth it currently (or maybe ever).
  Go on, show me how it's done properly! : )


  == RETURN VALUE
  The return value gets included under $custom_field label under write tab.
  You can return anything from radio inputs with thumbnails of all images under category "Summer 2009" to
  a list of imdb.com news feed items.
  
  Don't limit custom fields to handling data. You might want to embed a YouTube video on the left-hand side of your article
  explaining how to enter/update it. Once I'll add support for grouping custom fields into user-defined headings, this will be great
  for providing inline documentation for your customers or just adding more services (Twitter? LinkedIn? anything with an API)
  right into TXP. Just think big!


***/



// this function will return all images in txp_image table in a select
// txp_image.id will be used as the key, txp_image.name as the value
function my_images($custom_field, $custom_id, $custom_value) {
  $images = array();
  $query = safe_rows("id, name", "txp_image", "1=1");
  
  foreach ($query as $image)
    $images[$image['id']] = $image['name'];
  
  // because we can't set a {default} value from Extensions > Custom Fields, we're hard-coding it here
  return glz_selectInput($custom_field, $custom_id, $images, $custom_value, "2");
}

?>