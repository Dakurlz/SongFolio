$(function(){

    updateSortable();
    updateMenuJson();


    $('#the-menu').on('click', '.del-menu-btn', function() {
        $(this).parents('li:first').remove();
    });

    $('#add-menu-btn').click(function(){
        var menu_title = $('#menu-title').val();
        var menu_link = $('[id=menu-link]:not(:disabled)').val();

        if(menu_title == '') {
            return;
        }

        $('#the-menu').append('<li><div class="block block-title ui-sortable-handle" link="'+menu_link+'">'+menu_title+'</div><a href="#" class="muted del-menu-btn">Supprimer</a><ul class="sortable list-unstyled ui-sortable"></ul></li>');

        updateMenuJson();
        updateSortable();

        emptyAddMenu();
        closeModals();
    });
});

function updateSortable(){
    $(".sortable").sortable({
        connectWith: ".sortable",
        cursor: "move",
        placeholder: "sortable-placeholder",
        handle: ".block-title",
        cursorAt: { left: 0, top: 0 },
        scroll: false,
        zIndex: 9999
    });
    $(".sortable").on("sortstop", function(event, ui) {
        updateMenuJson();
    });
    $(".sortable").on("sortreceive", function(event, ui) {
        if ($(this).parents("ul").parents("ul").length > 0) {
            alert($(this).parents("ul").parents("ul").length);
            //ui.sender: will cancel the change.
            //Useful in the 'receive' callback.
            $(ui.sender).sortable('cancel');
        }
    });
}

function menu_map($menu) {
    var items = $menu
        .children("li")
        .map(function() {
            var item = {};

            item.title = $(this)
                .children("div")
                .text();
            item.link = $(this)
                .children("div")
                .attr("link");
            if (
                $(this)
                    .children("ul")
                    .children("li").length
            ) {
                item.children = menu_map($(this).children("ul"));
            }

            return item;
        })
        .get();

    return items;
}

function updateMenuJson() {
    var items = menu_map($("#the-menu"));
    $("#result-data").val(JSON.stringify(items));
}

function emptyAddMenu(){
    $('#menu-title').val('');
    $('#menu-add').val('homepage').change();
    $('.menu-custom-link').val('');
    $('.menu-custom-page').prop('selectedIndex',0);
}
function updateAddMenu($name, $cible, $link = ''){
    $('#menu-title').val($name);
    $('#menu-add').val($cible).change();

    switch($cible){
        case 'homepage':
            $('.menu-custom-link').val('');
            $('.menu-custom-page').prop('selectedIndex',0);
            break;
        case 'custom-page':
            $('.menu-custom-page').val($link);
            break;
        case 'custom-link':
            $('.menu-custom-link').val($link);
            break;
    }
}