(function($){
  
  function copyVars(fromEl, toEl){
    if(!fromEl || !toEl) return;
    
    var styles = getComputedStyle(fromEl);
    
    var vars = [
      '--bk-modal-close-bg',
      '--bk-modal-close-color',
      '--bk-modal-close-size',
      '--bk-modal-backdrop',
      '--bk-stat-bg',
      '--bk-stat-radius',
      '--bk-stat-border',
      '--bk-stat-border-w',
      '--bk-stat-pad-t', '--bk-stat-pad-r', '--bk-stat-pad-b', '--bk-stat-pad-l',
      '--bk-stat-icon',
      '--bk-stat-icon-size',
      '--bk-stat-value',
      '--bk-stat-label',
      '--bk-modal-chip-bg',
      '--bk-modal-chip-color',
      '--bk-modal-chip-radius',
      '--bk-modal-chip-gap',
      '--bk-li-icon-color',
      '--bk-li-icon-size',
      '--bk-li-gap',
      '--bk-li-text-color',
      '--bk-modal-section-title-color',
      '--bk-modal-v133',
      
      // Popup Buton
      '--bk-modal-cta-bg',
      '--bk-modal-cta-color',
      '--bk-modal-cta-pad',
      '--bk-modal-cta-radius',
      '--bk-modal-cta-bg-hover',
      '--bk-modal-cta-color-hover',
      '--bk-modal-cta-transform'
    ];

    vars.forEach(function(v){
      var val = styles.getPropertyValue(v);
      if(val !== '') toEl.style.setProperty(v, val.trim());
    });
  }

  function isEditor(){
    try { return (window.elementorFrontend && elementorFrontend.isEditMode && elementorFrontend.isEditMode()); } catch(e){ return false; }
  }

  function moveModalsToBody($root){
    if(isEditor()){ $root.addClass('bk-is-editor'); }

    $root.find('.bk-modal').each(function(){
      var $modal = $(this);
      var modalId = $modal.attr('id');

      if(modalId && isEditor()){
         var $ghost = $('body').children('#' + modalId);
         if($ghost.length > 0){
             $ghost.remove();
         }
      }

      var fromEl = $root.closest('.elementor-widget').get(0) || $root.get(0);
      document.body.appendChild(this);
      copyVars(fromEl, this);
    });
  }

  function init($root){
    if(!$root || !$root.length) return;
    
    moveModalsToBody($root);

    var def = $root.data('default') || 'tab1';
    
    function setTab(t){
      $root.find('[data-bk-tab]').removeClass('is-active');
      $root.find('[data-bk-tab="'+t+'"]').addClass('is-active');
      $root.find('[data-bk-panel]').removeClass('is-active');
      $root.find('[data-bk-panel="'+t+'"]').addClass('is-active');
    }
    setTab(def);

    $root.off('click', '[data-bk-tab]').on('click', '[data-bk-tab]', function(){ 
        setTab($(this).data('bk-tab')); 
    });

    $root.off('click', '[data-bk-open]').on('click', '[data-bk-open]', function(){
      var id = $(this).data('bk-open');
      var $m = $('#'+id);
      
      var fromEl = $(this).closest('.elementor-widget').get(0) || $root.closest('.elementor-widget').get(0) || $root.get(0);
      
      copyVars(fromEl, $m.get(0));
      
      $m.addClass('is-open').attr('aria-hidden','false');
      
      if(isEditor()){
        var modalEl = $m.get(0);
        if(modalEl.__bkSyncTimer){ clearInterval(modalEl.__bkSyncTimer); }
        
        modalEl.__bkSyncTimer = setInterval(function(){
          if(!document.contains(fromEl)) { 
             clearInterval(modalEl.__bkSyncTimer); 
             return;
          }
          copyVars(fromEl, modalEl);
        }, 500);
      }
      
      $('body').addClass('bk-modal-open');
    });
  }

  if(!window.bkEventsDefined) {
      $(document).on('click', '[data-bk-close]', function(){
        var $m = $(this).closest('.bk-modal');
        var modalEl = $m.get(0);
        if(modalEl && modalEl.__bkSyncTimer){ clearInterval(modalEl.__bkSyncTimer); modalEl.__bkSyncTimer=null; }
        
        $m.removeClass('is-open').attr('aria-hidden','true');
        $('body').removeClass('bk-modal-open');
      });

      $(document).on('keydown', function(e){
        if(e.key === 'Escape'){
          $('.bk-modal.is-open').each(function(){
               var modalEl = this;
               if(modalEl.__bkSyncTimer){ clearInterval(modalEl.__bkSyncTimer); }
          });
          $('.bk-modal.is-open').removeClass('is-open').attr('aria-hidden','true');
          $('body').removeClass('bk-modal-open');
        }
      });
      window.bkEventsDefined = true;
  }

  $(window).on('elementor/frontend/init', function(){
    elementorFrontend.hooks.addAction('frontend/element_ready/benkruz_paketler_widget.default', function($scope){
      init($scope.find('.bk-paketler'));
    });
  });

})(jQuery);