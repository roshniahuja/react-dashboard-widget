<?php
/*
Plugin Name: React Dashboard Widget
Description: A WordPress plugin with a ReactJS Dashboard Widget.
Version: 1.0
Author: Roshni Ahuja
*/

// Enqueue scripts
function enqueue_scripts() {
    // Enqueue React app script
    wp_enqueue_script('react-app', plugins_url('react-app/build/static/js/main.js', __FILE__), array(), '1.0', true);

    // Enqueue Dashboard Widget script
    wp_enqueue_script('dashboard-widget', plugins_url('dashboard-widget.js', __FILE__), array('react-app'), '1.0', true);

    // Pass data from PHP to JavaScript
    wp_localize_script('dashboard-widget', 'my_plugin_data', array(
        'rest_url' => esc_url_raw(rest_url('dashboardwidget/v1/data')),
    ));
}

add_action('admin_enqueue_scripts', 'enqueue_scripts');

// Register REST API endpoint for data

add_action( 'rest_api_init', function () {
  register_rest_route( 'dashboardwidget/v1', '/data/', array(
    'methods' => 'GET',
    'callback' => 'get_data',
  ) );
} );

// Callback function to retrieve data
function get_data() {
    // Get the selected time range from the query parameters
    $range = isset($_GET['range']) ? sanitize_text_field($_GET['range']) : '7';

    // Calculate the start date based on the selected range
    $start_date = date('Y-m-d', strtotime('-' . $range . ' days'));

    // Simulate fetching data from the database for the selected time range
    $data = array();
    for ($i = 0; $i < $range; $i++) {
        $date = date('Y-m-d', strtotime($start_date . ' +' . $i . ' days'));
        $value = rand(10, 100); // Simulated data, replace with your actual data retrieval logic
        $data[] = array('date' => $date, 'value' => $value);
    }

    return rest_ensure_response($data);
}

// Create dashboard widget
function create_dashboard_widget() {
    wp_add_dashboard_widget('react_dashboard_widget', 'React Dashboard Widget', 'render_dashboard_widget');
}

add_action('wp_dashboard_setup', 'create_dashboard_widget');

// Render dashboard widget
function render_dashboard_widget() {
    echo '<div id="my-plugin-dashboard-widget"></div>';
}

// Embed React app into the dashboard widget
function embed_react_app() {
    echo '<script>document.addEventListener("DOMContentLoaded", function () {ReactDOM.render(<App />, document.getElementById("my-plugin-dashboard-widget"));});</script>';
}

add_action('wp_dashboard_setup', 'embed_react_app');
