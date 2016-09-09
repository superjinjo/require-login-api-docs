<?php
//Put this in /wp-content/mu-plugins/ or make it into a normal plugin. Whatever.

/**
 * Add the capability to the user role upon checking role.
 * This function doesn't add the capability to the database.
 */
function doc_view_add_cap(array $caps, $caps_check) {
    $cap_to_check = 'read_docs';

    //role_has_cap gives one cap and user_has_cap gives an array
    $caps_check = !is_array($caps_check) ? array($caps_check) : $caps_check;

    if(in_array($cap_to_check, $caps_check)) {
        if(empty($caps[$cap_to_check]) && !empty($caps['edit_pages'])) {
            $caps[$cap_to_check] = true;
        }
    }

    return $caps;
}
add_filter('role_has_cap', 'doc_view_add_cap', 10, 2);
add_filter('user_has_cap', 'doc_view_add_cap', 10, 2);

/**
 * Adds a role specifically for viewing documentation
 */
function doc_view_role() {
    add_role('docs_subscriber', 'Docs Subscriber', array(
        'read' => true,
        'read_docs' => true
    ));
}
add_action('init', 'doc_view_role');

/**
 * Requires user to be logged in to see any page (but not post)
 */
function require_login() {
    if(is_page() && !is_user_logged_in()) {
        auth_redirect();
    }
}
add_action('template_redirect', 'require_login');
