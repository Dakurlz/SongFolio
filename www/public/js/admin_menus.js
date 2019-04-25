$(function(){
    $('#add-menu-btn').click(function(){
        var menu_title = $('#menu-title').val();
        var menu_link = $('[id=menu-link]:not(:disabled)').val();

        console.log(menu_link);

        $('#the-menu').append('<li><div class="block block-title ui-sortable-handle" link="'+menu_link+'">'+menu_title+'</div><ul class="sortable list-unstyled ui-sortable"></ul></li>');

        closeModals();
    });
});