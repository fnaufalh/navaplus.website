$(document).ready(function () {
    fitAll();
});

window.onresize = function (event) {
    fitAll();
};

$(document).on('click', '.hamburger', function () {
    var isActive = $(this).attr('is_active');
    if (isActive === 'true') {
        $(this).attr('is_active', 'false');
        $('li').attr('is_active', 'false');
        $('li ul').removeClass('active');
        $('.carousel-indicators').css('display', 'flex');
        $('.menu-holder').slideUp();
        if (parseInt($(window).width()) <= 768) {
            $("html,body").css({
                overflow: 'inherit'
            });
        }
    } else {
      $('.carousel-indicators').css('display', 'none');
        $(this).attr('is_active', 'true');
        $('.menu-holder').slideDown().width('50%');
        if (parseInt($(window).width()) <= 768) {
            $("html,body").css({
                overflow: 'hidden'
            });
        }
    }
});

$(document).on('click', '.open-agencies', function () {
    var isActive = $(this).parent().eq(0).attr('is_active');
    if (isActive === 'true') {
        $(this).parent().eq(0).attr('is_active', 'false');
        $(this).parent().eq(0).children('ul').removeClass('active');
    } else {
        $(this).parent().eq(0).attr('is_active', 'true');
        $(this).parent().eq(0).children('ul').addClass('active');
    }
});

$(document).on('click', '[scroll-to]', function (event) {
    event.preventDefault();
    var elm = $(this).attr('scroll-to');
    $('html, body').animate({
        scrollTop: $(elm).offset().top
    }, 800, function () {
        window.location.hash = elm;
    });
});


function fitAll() {
    if (parseInt($(window).width()) > 768) {
        $(".menu-holder").width($("#sites-section > .max-width").width() - $("#sites-section .right-section").width());
        $(".menu-holder").height($("#sites-section > .max-width").height() + $("#whats-going-on > .section-header").height());
    }
    if (parseInt($(window).width()) > 1366) {
        $("html").addClass("zoomed");
    }
}

$(document).on('mouseover', '.section-content-item', function () {
    var color = $("#lets-connect").css('background-color');
    $(this).find(".info > div").css('color', color);
    $(this).find(".image-project").css('left', '-12px');
    $(this).find(".info").css({'bottom': '-35px', 'left': '0px'});
});

$(document).on('mouseleave', '.section-content-item', function () {
    $(this).find(".info > div").css('color', "black");
    var image = $(this).find(".image-project").css('left', '14px');
    $(this).find(".info").css({'bottom': '-50px', 'left': '-22px'});
});

$(document).ready(function(){
  $('#whats-going-on .section-content .section-content-item').slice(1, 2).show();
  $('.more').on('click', function(e){
    e.preventDefault();
    $('#whats-going-on .section-content .section-content-item:hidden').slice(0,2).slideDown();
    if ($("#whats-going-on .section-content .section-content-item:hidden").length == 0) {
            $(".more").fadeOut('slow');
        }
        $('html,body').animate({
            scrollTop: $(this).offset().top
        }, 1500);
  })
})
