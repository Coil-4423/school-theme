<?php
function register_staff_cpt() {
    // Labels for the Staff CPT
    $labels = array(
        'name'                  => _x( 'Staff', 'Post Type General Name', 'school-theme' ),
        'singular_name'         => _x( 'Staff', 'Post Type Singular Name', 'school-theme' ),
        'menu_name'             => __( 'Staff', 'school-theme' ),
        'name_admin_bar'        => __( 'Staff', 'school-theme' ),
        'add_new_item'          => __( 'Add New Staff', 'school-theme' ),
        'new_item'              => __( 'New Staff', 'school-theme' ),
        'edit_item'             => __( 'Edit Staff', 'school-theme' ),
        'view_item'             => __( 'View Staff', 'school-theme' ),
    );

    // Arguments for the Staff CPT
    $args = array(
        'label'                 => __( 'Staff', 'school-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor', 'thumbnail' ), // Enable title, editor, and thumbnail
        'public'                => true,
        'has_archive'           => true,
        'show_in_rest'          => true, // Gutenberg support
        'rewrite'               => array( 'slug' => 'staff' ),
        'has_archive' => false, // Disable the default archive
    );

    // Register the Staff Custom Post Type
    register_post_type( 'staff', $args );
}
add_action( 'init', 'register_staff_cpt' );

function register_staff_taxonomy() {
    // Labels for the Staff Category Taxonomy
    $labels = array(
        'name'              => _x( 'Staff Categories', 'taxonomy general name', 'school-theme' ),
        'singular_name'     => _x( 'Staff Category', 'taxonomy singular name', 'school-theme' ),
        'search_items'      => __( 'Search Staff Categories', 'school-theme' ),
        'all_items'         => __( 'All Staff Categories', 'school-theme' ),
        'edit_item'         => __( 'Edit Staff Category', 'school-theme' ),
        'add_new_item'      => __( 'Add New Staff Category', 'school-theme' ),
    );

    // Arguments for the Taxonomy
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Behaves like categories (hierarchical)
        'public'            => true,
        'show_in_rest'      => true, // Gutenberg support
        'rewrite'           => array( 'slug' => 'staff-category' ),
    );

    // Register the Staff Category Taxonomy to the Staff CPT
    register_taxonomy( 'staff-category', array( 'staff' ), $args );
}
add_action( 'init', 'register_staff_taxonomy' );

// Register Student CPT
function register_student_cpt() {
    $labels = array(
        'name'                  => _x( 'Students', 'Post Type General Name', 'school-theme' ),
        'singular_name'         => _x( 'Student', 'Post Type Singular Name', 'school-theme' ),
        'menu_name'             => __( 'Students', 'school-theme' ),
        'name_admin_bar'        => __( 'Student', 'school-theme' ),
        'add_new_item'          => __( 'Add New Student', 'school-theme' ),
        'new_item'              => __( 'New Student', 'school-theme' ),
        'edit_item'             => __( 'Edit Student', 'school-theme' ),
        'view_item'             => __( 'View Student', 'school-theme' ),
    );

    $args = array(
        'label'                 => __( 'Student', 'school-theme' ),
        'labels'                => $labels,
        'supports'              => array( 'title', 'editor','thumbnail' ), // Only title and editor support
        'public'                => true,
        'show_in_rest'          => true, // Enable Block Editor (Gutenberg)
        'has_archive'           => true,
        'rewrite'               => array( 'slug' => 'students' ),
    );

    register_post_type( 'student', $args );
}
add_action( 'init', 'register_student_cpt' );

function register_student_taxonomy() {
    // Labels for the Staff Category Taxonomy
    $labels = array(
        'name'              => _x( 'Specialities', 'taxonomy general name', 'school-theme' ),
        'singular_name'     => _x( 'Speciality', 'taxonomy singular name', 'school-theme' ),
        'search_items'      => __( 'Search Specialities', 'school-theme' ),
        'all_items'         => __( 'All Specialities', 'school-theme' ),
        'edit_item'         => __( 'Edit Student Category', 'school-theme' ),
        'add_new_item'      => __( 'Add New Student Category', 'school-theme' ),
    );

    // Arguments for the Taxonomy
    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true, // Behaves like categories (hierarchical)
        'public'            => true,
        'show_in_rest'      => true, // Gutenberg support
        'rewrite'           => array( 'slug' => 'speciality' ),
    );

    // Register the Student Category Taxonomy to the Staff CPT
    register_taxonomy( 'speciality', array( 'student' ), $args );
}
add_action( 'init', 'register_student_taxonomy' );