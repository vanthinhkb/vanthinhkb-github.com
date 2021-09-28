jQuery(document).ready(function($) {
    // When user clicks button, open Modal
    $('.menu-open').click(function(){
        $(this).next().addClass('active');

        var h_wd = $(window).height();
        $('.megamenu-mobile .menu-content .modal-body').height(h_wd);
    });

    // When user clicks Close (x), close Modal
    $('.menu-close .close').click(function(){
        $(this).parent().parent().parent().removeClass('active');
    });
});