<?php

function ocdi_import_files() {
  return array(
    array(
      'import_file_name'             => 'Blog 01',
      'categories'                   => array( 'Blog' ),
   // 'import_file_url'            => 'https://quattuor.net/',
   // 'import_widget_file_url'     => 'https://quattuor.net/',
   // 'import_customizer_file_url' => 'https://quattuor.net/',
      'import_preview_image_url'   => 'https://quattuor.net/ocdi/blog-01/screenshot.png',
      'import_notice'                => __( 'Light blog is not need plugin. Please deactive plugins for import demo.', 'quattuor' ),
    ),
    array(
      'import_file_name'             => 'Agency 01',
      'categories'                   => array( 'Agency', 'Onepage' ),
      'import_file_url'            => 'https://quattuor.net/ocdi/agency-01/content.xml',
   // 'import_widget_file_url'     => 'https://quattuor.net/ocdi/ocdi/widgets.json',
      'import_customizer_file_url' => 'https://quattuor.net/ocdi/agency-01/customizer.dat',
      'import_preview_image_url'   => 'https://quattuor.net/ocdi/agency-01/screenshot.png',
      'preview_url'                => 'https://quattuor.net/agency-01/',
    ),
   
  );
}
add_filter( 'pt-ocdi/import_files', 'ocdi_import_files' );


function ocdi_after_import_setup() {

    $front_page_id = get_page_by_title( 'Home' );


    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );


}
add_action( 'pt-ocdi/after_import', 'ocdi_after_import_setup' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );