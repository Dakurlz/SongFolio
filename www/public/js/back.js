$(function() {
  /* CUSTOM SMART TOGGLES */

  //smart toggles for checkbox
  $("input[toggle]")
    .change(function() {
      if ($(this).is(":checked")) {
        $("#" + $(this).attr("toggle"))
          .show()
          .find("input,select,textarea")
          .prop("disabled", false);
      } else {
        $("#" + $(this).attr("toggle"))
          .hide()
          .find("input,select,textarea")
          .prop("disabled", true);
      }
    })
    .change();

  //smart toggle for clickable elements
  $("[toggle-click]").click(function() {
    $("#" + $(this).attr("toggle-click")).slideToggle();
  });

  //smart toggles for form selects
  $(".smart-toggle[id]")
    .change(function() {
      tmpId = $(this).attr("id");
      tmpVal = $(this).val();

      $(".smart-" + tmpId + ":not(." + tmpId + "-" + tmpVal + ")")
        .hide()
        .find("input,select,textarea")
        .prop("disabled", true);
      $(".smart-" + tmpId + "." + tmpId + "-" + tmpVal)
        .show()
        .find("input,select,textarea")
        .prop("disabled", false);
    })
    .change();
});

function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $("#befor_upload").attr("src", e.target.result);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function showDropdown(element) {
  var elements = ".dropdown-content";
  $(element)
    .next(elements)
    .toggleClass("show");
}

(function(document, window, index) {
  var inputs = document.querySelectorAll(".inputfile");
  Array.prototype.forEach.call(inputs, function(input) {
    var label = input.nextElementSibling,
      labelVal = label.innerHTML;

    input.addEventListener("change", function(e) {
      var fileName = "";
      if (this.files && this.files.length > 1)
        fileName = (this.getAttribute("data-multiple-caption") || "").replace(
          "{count}",
          this.files.length
        );
      else fileName = e.target.value.split("\\").pop();

      if (fileName) label.querySelector("span").innerHTML = fileName;
      else label.innerHTML = labelVal;
    });

    // Firefox bug fix
    input.addEventListener("focus", function() {
      input.classList.add("has-focus");
    });
    input.addEventListener("blur", function() {
      input.classList.remove("has-focus");
    });
  });
})(document, window, 0);

function hideArrow() {
  //if ($('.slide-dropdown-content').children().val() === '' ){
  //    console.log( $('.slide-dropdown-content').parent().children('div.sidebar--item').children('span.pages-options').remove());
  // }
}

$(document).ready(() => {
  
  // GET TEXT IN TITLE AND PAST IN SLUG WITH CORRECTS
  $(".target-elment-to-slug").on("input", function() {
    $(".title-value-slug").val($(this).val().replace(/\s/g,"-").trim());
  });

  // hideArrow();

  $(".input-search").keyup(function() {
    const value = $(this)
      .val()
      .toLowerCase();
    $(".tbody tr").filter(function() {
      $(this).toggle(
        $(this)
          .text()
          .toLowerCase()
          .indexOf(value) > -1
      );
    });
  });

  $(".slide-dropbtn").click(function() {
    const jqElm = $(this)
      .parent()
      .parent()
      .children(".slide-dropdown-content");
    if (jqElm.is(":hidden")) {
      jqElm.slideDown("slow");
      $(this).addClass("slide-dropbtn-close");
    } else {
      jqElm.hide("slow");
      $(this).removeClass("slide-dropbtn-close");
    }
  });

  $(".toggle-nav ").click(function() {
    $(".sidebar").toggleClass("sidebar--showSidebar");
    $(".toggle-nav").toggleClass("toggle");
  });

  $(".admin-users__main__search-add-user__add-user").click((e) => {
    var myBookId = $(this).data("id");
    $(".modal-body-add-user").val(myBookId);
  });

  $(window).click(function(e) {
    if (!event.target.matches(".dropbtn")) {
      var dropdowns = $(".dropdown-content");
      var i;
      for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains("show")) {
          openDropdown.classList.remove("show");
        }
      }
    }
  });
});
