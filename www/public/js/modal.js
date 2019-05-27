$(function(){

    $('button[modal]').click(function(){
        $modal = $(this).attr('modal');
        openModal($modal);
    });

    /*span.onclick = function() {
        closeModals();
    }*/

    $('.modal-content .close').click(function(){
      closeModals();
    });

    $(window).click(function(event) {
        if ($(event.target).hasClass('modal') ) {
            closeModals();
        }
    });
});

function openModal($id){
  $('#'+$id).css('display', 'block');
}
function closeModals(){
  $('.modal').css('display', 'none');
}