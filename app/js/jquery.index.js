( function(){

    $(function(){

        $( window ).on( {
            'load': function () {
                $('html, body').animate({scrollTop: 0},1);
                setTimeout( function () {
                    $('.loading').removeClass('active');
                    $('.hero').addClass('is-inview');
                }, 1 )
            }
        } );

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
            _sliderPagination = _slider.find( '.swiper-pagination' ),
            _sliderNext = _slider.find( '.swiper-button-next' ),
            _sliderPrev = _slider.find( '.swiper-button-prev' ),
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

                    if( ( _window.scrollTop() + windowH*0.9 ) > topPos && !curItem.hasClass( 'animation' ) ){

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
                                '-webkit-transform': 'translate( ' + ( - scrollTop * koefX ) + 'px, ' + ( scrollTop * koefY * 1.5 ) + 'px )',
                                'transform': 'translate( ' + ( - scrollTop * koefX ) + 'px, ' + ( scrollTop * koefY * 1.5 ) + 'px )'
                            } );
                            break;
                        case 1:
                            elem.css( {
                                '-webkit-transform': 'translate( ' + ( - scrollTop * koefX * 2 ) + 'px, ' + ( scrollTop * koefY ) + 'px )',
                                'transform': 'translate( ' + ( - scrollTop * koefX * 2 ) + 'px, ' + ( scrollTop * koefY ) + 'px )'
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

} )();