# react-dashboard-widget
A WordPress plugin with a ReactJS Dashboard Widget.
This WordPress plugin adds a customizable Dashboard Widget using ReactJS and the WP REST API. The widget includes a dynamic line chart using the Recharts library, and the data is retrieved from a static database via the REST API. The user can choose to plot data for the last 7 days, 15 days, or 1 month.

# Installation
Download the plugin ZIP file.
Upload and activate the plugin in the WordPress admin panel.

# Requirements
WordPress installation
Basic understanding of ReactJS
Node.js and npm for development

# Setup
Install Node.js and npm if not already installed.
Navigate to the plugin directory in the terminal.
Run npm install to install dependencies.
Run npm run build to compile the React app.

# Usage
Once the plugin is activated, a React-based Dashboard Widget will appear on the WordPress dashboard. The chart will visualize data based on the selected time range (last 7 days, 15 days, or 1 month).

# Customization
To customize the chart appearance, modify the DashboardWidget.js file in the src folder.
Styles can be adjusted in the style.css file in the src folder.
Update the REST API endpoint in wp_react_dashboard_widget_localize_data function in the main PHP file.
WordPress Coding Standards
This plugin adheres to the WordPress Coding Standards.

# Plugin Guidelines
Follow the WordPress Plugin Guidelines for best practices and submission requirements.