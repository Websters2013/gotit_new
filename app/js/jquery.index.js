( function(){

    $(function(){

        $( window ).on( {
            'load': function () {
                $('html, body').animate({scrollTop: 0},1);
                setTimeout( function () {
                    $('.loading').removeClass('active');
                    $('.hero').addClass('is-inview');
                    $('.about-us').addClass('is-inview');
                }, 1 )
            }
        } );

        var $window = $(window);
        var scrollTime = 1.2;
        var scrollDistance = 170;

        $window.on("mousewheel DOMMouseScroll", function(event){

            event.preventDefault();

            var delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3;
            var scrollTop = $window.scrollTop();
            var finalScroll = scrollTop - parseInt(delta*scrollDistance);

            TweenMax.to($window, scrollTime, {
                scrollTo : { y: finalScroll, autoKill:true },
                ease: Power1.easeOut,
                overwrite: 5
            });

        });

        $('.hero').each( function() {
            new Hero( $(this) );
        } );

        $('.services').each( function() {
            new Services( $(this) );
        } );

        $('.show').each( function() {
            new Show( $(this) );
        } );

        $('.site').each( function() {
            new Site( $(this) );
        } );

        $('.search').each( function() {
            new Search( $(this) );
        } );

    });

    var Hero = function (obj) {

        //private properties
        var _self = this,
            _obj = obj,
            _title = _obj.find( '.hero__title' );

        //private methods
        var _constructor = function () {
                _onEvents();
                _obj[0].obj = _self;
                _createElems();
            },
            _createElems = function () {
                _title.each( function () {
                    var elem = $(this),
                        elemText = elem.data( 'text' );
                    
                    for ( var i = 0; i < elemText.length; i++ ) {
                        var elemChar = elemText.substr(i, 1);

                        if ( elemChar.charCodeAt(0) == 32 ) {
                            elem.append( '<span>&nbsp;</span>' );
                        } else {
                            elem.append( '<span>' + elemText.substr(i, 1) + '</span>' );
                        }
                    }
                } );
            },
            _onEvents = function () {

            };

        //public properties

        //public methods

        _constructor();
    };

    var Services = function (obj) {

        //private properties
        var _self = this,
            _obj = obj,
            _slider = _obj.find( '.swiper-container' ),
            _sliderPagination = _obj.find( '.swiper-pagination' ),
            _sliderNext = _obj.find( '.swiper-button-next' ),
            _sliderPrev = _obj.find( '.swiper-button-prev' ),
            _swiper;

        //private methods
        var _constructor = function () {
                _onEvents();
                _obj[0].obj = _self;
                _initSlider();
            },
            _initSlider = function () {
                _swiper = new Swiper( _slider, {
                    pagination: _sliderPagination,
                    paginationClickable: true,
                    nextButton: _sliderNext,
                    prevButton: _sliderPrev,
                    spaceBetween: 30
                });
            },
            _onEvents = function () {

            };

        //public properties

        //public methods

        _constructor();
    };

    var Show = function ( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _window = $( window );

        //private methods
        var _onEvents = function () {
                _window.on({
                    scroll: function () {

                        _checkScroll();

                    }
                });
            },
            _checkScroll = function(){

                var windowH = _window.height();

                _obj.each(function () {

                    var curItem = $(this),
                        topPos = _obj.offset().top;

                    if( ( _window.scrollTop() + windowH*0.7 ) > topPos && !curItem.hasClass( 'animation' ) ){
                        console.log(100);
                        curItem.addClass( 'animation' );
                    }
                })
            },
            _init = function () {
                _obj[0].slides = _self;
                _onEvents();
                _checkScroll();
            };

        //public properties

        //public methods

        _init();
    };

    var Site = function(obj) {

        //private properties
        var _obj = obj,
            _window = $( window ),
            _footer = $( '.site__footer' ),
            _footerLogoTop = _footer.find( '.site__footer-logo' );

        //private methods
        var _addEvents = function() {

                _window.on({
                    'scroll': function() {
                        var scrollTop = $(window).scrollTop();

                        _move( scrollTop );

                        if ( ( _footerLogoTop.offset().top - scrollTop ) < $(window).height() * 1.1 ) {
                            _footer.addClass( 'is-inview' );
                        } else {
                            _footer.removeClass( 'is-inview' );
                        }
                    }
                });
            },
            _move = function( scrollTop ){

                $('.hero__title').each( function (i) {
                    var elem = $(this),
                        koefX = .8,
                        koefY = .8;

                    switch ( i ) {
                        case 0:
                            elem.css( {
                                '-webkit-transform': 'translate( ' + ( - scrollTop * koefX ) + 'px, 0px )',
                                'transform': 'translate( ' + ( - scrollTop * koefX ) + 'px, 0px )'
                            } );
                            break;
                        case 1:
                            elem.css( {
                                '-webkit-transform': 'translate( ' + ( - scrollTop * koefX * 2 ) + 'px, 0px )',
                                'transform': 'translate( ' + ( - scrollTop * koefX * 2 ) + 'px, 0px )'
                            } );
                            break;
                        default:
                            break;
                    }
                } );
                $( '.hero__ban' ).css( {
                    '-webkit-transform': 'translate( 0px, ' + ( scrollTop * .1) + 'px )',
                    'transform': 'translate( 0px, ' + ( scrollTop * .1) + 'px )'
                } );

                $('.about-us__column').each( function (i) {
                    var elem = $(this),
                        offsetElem = elem.offset().top,
                        koefY = .05;

                    switch ( i ) {
                        case 0:
                            elem.css( {
                                '-webkit-transform': 'translate( 0px, ' + ( - ( scrollTop - offsetElem ) * koefY ) + 'px )',
                                'transform': 'translate( 0px, ' + ( - ( scrollTop - offsetElem ) * koefY ) + 'px )'
                            } );
                            break;
                        case 1:
                            elem.css( {
                                '-webkit-transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )',
                                'transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )'
                            } );
                            break;
                        default:
                            break;
                    }
                } );
                $('.about-us .btn_plus').css( {
                    '-webkit-transform': 'translate( 0px, ' + ( scrollTop * .05 ) + 'px )',
                    'transform': 'translate( 0px, ' + ( scrollTop * .05 ) + 'px )'
                } );

                $('.about-us__image').css( {
                    '-webkit-transform': 'translate( 0px, ' + ( scrollTop * 0.1 ) + 'px )',
                    'transform': 'translate( 0px, ' + ( scrollTop * 0.1 ) + 'px )'
                } );

                $('.badge').each( function () {
                    var elem = $(this),
                        offsetElem = elem.offset().top,
                        koefY = .5;

                    elem.css( {
                        '-webkit-transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )',
                        'transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )'
                    } );
                } );

                $('.case-preview__item').each( function (i) {
                    var elem = $(this),
                        offsetElem = elem.offset().top,
                        koefY = .05;

                    if ( i == 1 ) {
                        elem.css( {
                            '-webkit-transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )',
                            'transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )'
                        } );
                    } else {
                        elem.css( {
                            '-webkit-transform': 'translate( 0px, ' + ( - ( scrollTop - offsetElem ) * koefY ) + 'px )',
                            'transform': 'translate( 0px, ' + ( - ( scrollTop - offsetElem ) * koefY ) + 'px )'
                        } );
                    }

                } );
            },
            _init = function() {
                _addEvents();
            };

        //public properties

        //public methods

        _init();
    };

    var Search = function( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _header = $( '.site__header' ),
            _scroller = $( 'body, html' ),
            _showBtn = $( '.search-btn' );

        //private methods
        var _constructor = function() {
                _obj[ 0 ].obj = _self;
                _onEvents();
            },
            _onEvents = function() {

                _showBtn.on( {
                    click: function() {

                        _openSeach( $( this ) );
                    }
                } );
            },
            _openSeach = function( elem )  {

                var curItem = elem;

                if( curItem.hasClass( 'opened' ) ) {

                    curItem.removeClass( 'opened' );
                    _obj.removeClass( 'opened' );
                    _showBtn.removeClass( 'opened' );
                    // $('.hero').addClass('is-inview');

                    _scroller.css( {
                        'overflow': 'visible'
                    } );

                    _header.css({
                        'z-index': 2
                    });

                } else {

                    curItem.addClass( 'opened' );
                    _obj.addClass( 'opened' );
                    _showBtn.addClass( 'opened' );
                    $( '.site__menu, .site__menu-btn' ).removeClass( 'opened' );
                    // $('.hero').removeClass('is-inview');

                    _scroller.css( {
                        'overflow': 'hidden'
                    } );

                    _header.css({
                        'z-index': 15
                    });
                }
            };

        _constructor();
    };

} )();
