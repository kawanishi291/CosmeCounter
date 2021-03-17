$('.cal > li').hover(function(){
    childPanel = $(this).children('.calul');
    childPanel.each(function(){
        childPanel.css({height:'0', display:'block', opacity:'0'}).stop().animate({height:'200px', opacity:'1'}, 500, 'swing')
    });
},function(){
    childPanel.css({display: 'none'});
});

$('.cal').hover(function(){
    $(this).addClass('');
}, function(){
    $(this).removeClass('');
});