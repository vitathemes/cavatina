<?php
/**
 * Theme Setup
 *
 * @package cavatina
 */

 
/**
 * Register Post-type and Taxonomy
 */
if (function_exists('LibWp')) {
    LibWp()->postType()
        ->setName('projects')
        ->setLabels([
            'name'          => _x('Projects', 'Post type general name', 'cavatina'),
            'singular_name' => _x('Project', 'Post type singular name', 'cavatina'),
            'menu_name'     => _x('Projects', 'Admin Menu text', 'cavatina'),
            'add_new'       => __('Add New', 'cavatina'),
            'edit_item'     => __('Edit Project', 'cavatina'),
            'view_item'     => __('View Project', 'cavatina'),
            'all_items'     => __('All Projects', 'cavatina'),
        ])
        ->setArgument('show_ui', true)
        ->setArgument('menu_position' , 5)
        ->setArgument('show_in_rest' , true)
        ->setArgument('taxonomies' , array( 'category' ))
        ->setArgument('hierarchical' , false)
        ->setArgument('public' , true)
        ->setArgument('show_in_nav_menus' , true)
        ->setArgument('show_in_admin_bar' , true)
        ->setArgument('can_export' , true)
        ->setArgument('has_archive' , true)
        ->setArgument('exclude_from_search' , false)
        ->setArgument('publicly_queryable' , true)
        ->setArgument('capability_type' , 'post')
        ->setArgument('show_in_rest' , true)
        ->setArgument('supports' , array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields',))
        ->register();

    LibWp()->taxonomy()
        ->setName('types')
        ->setPostTypes('projects')
        ->setLabels([
            'name'          => _x('Types', 'taxonomy general name', 'cavatina'),
            'singular_name' => _x('Type', 'taxonomy singular name', 'cavatina'),
            'search_items'  => __('Search Types', 'cavatina'),
            'all_items'     => __('All Types', 'cavatina'),
            'edit_item'     => __('Edit Type', 'cavatina'),
            'add_new_item'  => __('Add New Type', 'cavatina'),
            'new_item_name' => __('New Type Name', 'cavatina'),
            'menu_name'     => __('Types', 'cavatina'),
        ])
        ->register();
}