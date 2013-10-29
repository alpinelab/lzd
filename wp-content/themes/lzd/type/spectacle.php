<?php
if (!function_exists('create_post_type_spectacle')) {
  function create_post_type_spectacle() {
    register_post_type( 'spectacle',
      array(
        'labels' => array(
          'name'               => 'Spectacles',
          'singular_name'      => 'Spectacle',
          'all_items'          => 'Tous les spectacles',
          'add_new'            => 'Ajouter',
          'add_new_item'       => 'Ajouter un spectacle',
          'new_item'           => 'Nouvelle spectacle',
          'edit_item'          => 'Modifier le spectacle',
          'view_item'          => 'Voir le spectacle',
          'search_items'       => 'Chercher un spectacle',
          'not_found'          => 'Aucune spectacle trouvée',
          'not_found_in_trash' => 'Aucune spectacle trouvée dans la poubelle',
          'parent_item'        => '',
          'parent_item_colon'  => '',
          'menu_name'          => 'Spectacles'
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'spectacle'),
        'menu_position' => 7,
        'show_ui'       => true,
        'supports'      => array('thumbnail', 'title', 'editor')
      )
    );
    flush_rewrite_rules();
  }
}
add_action('init', 'create_post_type_spectacle');

if (!function_exists('create_spectacles_taxonomies'))
{
  function create_spectacles_taxonomies()
  {
     $labels = array(
      'name' 	             => 'Catégories',
      'singular_name'      => 'Catégorie',
      'all_items'          => 'Toutes les catégories',
      'add_new'            => 'Ajouter',
      'add_new_item'       => 'Ajouter une catégorie',
      'new_item'           => 'Nouvelle catégorie',
      'edit_item'          => 'Modifier la catégorie',
      'update_item'        => 'Mettre à jour la catégorie',
      'view_item'          => 'Voir la catégorie',
      'search_items'       => 'Chercher une catégorie',
      'not_found'          => 'Aucune catégorie trouvée',
      'not_found_in_trash' => 'Aucune catégorie trouvée dans la poubelle',
      'parent_item'        => '',
      'parent_item_colon'  => '',
      'menu_name'          => 'Catégories'
    );

    register_taxonomy('spectacles_category', 'spectacle', array(
      'hierarchical' => true,
      'labels'       => $labels,
      'show_ui'      => true,
      'query_var'    => true,
      'rewrite'      => array('slug' => 'categorie-de-spectacles')
    ));

  }
}
add_action( 'init', 'create_spectacles_taxonomies', 0 );
?>