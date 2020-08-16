jQuery(function ($) {
  "use strict";
  var createCookie = function(name, value, days) {
    var expires;
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      expires = "; expires=" + date.toGMTString();
    }
    else {
      expires = "";
    }
    document.cookie = name + "=" + value + expires + "; path=/";
  }

  function getCookie(c_name) {
    if (document.cookie.length > 0) {
      var c_start = document.cookie.indexOf(c_name + "=");
      if (c_start != -1) {
        c_start = c_start + c_name.length + 1;
        var c_end = document.cookie.indexOf(";", c_start);
        if (c_end == -1) {
          c_end = document.cookie.length;
        }
        return unescape(document.cookie.substring(c_start, c_end));
      }
    }
    return "";
  }

  function deletecookie(name) {
    createCookie(name, '', ';expires=Thu, 01-Jan-1970 00:00:01 GMT');
  }

  var empty_garage = '<li class="empty_garage"><a href="#" data-reveal-id="model_Modal"><button class="btn_add_model">Add a Vehicle</button></a></li>' +
    '<li class="empty_garage_text"><i class="fa fa-bus" aria-hidden="true"></i><span>Store vehicles in your garage</span></li>' +
    '<li class="empty_garage_text"><i class="fa fa-podcast" aria-hidden="true"></i><span>Get product recommendations</span></li>' +
    '<li class="empty_garage_text"><i class="fa fa-cogs" aria-hidden="true"></i><span>Easily find parts & accessories</span></li>';

  var btn_remove = '<li class="garage-last-item"><span class="garage-add-model" data-reveal-id="model_Modal" ><span class="add-model">+</span>Add a Vehicle</span><span class="garage-remove-list"><span class="remove">x</span>Clear History</span></li>';


  var garage_str = getCookie('garage');
  if(garage_str !== "") {
    var garage_list_array = JSON.parse(garage_str);
    jQuery.each(garage_list_array, function (i, val) {
      if (val !== '') {
        $('.garage .garage-list').append('<li><h4>' + val[0] + '</h4><a href="' + val[1] + '"><button class="garage-btn">Browse</button></a></li>');
      }
    });
    $('.garage .garage-list').append(btn_remove);
  } else {
    $('.garage .garage-list').html(empty_garage);
  }





  $('.garage-remove-list').on("click", function () {
    deletecookie('garage');
    $('.garage .garage-list').html(empty_garage);
  });


  //Search
  var addr;
  var garage_name;
  $('.brands_form .search input').on("click", function () {

    var $form_parent = $(this).closest('form'),
        $keyword_select = $('.keyword select', $form_parent),
        $brands_select = $('.brands select', $form_parent),
        $year_select = $('.year select', $form_parent);

    if ($brands_select.val() == null) {
      alert('Brands cannot be empty.');
    }
    else if (
      $keyword_select.val() == null && $year_select.val() == null) {
      addr = urltheme.template_url + 'models/' + $brands_select.val();
      garage_name = $brands_select.val();
    }
    else if (
      $keyword_select.val() !== null && $year_select.val() == null) {
      addr = urltheme.template_url + 'models/' + $keyword_select.val();
      garage_name = $brands_select.val() + ' ' + $keyword_select.val();
    } else if
    (
      $keyword_select.val() == null && $year_select.val() !== null) {
      addr = urltheme.template_url + 'models/' + $year_select.val();
      garage_name = $brands_select.val() + ' ' + $year_select.val();
    } else {
      addr = urltheme.template_url + 'models/' + $year_select.val();
      garage_name = $brands_select.val() + ' ' + $keyword_select.val() + ' ' + $year_select.val();
    }

    if (addr !== undefined) {
      $.ajax({
        type: 'HEAD',
        url: addr,
        success: function () {
          var json_str = getCookie('garage');
          if(json_str !==  "") {
            var garage_list = JSON.parse(json_str);
          } else {
            var garage_list = Array();
          }
          garage_list.push([garage_name, addr]);

          var json_str = JSON.stringify(garage_list);
          createCookie('garage', json_str);

          location.href = addr;
        },
        error: function () {
          alert(errorThrown);
        }
      });
    }
  });
});
