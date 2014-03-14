(function($)
{
    var nav_open = false
        , inner = $('#inner-wrap')
        , winHeight = $(window).height();

    $('#nav-open-btn').on('click', function()
    {
        if (!nav_open) {
            inner.animate({ left: '50%' }, 800, 'easeOutQuart');
            inner.css({'height': winHeight})
            nav_open = true;
            return false;
        }
    });

    $('#nav-close-btn, #main, #header').on('click', function()
    {
        if (nav_open) {
            inner.animate({ left: '0' }, 700, 'easeInQuart');
            nav_open = false;
            return false;
        }
    });

    window.onresize = function(){
        toggleNav();
    }
    function toggleNav(){
        var contentWidth = inner.width();
        if (contentWidth > 715) {
            if (nav_open){
               inner.animate({ left: '0' }, 700, 'easeInQuart');
               nav_open = false;
               return false; 
            }
        }
    };

    toggleNav();

    $(document.documentElement).addClass('js-ready');

    /*-----------------------------------------------------------------------------------*/
    /*  Thumbnail grid Hover Effect
    /*-----------------------------------------------------------------------------------*/
    $(".project-grid figure").hover(
        function () {
            var container_width= $(this).width(),
                container_height= $(this).height();
            $(this).find('.media-container').stop().animate({ 
                opacity:0.5 
            }, 500, 'easeOutCubic');

            $(this).find('a').stop(true, true).animate({
                opacity: 1,
                top: "50%"
            }, 500, 'easeOutCubic');
        },
        function () {
            $(this).find('.media-container').animate({ opacity:0 }, 500, 'easeOutCubic');
            $(this).find('a').animate({ opacity:0, top:"45%" }, 500, 'easeOutCubic');
        }
    );

 }(jQuery));
