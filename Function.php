function custom_settings_page() {
    add_menu_page(
        'Custom Settings Page',   // Page title
        'Custom Settings',        // Menu title
        'manage_options',         // Capability
        'custom-settings',        // Menu slug
        'custom_settings_callback' // Callback function to display the page content
    );
}

function custom_settings_callback() {
    // Display your settings fields here.
    echo '<h2>Custom Settings</h2>';
    echo '<form method="post" action="options.php">';
    settings_fields('custom-settings-group');
    do_settings_sections('custom-settings');
    submit_button();
    echo '</form>';
}

function custom_settings_init() {
    register_setting('custom-settings-group', 'custom_setting_field');
    add_settings_section('custom-section', 'Custom Settings Section', 'custom_section_callback', 'custom-settings');
    add_settings_field('custom-field', 'Custom Field', 'custom_field_callback', 'custom-settings', 'custom-section');
}

function custom_section_callback() {
    // Section description goes here
}

function custom_field_callback() {
    $value = get_option('custom_setting_field');
    echo '<input type="text" name="custom_setting_field" value="' . esc_attr($value) . '" />';
}

add_action('admin_menu', 'custom_settings_page');
add_action('admin_init', 'custom_settings_init');