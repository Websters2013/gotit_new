( function() {
    "use strict";

    $( function() {

        $.each( $( '.site__header' ), function() {

            new Menu ( $( this ) );
        } );

    });

    var Menu = function( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _menu = _obj.find( '.site__menu' ),
            _scroller = $( 'html' ),
            _showBtn = $( '.site__menu-btn' );

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

                $(window).on( {
                    keyup: function(e) {

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
                    }
                } );
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