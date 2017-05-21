(window).scroll(function(){console.log($(window).scrollTop());
    if($(window).scrollTop() > 800 && $(window).scrollTop() < 850)
    {
        alert('mission accomplished');
    }
});