jQuery(document).ready(function ($) {

  "use strict";

  var isMobile = {
    Android: function () {
      return navigator.userAgent.match(/Android/i);
    },
    BlackBerry: function () {
      return navigator.userAgent.match(/BlackBerry/i);
    },
    iOS: function () {
      return navigator.userAgent.match(/iPhone|iPad|iPod/i);
    },
    Opera: function () {
      return navigator.userAgent.match(/Opera Mini/i);
    },
    Windows: function () {
      return navigator.userAgent.match(/IEMobile/i);
    },
    any: function () {
      return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
    }
  };

  // Fix TopBar On Scroll
  $(window).on('scroll', function () {
    var Top = $(this).scrollTop();
    if (Top == 0) {
      $('body').removeClass('f-topbar-fixed');
      $('.wd-menu-nav.sticky').removeClass('fixed');
    }
  });

  // Categorie span style On Click Event
  $('.cats-btn').on("click", function () {
    if ($(this).hasClass('close-up')) {
      $(this).removeClass('close-up');
    } else {
      $(this).addClass('close-up');
    }
  });
  //Remove Class On Click Out Of Categorie Menu
  $(document).on("mouseup", function (e) {
    var container = $(".cats-btn");

    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.removeClass('close-up');
      container.attr('aria-expanded', 'false');
      $('ul.category-menu').removeClass('open');
    }
  });

  // Hr Width

  $('.wd-heading').each(function () {
    for (var i = 1; i <= 6; i++) {
      if ($(this).find('h' + i).length == 1) {
        $(this).find('hr').innerWidth($(this).innerWidth() - $(this).find('h' + i).innerWidth() - 20);
      }
    }
  });

  $(window).on("resize", function () {
    $('.wd-heading').each(function () {
      for (var i = 1; i <= 6; i++) {
        if ($(this).find('h' + i).length == 1) {
          $(this).find('hr').innerWidth($(this).innerWidth() - $(this).find('h' + i).innerWidth() - 20);
        }
      }
    });
  });
  /****************************/

  // Navicon style
  $('.sidebar-toggle').on("click", function () {
    if ($(this).hasClass('close-up')) {
      $(this).removeClass('close-up');
    } else {
      $(this).addClass('close-up');
    }
  });
  $('.opened-overlay').on("click", function (e) {
    $('.off-canvas-right-sidebar').removeClass('opened');
    $('body').removeClass('off-canvas-right-sidebar-opened');
    if ($('.sidebar-toggle').hasClass('close-up')) {
      $('.sidebar-toggle').removeClass('close-up');
    } else {
      $('.sidebar-toggle').addClass('close-up');
    }
  });
  // Open & Close Off Canvas Sidebar

  $('.sidebar-toggle').on("click", function (e) {
    e.stopPropagation();
    if ($('.off-canvas-right-sidebar').hasClass('opened')) {
      $('.off-canvas-right-sidebar').removeClass('opened');
      $('body').removeClass('off-canvas-right-sidebar-opened');
    } else {
      $('.off-canvas-right-sidebar').addClass('opened');
      $('body').addClass('off-canvas-right-sidebar-opened');
    }
  });

  $('.off-canvas-right-sidebar .right-sidebar-close a').on("click", function () {
    $('.off-canvas-right-sidebar').removeClass('opened');
    $('body').removeClass('off-canvas-right-sidebar-opened');
    if ($('.sidebar-toggle').hasClass('close-up')) {
      $('.sidebar-toggle').removeClass('close-up');
    } else {
      $('.sidebar-toggle').addClass('close-up');
    }
  });

  // Sub Categories Width
  var $fullWidth = $('.row').innerWidth(),
    $dropdownWidth = $('.product_cat').innerWidth();
  $('.category-menu .has-dropdown > .sub-menu').addClass('first-menu');
  $('.first-menu .first-menu').removeClass('first-menu');
  $('.product_cat .first-menu').innerWidth($fullWidth - $dropdownWidth);


  // Hover On Parent Category
  $('.product_cat .parent-cat').on("hover", function () {
    $(this).find('.sub-categories-container').show();
  }, function () {
    $(this).find('.sub-categories-container').hide();
  });

  //test icon hover effect -------------

  $(".box-icon-data").hover(
    function () {
      var $this = $(this);
      $this.css("background-color", $this.data('box-hover-bg'));
    },
    function () {
      var $this = jQuery(this);
      $this.css("background-color", $this.data('box-bg'));
    }
  );


// -------------------------------------------------------------
//   min cart
// -------------------------------------------------------------
//
  var show_cart_btn = $(".show-cart-btn");

  show_cart_btn.on("click", function () {
    $('.xoo-wsc-modal').toggleClass('xoo-wsc-active');
  });

  // Remove Close Cart Text

  setTimeout(function () {
    $('.xoo-wsc-remove').html('<span></span>');
  }, 3000);


  $("hidden-cart").on("mouseover", function () {
    $(this).css("display", "block");
  });

  $("hidden-cart").on("mouseout", function () {
    $(this).css("display", "none");
  });


  $(".show-search-btn").hoverIntent({
    over: searchover,
    out: searchout,
    timeout: 500
  });

  function searchover() {
    $('.hidden-search')
      .stop(true, true)
      .fadeIn({duration: 500, queue: false})
      .css('display', 'none')
      .slideDown(500);
  }

  function searchout() {
    $('.hidden-search')
      .stop(true, true)
      .fadeOut({duration: 100, queue: false})
      .slideUp(100);
  }


  $("hidden-search").on("mouseover", function () {
    $(this).css("display", "block");
  });

  $("hidden-search").on("mouseout", function () {
    $(this).css("display", "none");
  });
  $("hidden-search").on("mouseover", function () {
    $(this).css("display", "block");
  });


// -------------------------------------------------------------
//   sly carousel
// -------------------------------------------------------------
  (function () {
    var $frame = jQuery('.wd-sly-carousel');
    var $slidee = $frame.children('ul').eq(0);
    var $wrap = $frame.parent();

    // Call Sly on frame
    $frame.sly({
      horizontal: 1,
      itemNav: 'basic',
      smart: 1,
      activateOn: 'click',
      mouseDragging: 1,
      touchDragging: 1,
      releaseSwing: 1,
      startAt: 3,
      scrollBar: $wrap.find('.scrollbar'),
      scrollBy: 1,
      pagesBar: $wrap.find('.pages'),
      activatePageOn: 'click',
      speed: 300,
      elasticBounds: 1,
      easing: 'easeOutExpo',
      dragHandle: 1,
      dynamicHandle: 1,
      clickBar: 1,

    });

  }());
// Store:  Categories list
  jQuery('.widget_product_categories .cat-parent > a').each(function () {
    var $childIndicator = jQuery('<span class="child-indicator"></span>');

    if (jQuery(this).siblings('.children').is(':visible')) {
      $childIndicator.addClass('open');
    }

    $childIndicator.on("click", function () {
      jQuery(this).parent().siblings('.children').toggle('fast', function () {
        if (jQuery(this).is(':visible')) {
          $childIndicator.addClass('open');
        } else {
          $childIndicator.removeClass('open');
        }
      });
      return false;
    });
    jQuery(this).append($childIndicator);
  });


  var datafile = $('.counter').data('file');
  $('.counter').counterUp({
    delay: 10,
    time: datafile
  });
  //_______________menu ____________________________
  $(".toggle-menu").on("click", function () {
    $("#menu").toggleClass("is-open");
    $(".menu-empty-menu-container").toggleClass("is-open");
  });


  $('.wd-header-6 .wd-header-toggle').on("click", function () {
    $(".wd-header-6").toggleClass("active");
    if ($(".wd-header-6").hasClass("active")) {
      $("#nav-icon2", this).addClass('open');
    } else {
      $("#nav-icon2", this).removeClass('open');
    }

  });


  $('#nav-icon2').on("click", function () {
    $(this).toggleClass('open');
  });


  var toggles = document.querySelectorAll(".c-hamburger");

  for (var i = toggles.length - 1; i >= 0; i--) {
    var toggle = toggles[i];
    toggleHandler(toggle);
  }
  ;

  function toggleHandler(toggle) {
    toggle.addEventListener("click", function (e) {
      e.preventDefault();
      (this.classList.contains("is-active") === true) ? this.classList.remove("is-active") : this.classList.add("is-active");
    });
  }

  //____________isotop ________________
  $(window).load(function () {
    if ($('.ajzaa_isotop').length) {
      $('.ajzaa_isotop').each(function (i, obj) {
        blog_isotop_setting(this);
      });
    }
    function blog_isotop_setting(el) {
      var $container = $(el),
        ajzaa_grid = $container.data('wdgrid');
      // init
      $container.isotope({
        // options
        itemSelector: '.ajzaa_multi_post_isotop_item',
        layoutMode: ajzaa_grid,
        filter: '*'
      });

      $('.filters a').on("click", function () {
        $('.filters .current').removeClass('current');
        $(this).addClass('current');
        var selector = $(this).attr('data-filter');
        $container.isotope({filter: selector});
        return false;
      });
    }
  });


  /*_________________________________ Waypoints ___________________*/
  var waypoints = $('.main').waypoint({
    handler: function (direction) {
      $('.wd-section-blog-services.style-3').addClass('anim-on');
      $('.wd-section-blog-services.style-3 .wd-blog-post').addClass('nohover');
    },
    offset: '45%'
  });

  /*  $('.animated').css('opacity', 0);*/


  //___________ Add animation delay
  var thisParent = $(this).closest('.animation-parent'),
    animationDelay = thisParent.data('animation-delay');

  // find ".animation-parent"
  $('.animation-parent').each(function (index, element) {
    // find each ".animated" in the current ".animation-parent"
    $('.animated', $(this)).each(function (index, element) {
      thisParent = $(this).closest('.animation-parent');
      animationDelay = thisParent.data('animation-delay');
      animationDelay = animationDelay * index;
      $(this).css('transition-delay', animationDelay + 'ms');
    });
  });

  //____________text icon hover ____________
  $('.hover_style1').on("hover", function () {
    var obj = $(this);
    var iconBgColor = $(obj).css('backgroundColor');
    var iconColor = $(obj).css('color');
    $(obj).css('color', iconBgColor);
    $(obj).css('backgroundColor', iconColor);
  });

  //////////////////  Spacer //
  if ($('.ajzaa_empty_space').length) {

    $('.ajzaa_empty_space').each(function (i, obj) {
      ajzaa_empty_space_padding(this);
    });

    window.addEventListener('resize', function () {
      $('.ajzaa_empty_space').each(function (i, obj) {
        ajzaa_empty_space_padding(this);
      });
    }, true);
  }

  function ajzaa_empty_space_padding(el) {
    var $mobile_height = $(el).data("heightmobile"),
      $tablet_height = $(el).data("heighttablet"),
      $desktop_height = $(el).data("heightdesktop");

    if (Modernizr.mq("(max-width: 40em)")) {
      $(el).css("height", $mobile_height);
    } else if (Modernizr.mq("(min-width: 40.063em) and (max-width: 64em)")) {
      $(el).css("height", $tablet_height);
    } else if (Modernizr.mq("(min-width: 64.063em)")) {
      $(el).css("height", $desktop_height);
    }
    $(document).foundation('equalizer', 'reflow');
  }


  // _____________Row Delimiter

  if ($('.row-delimiter').length) {

    setTimeout(function () {
      $('.row-delimiter').each(function (i, obj) {
        ajzaa_row_delimiter_position(this);
      });
    }, 2000);

    window.addEventListener('resize', function () {
      $('.row-delimiter').on(function (i, obj) {
        ajzaa_row_delimiter_position(this);
      });
    }, true);
  }

  function ajzaa_row_delimiter_position(el) {

    var screen_width = $(window).width(),
      parent_left = parseInt($(el).parent().css('left')) * -1;

    if ($(el).hasClass('vertical_line_bottom_left')) {
      $(el).css('transform', 'translateY(100%) translateX(' + parent_left + 'px)');
    } else if ($(el).hasClass('vertical_line_bottom_center')) {
      screen_width = screen_width / 2;
      $(el).css('transform', 'translateY(100%) translateX(' + screen_width + 'px)');
    } else if ($(el).hasClass('vertical_line_bottom_right')) {
      var row_with = 1199;
      if (row_with > screen_width)
        row_with = screen_width - 1;
      $(el).css('transform', 'translateY(100%) translateX(' + row_with + 'px)');
    }

  }  // _____________ Full Width Row

  if ($('.border-bar').length) {

    setTimeout(function () {
      ajzaa_fullWidthRow();
    }, 2000);

    setTimeout(function () {
      ajzaa_fullWidthRow();
    }, 8000);

    window.addEventListener('resize', function () {
      setTimeout(function () {
        ajzaa_fullWidthRow();
      }, 1500);
    }, true);
  }

  function ajzaa_fullWidthRow() {
    if ($('body').hasClass('body-border')) {
      var $elements = $('[data-vc-full-width="true"]');
      $.each($elements, function (key, item) {
        var $el = $(this);
        $el.addClass("vc_hidden");
        var $el_full = $el.next(".vc_row-full-width");
        $el_full.length || ($el_full = $el.parent().next(".vc_row-full-width"));
        var el_margin_left = parseInt($el.css("margin-left"), 10), el_margin_right = parseInt($el.css("margin-right"), 10), offset = 0 - $el_full.offset().left - el_margin_left, width = $(window).width();
        if ($el.css({
            position: "relative",
            left: offset + 40,
            "box-sizing": "border-box",
            width: $(window).width() - 80
          }), !$el.data("vcStretchContent")) {
          var padding = -1 * offset;
          0 > padding && (padding = 0);
          var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
          0 > paddingRight && (paddingRight = 0), $el.css({
            "padding-left": padding + "px",
            "padding-right": paddingRight + "px"
          })
        }
        $el.attr("data-vc-full-width-init", "true"), $el.removeClass("vc_hidden")
      })
    }
  }


  // _______________ Buttons _________________________
  jQuery(".button").hover(
    function () {
      var $this = jQuery(this);
      $this.css("background-color", $this.data('hover-bg'));
      $this.css("color", $this.data('hover-color'));
    },
    function () {
      var $this = jQuery(this);
      $this.css("background-color", $this.data('bg'));
      $this.css("color", $this.data('color'));
    }
  );


//___________ Portfolio Grid Isotope


  window.onload = function () {

    if ($('.wd-portfolio-grid').length) {
      $('.wd-portfolio-grid').each(function (i, obj) {
        portfolio_grid_setting(this);
      });
    }

    function portfolio_grid_setting(el) {
      var $ajzaa_portfolio_grid = $(el).isotope({
        itemSelector: '.wd-portfolio-grid-item',
        layoutMode: 'fitRows'
      })

      $('.filters').on('click', 'a', function (e) {
        e.preventDefault();
        var filterValue = $(this).attr('data-filter');
        $(".filters a").removeClass('current');
        $(this).addClass('current');
        $ajzaa_portfolio_grid.isotope({filter: filterValue});
      });
    }


    if ($('.wd-portfolio-masonry').length) {
      $('.wd-portfolio-masonry').each(function (i, obj) {
        portfolio_masonry_setting(this);
      });
    }

    function portfolio_masonry_setting(el) {

      var $ajzaa_portfolio_masonry = $(el).isotope({
        itemSelector: '.wd-portfolio-masonry-item'
      })

      $('.filters').on('click', 'a', function (e) {
        e.preventDefault();
        var filterValue = $(this).attr('data-filter');
        $(".filters a").removeClass('current');
        $(this).addClass('current');
        $ajzaa_portfolio_masonry.isotope({filter: filterValue});
      });
    }


    if ($('.wd-portfolio-masonry-free-style.style-1').length) {
      $('.wd-portfolio-masonry-free-style.style-1').each(function (i, obj) {
        portfolio_masonry_free_style_1_setting(this);
      });
    }

    function portfolio_masonry_free_style_1_setting(el) {

      var $ajzaa_portfolio_masonry = $(el).isotope({
        itemSelector: '.wd-portfolio-masonry-item'
      })

      $('.filters').on('click', 'a', function (e) {
        e.preventDefault();
        var filterValue = $(this).attr('data-filter');
        $(".filters a").removeClass('current');
        $(this).addClass('current');
        $ajzaa_portfolio_masonry.isotope({filter: filterValue});
      });
    }


    if ($('.wd-portfolio-masonry-free-style.style-2').length) {
      $('.wd-portfolio-masonry-free-style.style-2').isotope('destroy');
      $('.wd-portfolio-masonry-free-style.style-2').each(function (i, obj) {
        portfolio_masonry_free_style_2_setting(this);
      });
    }

    function portfolio_masonry_free_style_2_setting(el) {
      var $container = $(el);
      var $containerProxy = $container.clone().empty().css({visibility: 'hidden'});
      var colWidth;

      $container.after($containerProxy);

      $(window).on("resize", function () {
        colWidth = Math.floor($containerProxy.width() / 4);
        $container.css({
          width: colWidth * 4
        })
        $container.isotope({
          resizable: false,
          itemSelector: '.wd-portfolio-masonry-item',
          masonry: {
            columnWidth: colWidth
          }
        });
      }).resize();


      $(window).on("load", function () {
        $container.isotope('layout');
      });

      var filtertoggle = jQuery('body');

      $(window).on("load", function () {
        $container.isotope('layout');
        $(function () {
          setTimeout(function () {
            $container.isotope('layout');
          }, filtertoggle.hasClass("") ? 755 : 755);
        });
      });


      $(window).on("resize", function () {
        $container.isotope('layout');
        $(function () {
          setTimeout(function () {
            $container.isotope('layout');
          }, filtertoggle.hasClass("") ? 755 : 755);
        });
      });


      $('.filters').on('click', 'a', function (e) {
        e.preventDefault();
        var filterValue = $(this).attr('data-filter');
        $(".filters a").removeClass('current');
        $(this).addClass('current');
        $ajzaa_portfolio_masonry.isotope({filter: filterValue});
      });
    }

  };


  var $hover_color = $(".filters a").data("hovercolor");
  var $overlay_padding = $(".wd-portfolio-masonry").data("padding");
  var $overlay_padding_grid = $(".wd-portfolio-grid").data("padding");

  $('head').append('<style> .filters a:hover , .filters a.current {color: ' + $hover_color + '!important;} </style>');
  $('head').append('<style> .wd-portfolio-container .wd-portfolio-grid .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-grid .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-masonry .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-masonry .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-grid.style-2 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-grid.style-2 .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-masonry.style-2 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-masonry.style-2 .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-grid.style-3 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-grid.style-3 .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-masonry.style-3 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-masonry.style-3 .wd-portfolio-masonry-item {padding: ' + $overlay_padding + 'px !important;} </style>');

  $('head').append('<style> .wd-portfolio-container .wd-portfolio-grid .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-grid .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-masonry .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-masonry .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-grid.style-2 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-grid.style-2 .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-masonry.style-2 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-masonry.style-2 .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-grid.style-3 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-grid.style-3 .wd-portfolio-masonry-item, .wd-portfolio-container .wd-portfolio-masonry.style-3 .wd-portfolio-grid-item, .wd-portfolio-container .wd-portfolio-masonry.style-3 .wd-portfolio-masonry-item {padding: ' + $overlay_padding_grid + 'px !important;} </style>');

  $(".wd-portfolio-container .wd-portfolio-grid .wd-portfolio-grid-item .wd-portfolio-grid-item-image a .overlay-color").css("background-color", $(".wd-portfolio-container .wd-portfolio-grid .wd-portfolio-grid-item .wd-portfolio-grid-item-image a .overlay-color").data('overlaycolor'))
  $(".wd-portfolio-container .wd-portfolio-masonry .wd-portfolio-masonry-item .wd-portfolio-masonry-item-image a .overlay-color").css("background-color", $(".wd-portfolio-container .wd-portfolio-masonry .wd-portfolio-masonry-item .wd-portfolio-masonry-item-image a .overlay-color").data('overlaycolor'))
  $(".wd-portfolio-container .wd-portfolio-grid.style-2 .wd-portfolio-grid-item .overlay-color").css("background-color", $(".wd-portfolio-container .wd-portfolio-grid.style-2 .wd-portfolio-grid-item .overlay-color").data('overlaycolor'));
  $(".wd-portfolio-container .wd-portfolio-masonry.style-2 .wd-portfolio-masonry-item .overlay-color").css("background-color", $(".wd-portfolio-container .wd-portfolio-masonry.style-2 .wd-portfolio-masonry-item .overlay-color").data('overlaycolor'));


  var $testimonial_quote_color = $(".testimonial-text").data('quotecolor');
  var $testimonial_quote_opacity = $(".testimonial-text").data('quoteopacity');
  var $testimonial_quote_size = $(".testimonial-text").data('quotesize');


  $('head').append('<style> .wd-testimonail .testimonial-text:before, .wd-testimonail .testimonial-text:after {color:' + $testimonial_quote_color + ';opacity:.' + $testimonial_quote_opacity + ';font-size:' + $testimonial_quote_size + 'px;}</style>');


  $(window).on("load", function () {
    $(".static-html-item-container").height($(".wd-portfolio-grid-item-image img").height());
  });


  $('#twitter').sharrre({
    share: {
      twitter: true
    },
    enableHover: false,
    enableCounter: false,
    enableTracking: true,
    //buttons: { twitter: {via: '_JulienH'}},
    click: function (api, options) {
      api.simulateClick();
      api.openPopup('twitter');
    }
  });
  $('#facebook').sharrre({
    share: {
      facebook: true
    },
    enableCounter: false,
    enableHover: false,
    enableTracking: false,
    click: function (api, options) {
      api.simulateClick();
      api.openPopup('facebook');
    }
  });

  $('#pinterest').sharrre({
    share: {
      pinterest: true
    },
    enableCounter: false,
    enableHover: false,
    enableTracking: false,
    click: function (api, options) {
      api.simulateClick();
      api.openPopup('pinterest');
    }
  });

// light gallery
  if ($('.lightgallery').length != 0) {
    $('.lightgallery').lightGallery({
      selector: '.item'
    });
  }
  //___________ animate Element when it visible
  function ajzaa_waypoint() {
    if (!isMobile.any()) {
      $('.animated').waypoint(function () {
          // if "this.element" is not an empty array
          var that = $(this.element).length > 0 ? $(this.element) : $(this);
          that.css('opacity', 1);
          that.addClass(that.data('animated'));
        },
        {offset: '98%'});
    }

  }

  ajzaa_waypoint();

  // RTL
  var oldLeft;

  function _rtl() {
    if (jQuery('html').attr('dir') == 'rtl') {
      oldLeft = parseFloat(jQuery('[data-vc-full-width="true"]').css('left'));
      if (oldLeft < 0) {
        jQuery('[data-vc-full-width="true"]').css('left', oldLeft * -1 + "px");
      }
    }
  }

  jQuery(window).load(function () {
    _rtl();
  });

  jQuery(window).resize(function () {
    setTimeout(_rtl, 100);
  });

  $(".product_cat ul").on("click", ".init", function () {
    $(this).closest("ul").children('li:not(.init)').toggle();
  });

  var allOptions = $(".product_cat ul").children('.product_cat ul li:not(.init)');
  $(".product_cat ul").on("click", ".product_cat ul li:not(.init)", function () {
    allOptions.removeClass('selected');
    $(this).addClass('selected');
    $(".product_cat ul").children('.init').html($(this).html());
    allOptions.toggle();
  });


  $('.brands_form #marques').select2();
  $('.brands_form #models').select2();
  $('.brands_form #year').select2();

  $('.brands_form #modal_marques').select2();
  $('.brands_form #modal_models').select2();
  $('.brands_form #modal_year').select2();


  // view wishlist icon
  $('.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a').append('<i class="fa fa-eye" aria-hidden="true"></i>');
  // remove quick view text
  $('.woocommerce ul.products li.product .button.quick_view span').html('');


  // show cart button count
  var productCount = $(".woocommerce-mini-cart li").size();
  if (productCount == 0) {
    $(".show-cart-btn").append("<span class='min-cart-count'></span>");
    $('.min-cart-count').text(productCount);
  } else {
    $('.min-cart-count').text(productCount);
  }
  $('.widget_shopping_cart').bind("DOMSubtreeModified", function () {
    productCount = $(".woocommerce-mini-cart li").size();
    $('.min-cart-count').text(productCount);
  });


  //click btn cookies hide
  $(window).on('load', function () {
    var visitor = ajzaa_getCookie("username");

    if ( visitor == null ) {
      jQuery('.main-cookies').css('display', 'block');
    }else {
      jQuery('.main-cookies').css('display', 'none');
    }

  });

  //click btn cookies hide

  jQuery('.cookies-btn').on('click', function () {
    //Get Current and next Date
    var currentDate = new Date();
    var nowPlus30Days = new Date(Date.now() + (30 * 24 * 60 * 60 * 1000));
    //Create Cookies And MakeExpered after 30 Days
    var visitor = ajzaa_getCookie("username");
    if (visitor == null) {
      visitor = "";
      document.cookie = "username=visitor; expires=" + nowPlus30Days + "; path=/";
      jQuery('.main-cookies').css('display', 'block');
    }
    if (visitor != "") {
      jQuery('.main-cookies').css('display', 'none');
    }
  });


  //Get Cookies Function
  function ajzaa_getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1);
      if (c.indexOf(nameEQ) != -1) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }








});

var $window = jQuery(window);
var scrollTime = 0.4;
var scrollDistance = 300;

mobile_ie = -1 !== navigator.userAgent.indexOf("IEMobile");

function ajzaa_SS_Listener(event) {
  event.preventDefault();

  var delta = event.wheelDelta / 120 || -event.detail / 3;
  var scrollTop = $window.scrollTop();
  var finalScroll = scrollTop - parseInt(delta * scrollDistance);

  TweenLite.to($window, scrollTime, {
    scrollTo: {
      y: finalScroll, autoKill: !0
    },
    ease: Power1.easeOut,
    autoKill: !0,
    overwrite: 5
  });

}

// Fix TopBar Issue
/*window.onscroll = function() {

 var body = document.body; //IE 'quirks'
 var document = document.documentElement; //IE with doctype
 document = (document.clientHeight) ? document : body;

 if (document.scrollTop == 0) {
 alert("top");
 }
 };*/


if (jQuery('body').hasClass('wd-smooth-scroll') && !jQuery('html').hasClass('touch') && !mobile_ie) {
  if (window.addEventListener) {
    window.addEventListener('mousewheel', ajzaa_SS_Listener, false);
    window.addEventListener('DOMMouseScroll', ajzaa_SS_Listener, false);
  }
}

jQuery(".wd-list.style-4 li i").css('backgroundColor', "red");

jQuery('.wd-list.style-4 li i').hover(
  function () {
    jQuery(this).animate({'backgroundColor': data_hover}, 400);
  },
  function () {
    jQuery(this).animate({'backgroundColor': '#FFF'}, 400);
  }
);


if (jQuery('body').height() < 600) {
  jQuery(".wd-menu-nav").removeClass("sticky");
}


