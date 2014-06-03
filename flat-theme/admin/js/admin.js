jQuery(function($){

    var tb_opener = null;
$('a.meta-icon-selector').on('click', function(){
    tb_opener = this;
    var href = $(this).attr('href');
    tb_show('Icons', href);
    return false;

});

$('a.meta-icon-remove').on('click', function(){
    $(this).closest('ul.meta_box_items').find('.display-icon > i').removeClass();
    $(this).closest('ul.meta_box_items').find('.hidden-textbox').val('');
    $(this).hide();
    return false;
});



$('.meta-icon-meta-box i').on('click', function(){

var iconname = $(this).prev().val();
 $(tb_opener).closest('ul.meta_box_items').find('.display-icon > i').removeClass().addClass(iconname);
 $(tb_opener).closest('ul.meta_box_items').find('.hidden-textbox').val(iconname);
 $(tb_opener).next().show();
 tb_remove();
 tb_opener = null;

});

});