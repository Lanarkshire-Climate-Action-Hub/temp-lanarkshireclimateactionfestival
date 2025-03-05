
//Fix nav menu issue with dropdown
jQuery(function ($) {

    $(".dropdown").hover(function () {
        $(this).addClass("show");
    },
        function () {
            $(this).removeClass("show");
        });
    $('.navbar .dropdown').hover(function () {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

    }, function () {
        $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

    });

    $('.navbar .dropdown > a').click(function () {
        location.href = this.href;
    });

});