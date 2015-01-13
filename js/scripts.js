(function ($, root, undefined) {
  /* global jQuery:true, FastClick:true, svgeezy:true, debounce:true; */
  'use strict';

  var Pedagog = function(){
    this.init();
  };

  Pedagog.prototype = {
    init: function(){
      var _ = this;

      _.$menuMobile = $('.menu-mobile');
      _.$subMenu = $('.sub-menu');
      _.$filterCategories = $('.filter-categories');
      _.categoryFilter = false;
      _.pageNumber = 1;
      //Init FastClick
      FastClick.attach(document.body);
      //Init svgeezy
      svgeezy.init(false, 'png');

      //On window resize
      var myEfficientFn = debounce(function() {
        _.windowResize();
      }, 250);
      window.addEventListener('resize', myEfficientFn);

      _.responsiveMenu();
      _.filterToggle();

      //_.ajaxWP();

      return this;
    },
    ajaxWP: function() {
      var _ = this;

      $('.archive-categories a').on('click', function(e) {
        var theCategory = $(this).data('category');
        var append = false;
        _.categoryFilter = true;
        _.ajaxLoadPosts(theCategory, _.pageNumber, append);
        _.pageNumber = 1;
        $('#ajax-load-more').attr('data-category', theCategory);
        $('#ajax-load-more').attr('data-page', _.pageNumber);
        e.preventDefault();
      });

      $('#ajax-load-more').on('click', function(event) {
        var theCategory = $(this).data('category');
        var append = true;
        _.pageNumber = _.pageNumber + 1;
        $('#ajax-load-more').attr('data-page', _.pageNumber);

        _.ajaxLoadPosts(theCategory, _.pageNumber, append);
        event.preventDefault();

      });
      return this;
    },
    ajaxLoadPosts: function(category, page, append) {
      var _ = this;

      $.ajax({
        url: ajaxurl, //This var is set in the global header.
        data: ({
          action: 'show_article_category',
          id: category,
          page: page,
        }),
        dataType: 'html',
        success: function(data){
          if (append === false) {
            $('#articles-list').html(data);
          }else {
            $('#articles-list').append(data);
          }
        },
        error: function(data) {
        console.log(data);
        return false;
        }
      });
      return this;
    },
    windowResize: function() {
      var _ = this;

      if ($(window).width() >= 768) {
        _.$subMenu.show();
        $('.archive-categories').show();
      }
      return this;
    },
    responsiveMenu: function() {
      var _ = this;

      if ($(window).width() <= 768) {
        _.$menuMobile.on('click', 'a', function(e) {
          e.preventDefault();
          _.$subMenu.toggle();
        });
      }

      return this;
    },
    filterToggle: function() {
      var _ = this;

      _.$filterCategories.on('click', function() {
        $(this).toggleClass('closed');
        $(this).next('.archive-categories').slideToggle(150);
      });

      return this;
    }
  };

  $(function() {
    var PedagogStart;
    PedagogStart = new Pedagog() || {};
  });
})(jQuery, this);