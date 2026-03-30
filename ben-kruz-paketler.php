<?php
/**
 * Plugin Name: Ben Kruz Paketler
 * Description: Elementor için LGS/YKS toggle + Paket kartları + Full-screen modal popup + gelişmiş stil kontrolleri.
 * Version: 1.4.7
 * Author: Ben Kruz
 */

if (!defined('ABSPATH')) exit;

final class BenKruz_Paketler_Plugin {
  const VERSION = '1.4.7';

  public function __construct() {
    add_action('plugins_loaded', [$this, 'init']);
  }

  public function init() {
    if (!did_action('elementor/loaded')) {
      add_action('admin_notices', [$this, 'admin_notice_missing_elementor']);
      return;
    }

    add_action('elementor/widgets/register', [$this, 'register_widgets']);
    add_action('wp_enqueue_scripts', [$this, 'register_assets']);
    add_action('elementor/editor/after_enqueue_styles', [$this,'enqueue_elementor_icons']);
    add_action('wp_enqueue_scripts', [$this,'enqueue_elementor_icons'], 20);
  }

  public function enqueue_elementor_icons(){
    // Ensure Font Awesome libraries are loaded for Icons controls
    if (did_action('elementor/loaded')) {
      wp_enqueue_style('elementor-icons');
      wp_enqueue_style('elementor-icons-fa-solid');
      wp_enqueue_style('elementor-icons-fa-regular');
      wp_enqueue_style('elementor-icons-fa-brands');
      
      // YENİ EKLENEN SATIR: Simple Line Icons kütüphanesini yükler (icon-document vb. için)
      wp_enqueue_style('elementor-icons-shared-0'); 

      // Compatibility: ensure FA5 bundle is loaded when Icons output <i> tags
      if (wp_style_is('font-awesome-5-all','registered')) { wp_enqueue_style('font-awesome-5-all'); }
      if (wp_style_is('font-awesome-4-shim','registered')) { wp_enqueue_style('font-awesome-4-shim');
      wp_enqueue_style('font-awesome');
      // Fallback: load Font Awesome from CDN if theme doesn't provide it
      wp_enqueue_style('benkruz-fa-cdn', 'https://use.fontawesome.com/releases/v5.15.4/css/all.css', [], '5.15.4'); }
    }
  }

  public function register_assets() {
    wp_register_style(
      'benkruz-paketler-style',
      plugins_url('assets/css/benkruz-paketler.css', __FILE__),
      [],
      self::VERSION
    );

    wp_register_script(
      'benkruz-paketler-script',
      plugins_url('assets/js/benkruz-paketler.js', __FILE__),
      ['jquery'],
      self::VERSION,
      true
    );
  }

  public function register_widgets($widgets_manager) {
    require_once __DIR__ . '/widgets/class-benkruz-paketler-widget.php';
    $widgets_manager->register(new \BenKruz_Paketler_Widget());
  }

  public function admin_notice_missing_elementor() {
    echo '<div class="notice notice-warning"><p><strong>Ben Kruz Paketler</strong> çalışması için Elementor eklentisi gereklidir.</p></div>';
  }
}

new BenKruz_Paketler_Plugin();