<?php
/**
 * ThemeUpdate class file.
 *
 * This file contains ThemeUpdate class which checks for latest update for the theme.
 *
 * @package    HighwayTrafficSecurityAgency
 * @author     Chijindu Nzeako <chijindunzeako517@gmail.com>
 * @since      1.0.0
 */

namespace WTS_Theme\App\HTSA;

use Codestartechnologies\WordpressThemeStarter\Interfaces\FilterHooks;

/**
 * Prevent direct access to this file.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'ThemeUpdate' ) ) {
    /**
     * ThemeUpdate Class
     *
     * @package     HighwayTrafficSecurityAgency
     * @author      Chijindu Nzeako <chijindunzeako517@gmail.com>
     */
    final class ThemeUpdate implements FilterHooks
    {
        /**
         * Register filter hooks
         *
         * @return void
         */
        public function register_filters() : void
        {
            $transient = "update_themes";
            add_filter( "pre_set_site_transient_{$transient}", array( $this, 'filter_pre_set_site_transient_transient' ), 10, 2 );
        }

        /**
         * Check if there is an available update for the theme
         *
         * @return false|object
         * @since 1.0.0
         */
        private function is_update_available() : false|object
        {
            $product_info = CodestarAPI::get_product_info();
            $local_version = wp_get_theme()->get( 'Version' );

            if ( CodestarAPI::is_api_error( $product_info ) ) {
                return false;
            }

            return ( version_compare( $product_info->version, $local_version ) === 1 ) ? $product_info : false;
        }

        /**
         * Filters the value of a specific site transient before it is set.
         *
         * @param mixed  $value     New value of site transient.
         * @param string $transient Transient name.
         * @return mixed New value of site transient.
         * @since 1.0.0
         */
        public function filter_pre_set_site_transient_transient( $value, string $transient ) : mixed
        {
            if ( ! empty( $value->checked ) ) {
                $theme_slug = wp_get_theme()->get_template();
                $theme_info = $this->is_update_available();

                if ( false !== $theme_info ) {
                    $value->response[ $theme_slug ] = array(
                        'new_version'   => $theme_info->version,
                        'package'       => $theme_info->package_url,
                        'url'           => $theme_info->description_url,
                    );
                } else {
                    unset( $value->checked[ $theme_slug ] );
                    unset( $value->response[ $theme_slug ] );
                }
            }

        	return $value;
        }
    }
}
