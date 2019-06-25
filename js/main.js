
$('#basicSlider').multislider({
    continuous: true,
    duration: 2000
});
$('#mixedSlider').multislider({
    duration: 750,
    interval: 3000
});

$('.sf-menu').children().hide();
$('.sf-menu').parent().hover(function(){
    $(this).find("ul").children().stop(true,true)
    .slideDown();
} , function(){
    
    $(this).find("ul").children().stop(true,true)
    .slideUp();

});
