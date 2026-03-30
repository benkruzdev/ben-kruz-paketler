<?php
if (!defined('ABSPATH')) exit;

class BenKruz_Paketler_Widget extends \Elementor\Widget_Base {

  public function get_name() { return 'benkruz_paketler_widget'; }
  public function get_title() { return 'Ben Kruz Paketler'; }
  public function get_icon() { return 'eicon-price-table'; }
  public function get_categories() { return ['general']; }

  public function get_style_depends() { 
    return [
        'benkruz-paketler-style',
        'elementor-icons',
        'elementor-icons-fa-solid',
        'elementor-icons-fa-regular',
        'elementor-icons-fa-brands',
        'elementor-icons-shared-0'
    ]; 
  }

  public function get_script_depends() { return ['benkruz-paketler-script']; }

  protected function register_controls() {

    /** Tabs **/
    $this->start_controls_section('tabs_section', [
      'label' => 'Sekmeler',
      'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]);

    $this->add_control('tab_1_label', [
      'label' => 'Sekme 1',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => 'LGS',
    ]);

    $this->add_control('tab_2_label', [
      'label' => 'Sekme 2',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => 'YKS',
    ]);

    $this->add_control('default_tab', [
      'label' => 'Varsayılan Sekme',
      'type' => \Elementor\Controls_Manager::SELECT,
      'default' => 'tab1',
      'options' => [
        'tab1' => 'Sekme 1',
        'tab2' => 'Sekme 2',
      ],
    ]);

    $this->end_controls_section();

    /** Repeater **/
    $pkg = new \Elementor\Repeater();

    $pkg->add_control('is_popular', [
      'label' => 'En Popüler',
      'type' => \Elementor\Controls_Manager::SWITCHER,
      'label_on' => 'Evet',
      'label_off' => 'Hayır',
      'return_value' => 'yes',
      'default' => '',
    ]);

    $pkg->add_control('title', [
      'label' => 'Paket Başlığı',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => 'Sayısal Paket',
      'label_block' => true,
    ]);

    $pkg->add_control('year', [
      'label' => 'Yıl',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => '(2026)',
    ]);

    $pkg->add_control('chips', [
      'label' => 'Kart Chipleri (virgülle)',
      'type' => \Elementor\Controls_Manager::TEXT,
      'description' => 'Örn: Matematik, Fizik, +5 ders',
      'default' => 'Matematik, Türkçe, Geometri, +5 ders',
    ]);

    $pkg->add_control('price', [
      'label' => 'Fiyat',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => '₺32.500',
    ]);

    $pkg->add_control('installment', [
      'label' => 'Taksit Metni',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => 'Sadece ₺3.611,11 x 9 taksit',
    ]);

    $pkg->add_control('refund', [
      'label' => 'İade Metni',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => '15 Gün içinde Koşulsuz İade Hakkı',
    ]);

    $pkg->add_control('cta_text', [
      'label' => 'Buton Metni',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => 'Hemen Al',
    ]);

    $pkg->add_control('cta_url', [
      'label' => 'Buton URL',
      'type' => \Elementor\Controls_Manager::URL,
      'placeholder' => 'https://',
    ]);

    // --- POPUP AYARLARI ---
    $pkg->add_control('popup_heading', [
        'label' => 'POPUP İÇERİĞİ',
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]);

    $pkg->add_control('popup_lessons', [
      'label' => 'Popup Dersler (Virgülle ayırın)',
      'type' => \Elementor\Controls_Manager::TEXTAREA,
      'rows' => 2,
      'default' => 'Matematik, Türkçe, Geometri, Fizik, Kimya, Biyoloji',
      'label_block' => true,
    ]);

    $pkg->add_control('stat_1_h', ['type'=>\Elementor\Controls_Manager::HEADING, 'label'=>'İstatistik 1', 'separator'=>'before']);
    $pkg->add_control('stat_1_icon', ['label'=>'İkon','type'=>\Elementor\Controls_Manager::ICONS, 'default'=>['value'=>'fas fa-book','library'=>'fa-solid']]);
    $pkg->add_control('stat_1_val', ['label'=>'Değer','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'31']);
    $pkg->add_control('stat_1_lbl', ['label'=>'Etiket','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'Kitap']);

    $pkg->add_control('stat_2_h', ['type'=>\Elementor\Controls_Manager::HEADING, 'label'=>'İstatistik 2']);
    $pkg->add_control('stat_2_icon', ['label'=>'İkon','type'=>\Elementor\Controls_Manager::ICONS, 'default'=>['value'=>'fas fa-video','library'=>'fa-solid']]);
    $pkg->add_control('stat_2_val', ['label'=>'Değer','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'15K+']);
    $pkg->add_control('stat_2_lbl', ['label'=>'Etiket','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'Video']);

    $pkg->add_control('stat_3_h', ['type'=>\Elementor\Controls_Manager::HEADING, 'label'=>'İstatistik 3']);
    $pkg->add_control('stat_3_icon', ['label'=>'İkon','type'=>\Elementor\Controls_Manager::ICONS, 'default'=>['value'=>'fas fa-file-alt','library'=>'fa-solid']]);
    $pkg->add_control('stat_3_val', ['label'=>'Değer','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'100+']);
    $pkg->add_control('stat_3_lbl', ['label'=>'Etiket','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'Deneme']);

    $pkg->add_control('stat_4_h', ['type'=>\Elementor\Controls_Manager::HEADING, 'label'=>'İstatistik 4']);
    $pkg->add_control('stat_4_icon', ['label'=>'İkon','type'=>\Elementor\Controls_Manager::ICONS, 'default'=>['value'=>'fas fa-users','library'=>'fa-solid']]);
    $pkg->add_control('stat_4_val', ['label'=>'Değer','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'Var']);
    $pkg->add_control('stat_4_lbl', ['label'=>'Etiket','type'=>\Elementor\Controls_Manager::TEXT, 'default'=>'Mentörlük']);

    $pkg->add_control('list_heading', [
        'label' => 'Paket İçerikleri Listesi',
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]);

    $pkg->add_control('list_icon', [
        'label' => 'Liste Madde İkonu',
        'type' => \Elementor\Controls_Manager::ICONS,
        'default' => ['value' => 'fas fa-check-circle', 'library' => 'fa-solid'],
    ]);

    $pkg->add_control('popup_list_text', [
      'label' => 'Maddeler (Her satıra bir özellik yazın)',
      'type' => \Elementor\Controls_Manager::TEXTAREA,
      'rows' => 6,
      'default' => "31 adet konu anlatım kitabı\n31 adet veri bankası\n15.000+ video anlatım\n100+ deneme sınavı",
      'placeholder' => "Madde 1\nMadde 2\nMadde 3",
      'label_block' => true,
    ]);

    // --- REPEATER BİTİŞ ---

    $this->start_controls_section('lgs_section', [
      'label' => 'LGS Paketleri',
      'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]);
    $this->add_control('lgs_packages', [
      'label' => 'LGS Paketleri',
      'type' => \Elementor\Controls_Manager::REPEATER,
      'fields' => $pkg->get_controls(),
      'title_field' => '{{{ title }}}',
    ]);
    $this->end_controls_section();

    $this->start_controls_section('yks_section', [
      'label' => 'YKS Paketleri',
      'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
    ]);
    $this->add_control('yks_packages', [
      'label' => 'YKS Paketleri',
      'type' => \Elementor\Controls_Manager::REPEATER,
      'fields' => $pkg->get_controls(),
      'title_field' => '{{{ title }}}',
    ]);
    $this->end_controls_section();

    /** STYLE: Layout **/
    $this->start_controls_section('style_layout', [
      'label' => 'Layout / Grid',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->add_responsive_control('grid_columns', [
      'label' => 'Sütun Sayısı',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['' => ['min' => 1, 'max' => 4]],
      'default' => ['size' => 3],
      'selectors' => [
        '{{WRAPPER}} .bk-grid' => 'grid-template-columns: repeat({{SIZE}}, minmax(0,1fr));',
      ],
    ]);
    $this->add_responsive_control('grid_gap', [
      'label' => 'Grid Gap',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 60]],
      'default' => ['size' => 26, 'unit' => 'px'],
      'selectors' => [
        '{{WRAPPER}} .bk-grid' => 'gap: {{SIZE}}{{UNIT}};',
      ],
    ]);
    $this->end_controls_section();

    /** STYLE: Toggle **/
    $this->start_controls_section('style_toggle', [
      'label' => 'Toggle',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->start_controls_tabs('toggle_tabs');
    $this->start_controls_tab('toggle_normal', ['label' => 'Normal']);
    $this->add_control('toggle_bg', [
      'label' => 'Buton Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-toggle__btn' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('toggle_color', [
      'label' => 'Yazı Rengi',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-toggle__btn' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
      'name' => 'toggle_border',
      'selector' => '{{WRAPPER}} .bk-toggle__btn',
    ]);
    $this->add_control('toggle_radius', [
      'label' => 'Radius',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}} .bk-toggle__btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);
    $this->add_control('toggle_padding', [
      'label' => 'Padding',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}} .bk-toggle__btn' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'toggle_typo',
      'selector' => '{{WRAPPER}} .bk-toggle__btn',
    ]);
    $this->end_controls_tab();

    $this->start_controls_tab('toggle_active', ['label' => 'Active/Hover']);
    $this->add_control('toggle_active_bg', [
      'label' => 'Active Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-toggle__btn.is-active' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('toggle_active_color', [
      'label' => 'Active Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-toggle__btn.is-active' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'toggle_active_shadow',
      'selector' => '{{WRAPPER}} .bk-toggle__btn.is-active',
    ]);
    $this->end_controls_tab();
    $this->end_controls_tabs();
    $this->end_controls_section();

    /** STYLE: Card **/
    $this->start_controls_section('style_card', [
      'label' => 'Paket Kartı',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->start_controls_tabs('card_tabs');

    $this->start_controls_tab('card_normal', ['label' => 'Normal']);
    $this->add_control('card_bg', [
      'label' => 'Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-card' => 'background: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
      'name' => 'card_border',
      'selector' => '{{WRAPPER}} .bk-pkg-card',
    ]);
    $this->add_control('card_radius', [
      'label' => 'Radius',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}} .bk-pkg-card' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);
    $this->add_control('card_padding', [
      'label' => 'Padding',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}} .bk-pkg-card' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'card_shadow',
      'selector' => '{{WRAPPER}} .bk-pkg-card',
    ]);
    $this->add_responsive_control('card_min_h', [
      'label' => 'Min Height',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 800]],
      'selectors' => ['{{WRAPPER}} .bk-pkg-card' => 'min-height: {{SIZE}}{{UNIT}};'],
    ]);
    $this->end_controls_tab();

    $this->start_controls_tab('card_hover', ['label' => 'Hover']);
    $this->add_control('card_hover_bg', [
      'label' => 'Hover Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-card:hover' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('card_hover_border', [
      'label' => 'Hover Border Rengi',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-card:hover' => 'border-color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'card_hover_shadow',
      'selector' => '{{WRAPPER}} .bk-pkg-card:hover',
    ]);
    $this->add_responsive_control('card_hover_lift', [
      'label' => 'Hover Lift (Y)',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => -20, 'max' => 0]],
      'selectors' => ['{{WRAPPER}} .bk-pkg-card:hover' => 'transform: translateY({{SIZE}}{{UNIT}});'],
    ]);
    $this->end_controls_tab();

    $this->start_controls_tab('card_popular', ['label' => 'Popüler']);
    $this->add_control('popular_border', [
      'label' => 'Popüler Border',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-card.is-popular' => 'border-color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'popular_shadow',
      'selector' => '{{WRAPPER}} .bk-pkg-card.is-popular',
    ]);
    $this->add_control('badge_bg', [
      'label' => 'Badge BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-badge' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('badge_color', [
      'label' => 'Badge Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-badge' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'badge_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-badge',
    ]);
    $this->add_control('badge_radius', [
      'label' => 'Badge Radius',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 999]],
      'selectors' => ['{{WRAPPER}} .bk-pkg-badge' => 'border-radius: {{SIZE}}{{UNIT}};'],
    ]);
    $this->end_controls_tab();

    $this->end_controls_tabs();
    $this->end_controls_section();

    /** STYLE: Typography **/
    $this->start_controls_section('style_typo', [
      'label' => 'Tipografi & Renkler',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->add_control('title_color', [
      'label' => 'Paket Başlığı Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-title' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'title_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-title',
    ]);
    $this->add_control('year_color', [
      'label' => 'Yıl Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-year' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'year_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-year',
    ]);
    $this->add_control('price_color', [
      'label' => 'Fiyat Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-price' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'price_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-price',
    ]);
    $this->add_control('inst_color', [
      'label' => 'Taksit Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-installment' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'inst_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-installment',
    ]);
    $this->add_control('refund_color', [
      'label' => 'İade Satırı Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-refund' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'refund_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-refund',
    ]);
    $this->end_controls_section();

    /** STYLE: Chips **/
    $this->start_controls_section('style_chips', [
      'label' => 'Chipler',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->add_control('chip_bg', [
      'label' => 'Chip BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-chip' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('chip_color', [
      'label' => 'Chip Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-chip' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'chip_typo',
      'selector' => '{{WRAPPER}} .bk-chip',
    ]);
    $this->add_control('chip_radius', [
      'label' => 'Chip Radius',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 999]],
      'selectors' => ['{{WRAPPER}} .bk-chip' => 'border-radius: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_control('chip_padding', [
      'label' => 'Chip Padding',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}} .bk-chip' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);
    $this->add_control('chip_gap', [
      'label' => 'Chip Gap',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 30]],
      'selectors' => ['{{WRAPPER}} .bk-pkg-chips' => 'gap: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_control('plus_bg', [
      'label' => '+ Ders BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-chip.is-plus' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('plus_color', [
      'label' => '+ Ders Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-chip.is-plus' => 'color: {{VALUE}};'],
    ]);
    $this->end_controls_section();

    /** STYLE: Buttons & Link **/
    $this->start_controls_section('style_btn', [
      'label' => 'Buton & Link',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    
    // --- ANA CTA BUTONU ---
    $this->start_controls_tabs('btn_tabs');

    $this->start_controls_tab('btn_normal', ['label' => 'Buton Normal']);
    $this->add_control('btn_bg', [
      'label' => 'Buton BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('btn_color', [
      'label' => 'Buton Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn' => 'color: {{VALUE}};'],
    ]);
    $this->add_control('btn_radius', [
      'label' => 'Buton Radius',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 60]],
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn' => 'border-radius: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_control('btn_padding', [
      'label' => 'Buton Padding',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'btn_typo',
      'selector' => '{{WRAPPER}} .bk-pkg-btn',
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'btn_shadow',
      'selector' => '{{WRAPPER}} .bk-pkg-btn',
    ]);
    $this->end_controls_tab();

    $this->start_controls_tab('btn_hover', ['label' => 'Buton Hover']);
    $this->add_control('btn_hover_bg', [
      'label' => 'Hover BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn:hover' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('btn_hover_color', [
      'label' => 'Hover Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn:hover' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'btn_hover_shadow',
      'selector' => '{{WRAPPER}} .bk-pkg-btn:hover',
    ]);
    $this->add_control('btn_hover_transform', [
      'label' => 'Hover Transform',
      'type' => \Elementor\Controls_Manager::TEXT,
      'default' => 'translateY(-1px)',
      'selectors' => ['{{WRAPPER}} .bk-pkg-btn:hover' => 'transform: {{VALUE}};'],
    ]);
    $this->end_controls_tab();

    $this->end_controls_tabs();


    // --- LINK AYARLARI ---
    $this->add_control('link_heading_separator', [
        'type' => \Elementor\Controls_Manager::DIVIDER,
    ]);

    $this->add_control('link_options_heading', [
        'label' => '"Paket İçerikleri" Linki',
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]);

    $this->start_controls_tabs('link_style_tabs');

    // TAB: Link Normal
    $this->start_controls_tab('link_tab_normal', ['label' => 'Normal']);

    $this->add_control('link_color', [
        'label' => 'Yazı Rengi',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .bk-pkg-link' => 'color: {{VALUE}};'],
    ]);

    $this->add_control('link_bg', [
        'label' => 'Arka Plan Rengi',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .bk-pkg-link' => 'background: {{VALUE}};'],
    ]);

    $this->end_controls_tab();

    // TAB: Link Hover
    $this->start_controls_tab('link_tab_hover', ['label' => 'Hover']);

    $this->add_control('link_hover_color', [
        'label' => 'Yazı Rengi',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .bk-pkg-link:hover' => 'color: {{VALUE}};'],
    ]);

    $this->add_control('link_hover_bg', [
        'label' => 'Arka Plan Rengi',
        'type' => \Elementor\Controls_Manager::COLOR,
        'selectors' => ['{{WRAPPER}} .bk-pkg-link:hover' => 'background: {{VALUE}};'],
    ]);

    $this->add_control('link_hover_border_color', [
        'label' => 'Border Rengi',
        'type' => \Elementor\Controls_Manager::COLOR,
        'condition' => [ 'link_border_border!' => '' ],
        'selectors' => ['{{WRAPPER}} .bk-pkg-link:hover' => 'border-color: {{VALUE}};'],
    ]);

    $this->end_controls_tab();

    $this->end_controls_tabs();

    // Link Ortak Ayarlar
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
        'name' => 'link_typo',
        'selector' => '{{WRAPPER}} .bk-pkg-link',
        'separator' => 'before',
    ]);

    $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
        'name' => 'link_border',
        'selector' => '{{WRAPPER}} .bk-pkg-link',
    ]);

    $this->add_control('link_radius', [
        'label' => 'Köşe Yuvarlama (Radius)',
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', '%'],
        'selectors' => ['{{WRAPPER}} .bk-pkg-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
    ]);

    $this->add_control('link_padding', [
        'label' => 'İç Boşluk (Padding)',
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => ['{{WRAPPER}} .bk-pkg-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
    ]);

    $this->end_controls_section();

    /** STYLE: Modal **/
    $this->start_controls_section('style_modal', [
      'label' => 'Modal (Popup)',
      'tab' => \Elementor\Controls_Manager::TAB_STYLE,
    ]);
    $this->add_control('modal_backdrop', [
      'label' => 'Backdrop Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['.bk-modal__backdrop' => 'background: {{VALUE}};'],
    ]);
    $this->add_control('modal_panel_bg', [
      'label' => 'Panel Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['.bk-modal__panel' => 'background: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
      'name' => 'modal_panel_border',
      'selector' => '.bk-modal__panel',
    ]);
    $this->add_group_control(\Elementor\Group_Control_Box_Shadow::get_type(), [
      'name' => 'modal_panel_shadow',
      'selector' => '.bk-modal__panel',
    ]);
    $this->add_control('modal_panel_radius', [
      'label' => 'Panel Radius',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 40]],
      'selectors' => ['.bk-modal__panel' => 'border-radius: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_control('modal_panel_padding', [
      'label' => 'Panel Padding',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['.bk-modal__panel' => 'padding: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;'],
    ]);

    $this->add_control('modal_title_color', [
      'label' => 'Modal Başlık Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['.bk-modal__title' => 'color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'modal_title_typo',
      'selector' => '.bk-modal__title',
    ]);

    $this->add_control('modal_list_color', [
      'label' => 'Liste Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-li-text-color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'modal_list_typo',
      'selector' => '.bk-modal__list',
    ]);

    $this->add_control('modal_footer_bg', [
      'label' => 'Footer BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['.bk-modal__footer' => 'background: {{VALUE}};'],
    ]);
    
    // --- POPUP BUTON AYARLARI ---
    $this->add_control('modal_cta_heading', [
        'label' => 'Popup Butonu',
        'type' => \Elementor\Controls_Manager::HEADING,
        'separator' => 'before',
    ]);
    
    $this->start_controls_tabs('modal_cta_tabs');
    
    // Tab: Normal
    $this->start_controls_tab('modal_cta_tab_normal', ['label' => 'Normal']);
    
    $this->add_control('modal_cta_color', [
      'label' => 'Yazı Rengi',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-color: {{VALUE}};'],
    ]);
    $this->add_control('modal_cta_bg', [
      'label' => 'Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-bg: {{VALUE}};'],
    ]);
    
    $this->add_control('modal_cta_padding', [
        'label' => 'Padding',
        'type' => \Elementor\Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em'],
        'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-pad: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'],
    ]);
    $this->add_control('modal_cta_radius', [
        'label' => 'Radius',
        'type' => \Elementor\Controls_Manager::SLIDER,
        'range' => ['px' => ['min' => 0, 'max' => 100]],
        'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-radius: {{SIZE}}{{UNIT}};'],
    ]);
    
    $this->end_controls_tab();
    
    // Tab: Hover
    $this->start_controls_tab('modal_cta_tab_hover', ['label' => 'Hover']);
    
    $this->add_control('modal_cta_color_hover', [
      'label' => 'Yazı Rengi',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-color-hover: {{VALUE}};'],
    ]);
    $this->add_control('modal_cta_bg_hover', [
      'label' => 'Arka Plan',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-bg-hover: {{VALUE}};'],
    ]);

    $this->add_control('modal_cta_transform_hover', [
        'label' => 'Hover Efekt (Yükselme)',
        'type' => \Elementor\Controls_Manager::SWITCHER,
        'label_on' => 'Açık',
        'label_off' => 'Kapalı',
        'return_value' => 'translateY(-3px)',
        'default' => 'translateY(-3px)',
        'selectors' => ['{{WRAPPER}}' => '--bk-modal-cta-transform: {{VALUE}};'],
    ]);

    $this->end_controls_tab();
    $this->end_controls_tabs();

    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'modal_cta_typo',
      'selector' => '.bk-modal__cta',
      'separator' => 'before',
    ]);
    
    // Close button
    $this->add_control('modal_close_bg', [
      'label' => 'Kapat Butonu BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'separator' => 'before',
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-close-bg: {{VALUE}};'],
    ]);
    $this->add_control('modal_close_color', [
      'label' => 'Kapat Butonu Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-close-color: {{VALUE}};'],
    ]);
    $this->add_responsive_control('modal_close_size', [
      'label' => 'Kapat Butonu Boyut',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 24, 'max' => 64]],
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-close-size: {{SIZE}}{{UNIT}};'],
    ]);

    // Stats cards
    $this->add_control('modal_stats_bg', [
      'label' => 'İstatistik Kart BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-bg: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Border::get_type(), [
      'name' => 'modal_stats_border',
      'selector' => '{{WRAPPER}} .bk-paketler',
      'fields_options' => [],
    ]);
    $this->add_responsive_control('modal_stats_radius', [
      'label' => 'İstatistik Radius',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 30]],
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-radius: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_control('modal_stats_value_color', [
      'label' => 'İstatistik Değer Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-value: {{VALUE}};'],
    ]);
    $this->add_control('modal_stats_label_color', [
      'label' => 'İstatistik Etiket Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-label: {{VALUE}};'],
    ]);
    $this->add_control('modal_stats_icon_color', [
      'label' => 'İstatistik İkon Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-icon: {{VALUE}};'],
    ]);
    $this->add_responsive_control('modal_stats_icon_size', [
      'label' => 'İstatistik İkon Boyutu',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 10, 'max' => 40]],
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-icon-size: {{SIZE}}{{UNIT}};'],
    ]);

    // Modal chips
    $this->add_control('modal_chip_bg', [
      'label' => 'Modal Chip BG',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-chip-bg: {{VALUE}};'],
    ]);
    $this->add_control('modal_chip_color', [
      'label' => 'Modal Chip Yazı',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-chip-color: {{VALUE}};'],
    ]);
    $this->add_responsive_control('modal_chip_radius', [
      'label' => 'Modal Chip Radius',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 999]],
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-chip-radius: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_responsive_control('modal_chip_gap', [
      'label' => 'Modal Chip Gap',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 30]],
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-chip-gap: {{SIZE}}{{UNIT}};'],
    ]);

    // Icon list
    $this->add_control('modal_list_icon_color', [
      'label' => 'Liste İkon Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-li-icon-color: {{VALUE}};'],
    ]);
    $this->add_responsive_control('modal_list_icon_size', [
      'label' => 'Liste İkon Boyutu',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 12, 'max' => 34]],
      'selectors' => ['{{WRAPPER}}' => '--bk-li-icon-size: {{SIZE}}{{UNIT}};'],
    ]);
    $this->add_responsive_control('modal_list_gap', [
      'label' => 'Liste Satır Gap',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px' => ['min' => 0, 'max' => 24]],
      'selectors' => ['{{WRAPPER}}' => '--bk-li-gap: {{SIZE}}{{UNIT}};'],
    ]);
    
    // v1.3.3: Ek popup stil değişkenleri
    $this->add_control('modal_section_title_color', [
      'label' => 'Bölüm Başlık Renk (Dersler / Paket İçerikleri)',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-section-title-color: {{VALUE}};'],
    ]);
    $this->add_group_control(\Elementor\Group_Control_Typography::get_type(), [
      'name' => 'modal_section_title_typo',
      'selector' => '{{WRAPPER}} .bk-modal__section-title', // editor preview
    ]);
    $this->add_control('modal_section_title_typo_hint', [
      'type' => \Elementor\Controls_Manager::HIDDEN,
      'default' => 'bk-modal-v133',
      'selectors' => ['{{WRAPPER}}' => '--bk-modal-v133: 1;'],
    ]);

    $this->add_control('modal_stats_padding', [
      'label' => 'İstatistik Kart Padding',
      'type' => \Elementor\Controls_Manager::DIMENSIONS,
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-pad-t: {{TOP}}px;--bk-stat-pad-r: {{RIGHT}}px;--bk-stat-pad-b: {{BOTTOM}}px;--bk-stat-pad-l: {{LEFT}}px;'],
    ]);
    $this->add_control('modal_stats_border_color', [
      'label' => 'İstatistik Border Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-border: {{VALUE}};'],
    ]);
    $this->add_control('modal_stats_border_width', [
      'label' => 'İstatistik Border Kalınlık',
      'type' => \Elementor\Controls_Manager::SLIDER,
      'range' => ['px'=>['min'=>0,'max'=>6]],
      'selectors' => ['{{WRAPPER}}' => '--bk-stat-border-w: {{SIZE}}{{UNIT}};'],
    ]);

    $this->add_control('modal_list_text_color', [
      'label' => 'Liste Metin Renk',
      'type' => \Elementor\Controls_Manager::COLOR,
      'selectors' => ['{{WRAPPER}}' => '--bk-li-text-color: {{VALUE}};'],
    ]);

    $this->end_controls_section();
  }

  private function render_package($pkg, $index, $scope_id) {
    $popular = (!empty($pkg['is_popular']) && $pkg['is_popular']==='yes');
    $chips = array_filter(array_map('trim', explode(',', $pkg['chips'] ?? '')));
    $cta_url = $pkg['cta_url']['url'] ?? '';
    $cta_target = !empty($pkg['cta_url']['is_external']) ? ' target="_blank" rel="noopener"' : '';
    $modal_id = esc_attr($scope_id . '-modal-' . $index);
    ?>
    <div class="bk-pkg-card <?php echo $popular ? 'is-popular' : ''; ?>">
      <?php if ($popular): ?><div class="bk-pkg-badge">En Popüler</div><?php endif; ?>

      <div class="bk-pkg-head">
        <div class="bk-pkg-title"><?php echo esc_html($pkg['title']); ?></div>
        <div class="bk-pkg-year"><?php echo esc_html($pkg['year']); ?></div>
      </div>

      <div class="bk-pkg-chips">
        <?php foreach ($chips as $c): ?>
          <span class="bk-chip <?php echo (strpos($c, '+')===0) ? 'is-plus' : ''; ?>"><?php echo esc_html($c); ?></span>
        <?php endforeach; ?>
      </div>

      <div class="bk-pkg-price"><?php echo esc_html($pkg['price']); ?></div>
      <div class="bk-pkg-installment"><?php echo esc_html($pkg['installment']); ?></div>
      <div class="bk-pkg-refund">🛡️ <?php echo esc_html($pkg['refund']); ?></div>

      <a class="bk-pkg-btn" href="<?php echo esc_url($cta_url ?: '#'); ?>"<?php echo $cta_target; ?>>
        <?php echo esc_html($pkg['cta_text']); ?>
      </a>

      <button class="bk-pkg-link" type="button" data-bk-open="<?php echo $modal_id; ?>">Paket İçerikleri</button>

      <?php $this->render_modal($modal_id, $pkg); ?>
    </div>
    <?php
  }

  private function render_modal($modal_id, $pkg) {
    $stats = [];
    for($i=1; $i<=4; $i++){
        if(!empty($pkg["stat_{$i}_val"])){
            $stats[] = [
                'icon' => $pkg["stat_{$i}_icon"] ?? [],
                'value' => $pkg["stat_{$i}_val"],
                'label' => $pkg["stat_{$i}_lbl"]
            ];
        }
    }

    $lessons = array_filter(array_map('trim', explode(',', $pkg['popup_lessons'] ?? '')));
    $raw_list = $pkg['popup_list_text'] ?? '';
    $items = preg_split('/\r\n|\r|\n/', $raw_list);
    $items = array_filter($items, 'trim'); 
    $list_icon = $pkg['list_icon'] ?? ['value'=>'fas fa-check-circle','library'=>'fa-solid'];

    ?>
    <div class="bk-modal" id="<?php echo esc_attr($modal_id); ?>" aria-hidden="true">
      <div class="bk-modal__backdrop" data-bk-close></div>
      <div class="bk-modal__panel" role="dialog" aria-modal="true">
        <button class="bk-modal__close" type="button" data-bk-close>×</button>

        <div class="bk-modal__title-row">
          <div class="bk-modal__title"><?php echo esc_html($pkg['title']); ?></div>
          <div class="bk-modal__year"><?php echo esc_html($pkg['year']); ?></div>
        </div>

        <?php if (!empty($stats)): ?>
        <div class="bk-modal__stats">
          <?php foreach ($stats as $s): ?>
            <div class="bk-stat">
              <div class="bk-stat__icon">
                <?php \Elementor\Icons_Manager::render_icon( $s['icon'], [ 'aria-hidden' => 'true' ] ); ?>
              </div>
              <div class="bk-stat__value"><?php echo esc_html($s['value']); ?></div>
              <div class="bk-stat__label"><?php echo esc_html($s['label']); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if (!empty($lessons)): ?>
        <div class="bk-modal__section">
          <div class="bk-modal__section-title">Dersler</div>
          <div class="bk-modal__chips">
            <?php foreach ($lessons as $l): ?>
              <span class="bk-chip"><?php echo esc_html($l); ?></span>
            <?php endforeach; ?>
          </div>
        </div>
        <?php endif; ?>

        <?php if (!empty($items)): ?>
        <div class="bk-modal__section">
          <div class="bk-modal__section-title">Paket İçerikleri</div>
          <ul class="bk-modal__list">
            <?php foreach ($items as $line): ?>
              <li>
                <span class="bk-li-icon"><?php \Elementor\Icons_Manager::render_icon($list_icon, ['aria-hidden'=>'true']); ?></span>
                <span class="bk-li-text"><?php echo esc_html($line); ?></span>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <?php endif; ?>

        <div class="bk-modal__footer">
          <div class="bk-modal__price">
            <div class="bk-modal__price-main"><?php echo esc_html($pkg['price']); ?></div>
            <div class="bk-modal__price-sub"><?php echo esc_html($pkg['installment']); ?></div>
            <div class="bk-modal__refund">🛡️ <?php echo esc_html($pkg['refund']); ?></div>
          </div>
          <a class="bk-modal__cta" href="<?php echo esc_url(($pkg['cta_url']['url'] ?? '') ?: '#'); ?>">
            <?php echo esc_html(!empty($pkg['cta_text']) ? $pkg['cta_text'] : 'Hemen Satın Al'); ?>
          </a>
        </div>
      </div>
    </div>
    <?php
  }

  protected function render() {
    $s = $this->get_settings_for_display();
    $scope_id = 'bkpk-' . $this->get_id();
    $default = $s['default_tab'] ?? 'tab1';
    $tab1 = $s['tab_1_label'] ?? 'LGS';
    $tab2 = $s['tab_2_label'] ?? 'YKS';
    $lgs = $s['lgs_packages'] ?? [];
    $yks = $s['yks_packages'] ?? [];
    ?>
    <div class="bk-paketler" id="<?php echo esc_attr($scope_id); ?>" data-default="<?php echo esc_attr($default); ?>">
      <div class="bk-toggle">
        <button type="button" class="bk-toggle__btn" data-bk-tab="tab1"><?php echo esc_html($tab1); ?></button>
        <button type="button" class="bk-toggle__btn" data-bk-tab="tab2"><?php echo esc_html($tab2); ?></button>
      </div>

      <div class="bk-tab" data-bk-panel="tab1"><div class="bk-grid">
        <?php foreach ($lgs as $i => $pkg) { $this->render_package($pkg, $i, $scope_id); } ?>
      </div></div>

      <div class="bk-tab" data-bk-panel="tab2"><div class="bk-grid">
        <?php foreach ($yks as $i => $pkg) { $this->render_package($pkg, $i, $scope_id); } ?>
      </div></div>
    </div>
    <?php
  }
}