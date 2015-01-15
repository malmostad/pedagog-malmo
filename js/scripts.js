(function ($, root, undefined) {
  /* global jQuery:true, FastClick:true, svgeezy:true, debounce:true; */
  'use strict';

  var Pedagog = function(){
    this.init();
  };

  Pedagog.prototype = {
    init: function(){
      var _ = this;

      _.$menuMobile = $('.menu-mobile > a');
      _.$subMenu = $('.sub-menu');
      _.$filterCategories = $('.filter-categories');
      _.$archiveCategories = $('.archive-categories');
      _.categoryFilter = false;
      _.pageNumber = 1;
      //Init FastClick
      FastClick.attach(document.body);
      //Init svgeezy
      svgeezy.init(false, 'png');

      //On window resize
      var debouncer = debounce(function() {
        _.windowResize();
      }, 250);
      window.addEventListener('resize', debouncer);

      _.responsiveMenu();
      _.filterToggle();

      return this;
    },
    windowResize: function() {
      var _ = this;

      if ($(window).width() >= 768) {
        _.$subMenu.show();
        _.$archiveCategories.show();
      }else {
        _.$subMenu.hide();
      }
      return this;
    },
    responsiveMenu: function() {
      var _ = this;

      _.$menuMobile.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        _.$subMenu.toggle();
      });

      //Close mobile menu dropdown if click is outside of the submenu.
      $(document).on('click', function (e) {
        if (!_.$subMenu.is(e.target) && _.$subMenu.has(e.target).length === 0) {
          _.$subMenu.hide();
        }
      });

      return this;
    },
    filterToggle: function() {
      var _ = this;

      _.$filterCategories.on('click', function() {
        $(this).toggleClass('closed');
        $(this).next(_.$archiveCategories).slideToggle(150);
      });

      return this;
    }
  };

  $(function() {
    var PedagogStart;
    PedagogStart = new Pedagog() || {};
  });
})(jQuery, this);