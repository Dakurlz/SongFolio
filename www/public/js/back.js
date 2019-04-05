$(function(){
    $('.sortable').sortable({
        connectWith:    '.sortable',
        cursor:         'move',
        placeholder:    'sortable-placeholder',
        handle:         '.block-title',
        cursorAt:       { left: 0, top: 0 },
        scroll:         false,
        zIndex:         9999
    });
});
$( ".sortable" ).on( "sortstop", function( event, ui ) { updateMenuJson(); } );


function menu_map($menu){
    var items = $menu.children('li').map(function() {
        var item = { };

        item.title = $(this).children('div').text();
        item.link = $(this).children('div').attr('link');
        if($(this).children('ul').children('li').length){
            item.children = menu_map($(this).children('ul'));
        }

        return item;
    }).get();

    return items;
}

function updateMenuJson(){
    var items = menu_map($('#the-menu'));
    $('#result-data').val(JSON.stringify(items));
}

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


