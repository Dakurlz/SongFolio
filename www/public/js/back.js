function showDropdown(element) {
  var elements = ".dropdown-content";
  $(elements).removeClass("show");
  $(element)
    .next(elements)
    .toggleClass("show");
}

$(document).ready(() => {
  $(".toggle-nav ").click(function() {
    $(".sidebar").toggleClass("sidebar--showSidebar");
    $(".toggle-nav").toggleClass("toggle");
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
