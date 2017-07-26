( function() {
    "use strict";

    $( function() {

        $.each( $( '.site__header' ), function() {
            new Menu ( $( this ) );
        } );

    } );

    var Menu = function( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _menu = _obj.find( '.site__menu' ),
            _scroller = $( 'html' ),
            _showBtn = $( '.site__menu-btn' ),
            _header = $( '.site__header'),
            _window = $( window ),
            _action = false,
            _lastPos;

        //private methods
        var _constructor = function() {
                _obj[ 0 ].obj = _self;
                _onEvents();
            },
            _onEvents = function() {

                _showBtn.on( {
                    click: function() {

                        _openMenu( $( this ) );
                    }
                } );

                _window.on( {
                    'keyup': function(e) {

                        if (e.which == 27) {
                            _showBtn.removeClass( 'opened' );
                            _menu.removeClass( 'opened' );

                            _scroller.css( {
                                'overflow-y': 'auto'
                            } );

                            $( '.site' )[0].obj.setCanUseScroll( true );

                            _obj.css({
                                'z-index': 2
                            });
                        }
                    },
                    'scroll': function () {

                        _action = _window.scrollTop() >= _header.innerHeight();

                    },
                    'DOMMouseScroll': function ( e ) {
                        var delta = e.originalEvent.detail;
                        if ( delta ) {
                            var direction = ( delta > 0 ) ? 1 : -1;
                            _checkScroll( direction );
                        }
                    },
                    'mousewheel': function ( e ) {
                        var delta = e.originalEvent.wheelDelta;
                        if ( delta ) {
                            var direction = ( delta > 0 ) ? -1 : 1;
                            _checkScroll( direction );
                        }
                    },
                    'touchmove': function ( e ) {
                        var currentPos = e.originalEvent.touches[0].clientY;
                        if ( currentPos > _lastPos ) {
                            _checkScroll( -1 );
                        } else if ( currentPos < _lastPos ) {
                            _checkScroll( 1 );
                        }
                        _lastPos = currentPos;
                    },
                } );
            },
            _checkScroll = function( direction ){

                if( _action ){
                    _header.addClass( 'site__header_minimize' );
                } else {
                    _header.removeClass( 'site__header_minimize' );
                }

                if( direction > 0 && !_header.hasClass( 'site__header_hidden' ) && _action ) {
                    _header.addClass( 'site__header_hidden' );
                }
                if( direction < 0 && _header.hasClass( 'site__header_hidden' ) && _action ) {
                    _header.removeClass( 'site__header_hidden' );
                }
            },
            _openMenu = function( elem )  {

                var curItem = elem;

                if( curItem.hasClass( 'opened' ) ) {

                    curItem.removeClass( 'opened' );
                    _menu.removeClass( 'opened' );

                    _scroller.css( {
                        'overflow-y': 'auto'
                    } );

                    $( '.site' )[0].obj.setCanUseScroll( true );

                    _obj.css({
                        'z-index': 2
                    });

                } else {

                    curItem.addClass( 'opened' );
                    _menu.addClass( 'opened' );
                    $( '.search, .search-btn, .get-in-touch' ).removeClass( 'opened' );
                    $( '.get-in-touch-opened' ).removeClass( 'get-in-touch-opened' );

                    _scroller.css( {
                        'overflow-y': 'hidden'
                    } );

                    $( '.site' )[0].obj.setCanUseScroll( false );

                    _obj.css({
                        'z-index': 15
                    });
                }
            };

        _constructor();
    };

} )();