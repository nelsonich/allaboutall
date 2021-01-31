$(function () {
    $('div.carousel').slick({
        dots: true,
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
