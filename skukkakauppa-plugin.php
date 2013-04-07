<?php
/**
* Plugin Name: S-Kukkakauppa Plugin
* Plugin URI: http://foxnet.fi
* Description: Adds S-Kukkakauppa stuff.
* Version: 0.1.0
* Author: Sami Keijonen
* Author URI: http://foxnet.fi
*
* This program is free software; you can redistribute it and/or modify it under the terms of the GNU
* General Public License version 2, as published by the Free Software Foundation. You may NOT assume
* that you can use any other version of the GPL.
*
* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
* even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*
* @package SKukkakauppaPlugin
* @version 0.1.0
* @author Sami Keijonen <sami.keijonen@foxnet.fi>
* @copyright Copyright (c) 2012, Sami Keijonen
* @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

class SKUKKAKAUPPA_PLUGIN {

	/**
	* PHP5 constructor method.
	*
	* @since 0.1.0
	*/
	public function __construct() {

		/* Set the constants needed by the plugin. */
		add_action( 'plugins_loaded', array( &$this, 'constants' ), 1 );

		/* Internationalize the text strings used. */
		add_action( 'plugins_loaded', array( &$this, 'i18n' ), 2 );

		/* Load the functions files. */
		add_action( 'plugins_loaded', array( &$this, 'includes' ), 3 );
		
		/* Register activation hook. */
		register_activation_hook( __FILE__, array( &$this, 'activation' ) );

	}

	/**
	* Defines constants used by the plugin.
	*
	* @since 0.1.0
	*/
	public function constants() {

		/* Set constant path to the plugin directory. */
		define( 'SKUKKAKAUPPA_PLUGIN_DIR', trailingslashit( plugin_dir_path( __FILE__ ) ) );
		
		/* Set constant path to the plugin directory. */
		define( 'SKUKKAKAUPPA_PLUGIN_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );

		/* Set the constant path to the includes directory. */
		define( 'SKUKKAKAUPPA_PLUGIN_INCLUDES', SKUKKAKAUPPA_PLUGIN_DIR . trailingslashit( 'includes' ) );

	}

	/**
	* Load the translation of the plugin.
	*
	* @since 0.1.0
	*/
	public function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'skukkakauppa-plugin', false, 'skukkakauppa-plugin/languages' );

	}

	/**
	* Loads the initial files needed by the plugin.
	*
	* @since 0.1.0
	*/
	public function includes() {

		require_once( SKUKKAKAUPPA_PLUGIN_INCLUDES . 'functions.php' );
		require_once( SKUKKAKAUPPA_PLUGIN_INCLUDES . 'post-types.php' );
		require_once( SKUKKAKAUPPA_PLUGIN_INCLUDES . 'taxonomy.php' );
		require_once( SKUKKAKAUPPA_PLUGIN_INCLUDES . 'metabox.php' );
		
	}
	
	/**
	 * Method that runs only when the plugin is activated.
	 *
	 * @since  0.1.0
	 */
	function activation() {

		/* Get the administrator role. */
		$role =& get_role( 'administrator' );

		/* If the administrator role exists, add required capabilities for the plugin. */
		if ( !empty( $role ) ) {

			$role->add_cap( 'manage_flower' );
			$role->add_cap( 'create_flowers' );
			$role->add_cap( 'edit_flowers' );
			$role->add_cap( 'edit_flower_items' );
		}
	}

}

new SKUKKAKAUPPA_PLUGIN();

?>