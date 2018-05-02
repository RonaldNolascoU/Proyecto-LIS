$(document).ready(function () {
    $('.fixed-action-btn').floatingActionButton({direction: 'left'});
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('select').formSelect();
    $('select').on('DOMSubtreeModified', function() {
        $(this).formSelect();
      });
    $(".dropdown-trigger").dropdown();
    $('.tabs').tabs();
});