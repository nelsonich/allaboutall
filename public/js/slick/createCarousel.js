$(function() {
    $('div.carousel').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        centerMode: true,
        variableWidth: true,
        adaptiveHeight: true,
        arrows: false,
        autoplay: true,
        autoplaySpeed: 3000,
        pauseOnDotsHover: true,
    });
});

$(function() {
    $('ul.carousel').slick({
        dots: false,
        infinite: false,
        // speed: 300,
        slidesToShow: 4,
        centerMode: true,
        variableWidth: true,
        adaptiveHeight: true,
        arrows: true,
        // autoplay: true,
        // autoplaySpeed: 3000,
        pauseOnDotsHover: true,
    });
});