<?php
if (!function_exists('create_post_type_residence')) {
  function create_post_type_residence() {
    register_post_type( 'residence',
      array(
        'labels' => array(
          'name'               => 'Résidences',
          'singular_name'      => 'Résidence',
          'all_items'          => 'Toutes les résidences',
          'add_new'            => 'Ajouter',
          'add_new_item'       => 'Ajouter une résidence',
          'new_item'           => 'Nouvelle résidence',
          'edit_item'          => 'Modifier la résidence',
          'view_item'          => 'Voir la résidence',
          'search_items'       => 'Chercher une résidence',
          'not_found'          => 'Aucune résidence trouvée',
          'not_found_in_trash' => 'Aucune résidence trouvée dans la poubelle',
          'parent_item'        => '',
          'parent_item_colon'  => '',
          'menu_name'          => 'Résidences'
        ),
        'public'        => true,
        'has_archive'   => true,
        'rewrite'       => array('slug' => 'residence'),
        'menu_position' => 7,
        'show_ui'       => true,
        'supports'      => array('thumbnail', 'title')
      )
    );
    flush_rewrite_rules();
  }
}
add_action('init', 'create_post_type_residence');

if (!function_exists('create_residences_taxonomies'))
{
  function create_residences_taxonomies()
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

    register_taxonomy('residences_category', 'residence', array(
      'hierarchical' => true,
      'labels'       => $labels,
      'show_ui'      => true,
      'query_var'    => true,
      'rewrite'      => array('slug' => 'categorie-de-residences')
    ));

  }
}
add_action( 'init', 'create_residences_taxonomies', 0 );
?>