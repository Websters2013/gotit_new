( function(){

    $(function(){

        $( window ).on( {
            'load': function () {

                $('html, body').animate({scrollTop: 0},1);
                $('.loading').removeClass('active');
                $('.hero').addClass('is-inview');
                $('.about-us_detail').addClass('is-inview');

            }
        } );

        $('.site__intro').each( function() {
            new Intro( $(this) );
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

        $('.search').each( function() {
            new Search( $(this) );
        } );

        $('.get-in-touch').each( function() {
            new GetInTouch( $(this) );
        } );

        $('.anchor').each( function() {
            new Anchor( $(this) );
        } );

    });

    var Anchor = function ( obj ) {
        var _obj = obj,
            _header = $( '.site__header'),
            _window = $( 'html, body' );

        var _onEvents = function() {

                _obj.on( {
                    click: function() {

                        _header.addClass( 'site__header_minimize' );

                        _window.animate( {
                            scrollTop: $( $.attr(this, 'href') ).offset().top - 140
                        }, 600);

                        return false;
                    }
                } );

            },
            _construct = function() {
                _onEvents();
            };

        _construct()
    };

    var Intro = function ( obj ) {
        var _obj = obj,
            _words = _obj.find( '.typistText' ),
            _texts = JSON.parse( _words.attr( 'data-texts' ) ),
            _letterInterval = _words.attr( 'data-letterInterval' ),
            _textInterval = _words.attr( 'data-textInterval' ),
            _startTime = -1,
            _textCounter = 0,
            _symbolCounter = 0,
            _canShowSymbol = true;

        var _onEvents = function() {

            },
            _typeText = function ( time ) {

                var progress;

                if (_startTime < 0) {
                    _startTime = time;
                }

                progress = ( time - _startTime ) / _letterInterval;

                if (progress > 1) {
                    progress = 1;
                    _startTime = time;

                    if (_canShowSymbol) {
                        _showLetter();
                    } else {

                        setTimeout( function () {
                            _hideIntro();
                        }, 2500  )

                    }
                } else {
                    requestAnimationFrame( _typeText );
                }

            },
            _showLetter = function () {

                var tmp = _texts[_textCounter];

                _obj.text(_obj.text() + tmp.substr(_symbolCounter, 1));

                if (_symbolCounter < tmp.length) {

                    _symbolCounter++;
                    requestAnimationFrame( _typeText );

                } else {

                    setTimeout(function () {
                        _canShowSymbol = false;
                        _symbolCounter = 0;
                        if (_textCounter < ( _texts.length - 1 )) {
                            _textCounter++;
                        } else {
                            _textCounter = 0;
                        }
                        requestAnimationFrame( _typeText );
                    }, 1000);

                }

            },
            _hideIntro = function () {

                _obj.addClass( 'hide' );

                setTimeout( function () {
                    _obj.remove();
                }, 500 );

            },
            _construct = function() {
                _obj.addClass( 'initialized' );
                _typeText( 0 );
                _onEvents();
            };

        _construct();
    };

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

                    if( ( _window.scrollTop() + windowH*0.8 ) > topPos && !curItem.hasClass( 'animation' ) ){
                        if ( curItem.hasClass( 'show_is' ) ) {
                            curItem.addClass( 'is-inview' );
                        } else {
                            curItem.addClass( 'animation' );
                        }
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
        var _self = this,
            _obj = obj,
            _window = $( window ),
            _footer = $( '.site__footer' ),
            _footerLogoTop = _footer.find( '.site__footer-logo' ),
            _canUseSmoothScroll = true;

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

                _window.on({
                    'mousewheel': function( event ) {
                        if ( _canUseSmoothScroll ) {
                            event.preventDefault();

                            _siteScroll( event );
                        }
                    },
                    'DOMMouseScroll': function( event ) {
                        if ( _canUseSmoothScroll ) {
                            event.preventDefault();

                            _siteScroll( event );
                        }
                    }
                });

            },
            _move = function( scrollTop ){

                $('.hero__title').each( function (i) {
                    var elem = $(this),
                        koefX = .8;

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

                $('.contact-us__logo').each( function () {

                    var elem = $(this),
                        offsetElem = elem.offset().top,
                        koefY = .15;

                    elem.css( {
                        '-webkit-transform': 'translate( ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px, 0px )',
                        'transform': 'translate( ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px, 0px )'
                    } );
                } );

                $('.our-services__item-pic').each( function (i) {
                    var elem = $(this),
                        offsetElem = elem.offset().top,
                        koefY = .1;

                    elem.css( {
                        '-webkit-transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )',
                        'transform': 'translate( 0px, ' + ( ( scrollTop - offsetElem ) * koefY ) + 'px )'
                    } );
                } );
            },
            _siteScroll = function( event ) {
                var scrollTime = 1.2,
                    scrollDistance = 170,
                    delta = event.originalEvent.wheelDelta/120 || -event.originalEvent.detail/3,
                    scrollTop = _window.scrollTop(),
                    finalScroll = scrollTop - parseInt( delta * scrollDistance );

                TweenMax.to( _window, scrollTime, {
                    scrollTo : { y: finalScroll, autoKill:true },
                    ease: Power1.easeOut,
                    overwrite: 5
                });
            },
            _init = function() {
                _obj[ 0 ].obj = _self;
                _addEvents();
            };

        //public properties

        //public methods
        _self.setCanUseScroll = function ( param ) {

            _canUseSmoothScroll = param;
        };

        _init();
    };

    var Search = function( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _html = $( 'html' ),
            _header = $( '.site__header' ),
            _scroller = $( 'body, html' ),
            _searchField = _obj.find( 'input' ),
            _showBtn = $( '.search-btn' ),
            _form = _obj.find( '.search__wrap form' ),
            _results = _obj.find( '.search__results' ),
            _founds = _obj.find( '.search__found dd' ),
            _path = $( 'body' ).attr( 'data-action' ),
            _request = new XMLHttpRequest();

        //private methods
        var _constructor = function() {
                _obj[ 0 ].obj = _self;
                _onEvents();
            },
            _onEvents = function() {

                _showBtn.on( {
                    click: function() {

                        if ( !$(this).hasClass( 'get-in-touch-opened' ) ) {
                            _openSeach( $( this ) );
                            setTimeout( function () {
                                _searchField.focus();
                            }, 300 )
                        }
                    }
                } );

                _searchField.on( {
                    keyup: function() {
                        var text = $(this).val();

                        _request.abort();
                        _request = $.ajax({
                            url: _path,
                            data: {
                                action: 'gotit',
                                text: text
                            },
                            dataType: 'json',
                            timeout: 20000,
                            type: "get",
                            success: function ( data ) {

                                _createResult( data );

                            },
                            error: function ( XMLHttpRequest ) {
                                if( XMLHttpRequest.statusText != "abort" ) {
                                    alert( 'Error!' );
                                }
                            }
                        });

                    }
                } );

                $(window).on( {
                    keyup: function(e) {

                        if (e.which == 27) {
                            _showBtn.removeClass( 'opened' );
                            _obj.removeClass( 'opened' );

                            _html.css({
                                'overflow-y': 'auto'
                            });

                            $( '.site' )[0].obj.setCanUseScroll( true );

                            _header.css({
                                'z-index': 2
                            });
                        }
                    }
                } );
            },
            _createResult = function ( data ) {
                var items = data.items;

                $( '.search__results span' ).remove();

                _founds.text( data.count );

                if ( data.count > 0 ) {
                    for ( var i = 0; i < items.length; i++) {
                        _results.append( '<span class="new"><a href="'+ items[i].link +'">' + items[i].title + '</a></span> ' );
                    }
                }

            },
            _openSeach = function( elem )  {

                var curItem = elem;

                if( curItem.hasClass( 'opened' ) ) {

                    curItem.removeClass( 'opened' );
                    _obj.removeClass( 'opened' );

                    _html.css({
                        'overflow-y': 'auto'
                    });

                    $( '.site' )[0].obj.setCanUseScroll( true );

                    _header.css({
                        'z-index': 2
                    });

                } else {

                    curItem.addClass( 'opened' );
                    _obj.addClass( 'opened' );
                    $( '.site__menu, .site__menu-btn, .get-in-touch' ).removeClass( 'opened' );

                    _html.css({
                        'overflow-y': 'hidden'
                    });

                    $( '.site' )[0].obj.setCanUseScroll( false );

                    _header.css({
                        'z-index': 15
                    });
                }
            };

        _constructor();
    };

    var GetInTouch = function( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _html = $( 'html' ),
            _header = $( '.site__header' ),
            _textarea = _obj.find( 'textarea' ),
            _submit = _obj.find( '.get-in-touch__submit, .gform_footer' ),
            _showBtn = $( '.get-in-touch-btn' );
        
        //private methods
        var _constructor = function() {
                _obj[ 0 ].obj = _self;
                _onEvents();
            },
            _onEvents = function() {

                $(window).on( {
                    keyup: function(e) {

                        if (e.which == 27) {
                            $( '.search-btn' ).removeClass( 'get-in-touch-opened' );
                            _obj.removeClass( 'opened' );

                            _html.css({
                                'overflow-y': 'auto'
                            });

                            $( '.site' )[0].obj.setCanUseScroll( true );

                            _header.css({
                                'z-index': 2
                            });
                        }
                    }
                } );

                _showBtn.on( {
                    click: function() {

                        _open();

                        return false;
                    }
                } );

                _textarea.on( {
                    keyup: function() {
                        var elem = $(this),
                            elemValue = elem.val();

                        if ( !elemValue == '' && !_submit.hasClass( 'show' ) ) {
                            _submit.addClass( 'show' );
                        }

                        if ( elemValue == '' ) {
                            _submit.removeClass( 'show' );
                        }
                    }
                } );

                $( '.search-btn' ).on( {
                    click: function() {

                        if ( $(this).hasClass( 'get-in-touch-opened' ) ) {
                            $(this).removeClass( 'get-in-touch-opened' );
                            _close();
                        }
                    }
                } );
            },
            _close = function()  {

                _obj.removeClass( 'opened' );
                $( '.site__header>.phone-number' ).removeClass( 'hidden' );

                _html.css({
                    'overflow-y': 'auto'
                });

                $( '.site' )[0].obj.setCanUseScroll( true );

                _header.css({
                    'z-index': 2
                });
            },
            _open = function()  {

                _obj.addClass( 'opened' );
                $( '.search-btn' ).addClass( 'get-in-touch-opened' );
                $( '.site__header>.phone-number' ).addClass( 'hidden' );

                _html.css({
                    'overflow-y': 'hidden'
                });

                $( '.site' )[0].obj.setCanUseScroll( false );

                _header.css({
                    'z-index': 15
                });
            };

        _constructor();
    };

} )();
