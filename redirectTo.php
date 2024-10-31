<?php

/*
  Plugin Name: RedirectTo
  Plugin URI: http://www.wildiney.com/wordpress-plugins/redirectto
  Description: Plugin to redirect pages to another URL.
  Version: 1.0
  Author: Wildiney Di Masi
  Author URI: http://www.wildiney.com
  License: GPL2
 */

/*  Copyright 2013  Wildiney Di Masi  (email : wildiney@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

class RedirectTo
{
    public function __construct(){
        register_activation_hook(__FILE__, 'rt_install');
        register_deactivation_hook(__FILE__, 'rt_deactivate');
        register_uninstall_hook(__FILE__, 'rt_uninstall');

        add_action('init', array(&$this,'load_stylesheet'));
        add_action('init', array(&$this,'load_scripts'));

        add_shortcode("redirectTo", array(&$this,"redirectTo"));
    }

    public function rt_install(){}
    public function rt_deactivate(){}
    public function rt_uninstall(){}

    public function load_scripts() {
      wp_enqueue_script('jquery');
      wp_enqueue_script('redirectToJS', WP_PLUGIN_URL . '/redirectTo/js/redirect.js', array('jquery'), '1.0', false);
      }

    public function load_stylesheet() {
      wp_register_style('redirectToCss', WP_PLUGIN_URL . '/redirectTo/css/style.css');
      wp_enqueue_style('redirectToCss');
      }

    public function redirectTo($atts, $content=null) {
        extract(shortcode_atts(array('url' => null, 'in' => '30'), $atts));
        if(!$url){
            echo "There is no Url.";
        } else {
            if($content!=null){
                $in = "<span id='redirect_secs'>".$in."</span>";
                $url = "<a href='".$url."' id='redirect_site'>".$url."</a>";
                $string = sprintf($content, $in, $url);
            } else {
                $string = "Your site will be redirected in <span id='redirect_secs'>30</span> seconds.";
            }
        }
        return $string;
    }

}

$newRedirect = new RedirectTo();