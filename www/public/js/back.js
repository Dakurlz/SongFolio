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


  
  $(".admin-users__main__search-add-user__add-user").click(e => {
    alert('test');
    
    var myBookId = $(this).data('id');
    $('.modal-body-add-user').val( myBookId );
  });


  $(function() {
    //----- OPEN
    $('[data-popup-open]').on('click', function(e) {
      var targeted_popup_class = jQuery(this).attr('data-popup-open');
      $('[data-popup="' + targeted_popup_class + '"]').fadeIn(350);
  
      e.preventDefault();
    });
  
    //----- CLOSE
    $('[data-popup-close]').on('click', function(e) {
      var targeted_popup_class = jQuery(this).attr('data-popup-close');
      $('[data-popup="' + targeted_popup_class + '"]').fadeOut(350);
  
      e.preventDefault();
    });
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


