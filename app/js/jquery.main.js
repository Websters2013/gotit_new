
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
            _scroller = $( 'body, html' ),
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
            },
            _openMenu = function( elem )  {
                console.log('menu');

                var curItem = elem;

                if( curItem.hasClass( 'opened' ) ) {

                    curItem.removeClass( 'opened' );
                    _menu.removeClass( 'opened' );

                    _scroller.css( {
                        'overflow': 'visible'
                    } );

                    _obj.css({
                        'z-index': 2
                    });

                } else {

                    curItem.addClass( 'opened' );
                    _menu.addClass( 'opened' );
                    $( '.search, .search-btn' ).removeClass( 'opened' );

                    _scroller.css( {
                        'overflow': 'hidden'
                    } );

                    _obj.css({
                        'z-index': 15
                    });
                }
            };

        _constructor();
    };

} )();
