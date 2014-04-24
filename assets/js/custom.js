(function($)
{
    var opened = false;
    /*--------------------------------------------------------------------------------------*/
    /*  Smooth dropdown Nav
    /*--------------------------------------------------------------------------------------*/
    function dropdownNav() {
        var wrapper = $('#wrapper').width();
        if ( wrapper > 767 ) {
            $('.nav-child-container').hide();
            $("ul.primary-nav li").each(function(){   
                var $submeun = $(this).find('ul:first');
                $(this).hover(function(){   
                    $submeun.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:0}).slideDown(250, function(){
                                                                                    $(this).css({overflow:"visible", height:"auto"});
                                                                                }); 
                    },
                function(){   
                    $submeun.stop().slideUp(250, function(){   
                        $(this).css({overflow:"hidden", display:"none"});
                        });
                });
            });
        } else{
            $("ul.primary-nav li").off( "mouseenter mouseleave" );
            $('.nav-child-container').show();
        }
    }
    
    /*--------------------------------------------------------------------------------------*/
    /*  Set auto height of page container - trick to hide responsive nav
    /*--------------------------------------------------------------------------------------*/
    function autoPageContainerHeight() {
        var wrapper_height = $(window).height(),
        iScrollHeight = $('#content').prop('scrollHeight'),
        iHeader = $('#header').height(),
        iFooter = $('#footer').height();
        if(!window.location.hash) {
            if( iScrollHeight < wrapper_height ){
                $('#wrapper, #content').css({"min-height" : wrapper_height - iHeader - iFooter});
            }
        }

    }

    /*--------------------------------------------------------------------------------------*/
    /*  Init
    /*--------------------------------------------------------------------------------------*/
    
    window.onresize = function() { 
       dropdownNav();
       autoPageContainerHeight();
    }

    autoPageContainerHeight();
    dropdownNav();

    /* Hover Effects */
    $('.nav-child-container').bind('mouseover', function(event) {
        $(this).toggleClass('hover');
    });

    /* Sidebar multi-level menu */
    
    $('.nav-child-container').bind('click', function(event) {
        event.preventDefault();
        var $this = $(this);
        var ul = $this.next('ul');
        var ulChildrenHeight = ul.children().length * 42;

        if(!$this.hasClass('active')){
            $this.toggleClass('active');
            ul.toggleClass('active');
            ul.height(ulChildrenHeight + 'px');
        }else{
            $this.toggleClass('active');
            ul.toggleClass('active');
            ul.height(0);
        }
    });

    /* Sidebar Functionality */
    $('#menu-trigger').bind('click', function(event) {
        $('#content, #header, #home-slider, #search-wrap').toggleClass('active');
        $('#sidemenu').toggleClass('active');
        if(opened){
            opened = false;
            setTimeout(function() {
                $('#sidemenu-container').removeClass('active');
            }, 450);
        } else {
            $('#sidemenu-container').addClass('active');
            opened = true;
        }
    });

    $('ul.primary-nav a').bind('click', function(event) {
        event.preventDefault();
        
        var path = $(this).attr('href');
        $('#content, #header').toggleClass('active');
        $('#sidemenu').toggleClass('active');
        setTimeout(function() {
            window.location = path;
        }, 500);
    });

    /* Check if the child menu has an active item.
    If yes, then it will expand the menu by default. */
    
    var $navItems = $('ul.primary-nav ul li');

    $navItems.each(function(index){
        if ($(this).hasClass('current-menu-item')) {
            $parentUl = $(this).parent();
            $parentUl.height($parentUl.children('li').length * 42 + "px");
            $parentUl.prev().addClass('active');
            $parentUl.addClass('active');
            $anchor = $parentUl.prev();
            $anchor.children('.nav-child-container').addClass('active');
        }
    });

    /* Date picker search field */
    $( "#start_date, #arrive_date" ).datepicker({
        numberOfMonths: 2,
        showButtonPanel: true
    });
    
    /* Magnific popup */
    $('.tour-photos').magnificPopup({
        delegate: 'a', // child items selector, by clicking on it popup will open
        type: 'image',
        gallery:{
            enabled:true
        },
        image:{
            cursor: null,
            tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            titleSrc: function(item) {
              return item.el.attr('title') + '<small>by Eurasie Travel</small>';
            }
        }
    });

    /* Booking form */
    $('.open-booking-form').magnificPopup({
        type:'inline',
        midClick: true
    });

    $('.send-tour-booking').validate({
        rules: {
            full_name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            confirm_email: {
                required: true,
                equalTo: "#email"
            },
            phone_number: "required",
            address: "required",
            town: "required",
            country: "required",
            arrive_date: "required"
        },
        submitHandler: function (form) {
            var data = {
                action:"sp_send_booking_tour",
                tours : $(this).serialize()
            };
            $.post( custom_obj.ajaxURL, data, function(data) {
                $('.send-tour-booking').hide();
                $('#result').html(data);
            });
            return false;
        }
    });


}(jQuery));