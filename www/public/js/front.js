$(function() {
  var mobileMaxWidth = 600;
  var windowWidth = $(window).width();

  $(window).on("resize", function() {
    windowWidth = $(window).width();
    if (windowWidth > mobileMaxWidth) {
      hide_mobile_menu();
    }
  });

  $("#gototop").click(function(e) {
    e.preventDefault();
    $("html, body").animate({ scrollTop: 0 }, "300");
  });

  $("#show-menu").click(function(e) {
    e.preventDefault();
    show_mobile_menu();
  });
  $("#hide-menu").click(function(e) {
    e.preventDefault();
    hide_mobile_menu();
  });

  //MENU
  $("header nav li").mouseover(function() {
    if (windowWidth > mobileMaxWidth) {
      menu_close();
      $("#menu-mask").css("display", "block");
      $(this).addClass("active");
      $(this)
        .children(".menu-content")
        .css("display", "block");
    }
  });

  $("#menu-mask")
    .click(function() {
      if (windowWidth <= mobileMaxWidth) {
        hide_mobile_menu();
      }
    })
    .mouseover(function() {
      if (windowWidth > mobileMaxWidth) {
        menu_close();
      }
    });

  //MENU FIXED
  $(window)
    .scroll(function() {
      var scroll = $(window).scrollTop();
      if (
        windowWidth > mobileMaxWidth &&
        scroll > $("header .header-top").outerHeight()
      ) {
        if ($("main").css("margin-top") == "0px") {
          //$("main").css('transform', 'translateY(' + $("header").outerHeight()+ 'px)');
          $("main").css("margin-top", $("header").outerHeight() + "px");
        }
        $("header").addClass("fixed");
        $("header .header-top").css("display", "none");
      } else {
        //$("main").css('transform', 'none');
        $("main").css("margin-top", "0");
        $("header").removeClass("fixed");
        $("header .header-top").css("display", "flex");
      }

      if (scroll > 300) {
        $("#gototop").removeClass("hide");
      } else {
        $("#gototop").addClass("hide");
      }
    })
    .scroll();

  // AJAX LIKE

  $(".add_like").click(function() {

    const object = $(this).parent();
    const type_id = object.find('.type_id').val();
    const type = object.find('.type').val();
    const user_id = object.find('.user_id').val();



    $.ajax({
      url: "/add_like",
      type: "post",
      data: "type_id="+type_id+"&type="+type+"&user_id="+user_id,
      success: function(data) {
        console.log(data);
        console.log(
            object.find('.nbr_likes').val()
        );
      },
      error: function() {
        alert("Impossiblie de recuperer");
      }
    });
  });

  // -------------
});

function show_mobile_menu() {
  $("header nav").css("transform", "none");
  $("#menu-mask").css("display", "block");
  $("html").css("overflow", "hidden");
  $(".menu-content").css("display", "block");
}
function hide_mobile_menu() {
  $("header nav").css("transform", "translatex(100%)");
  $("#menu-mask").css("display", "none");
  $("html").css("overflow", "unset");
  $(".menu-content").css("display", "none");
}
function menu_close() {
  $("header nav li").removeClass("active");
  $("#menu-mask").css("display", "none");
  $(".menu-content").css("display", "none");
}
