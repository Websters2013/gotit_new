
( function() {
    "use strict";

    $( function() {

        $.each( $( '.paralax' ), function () {

            // new Paralax( $( this ) );
            console.log('paralax')
        });
    });

    var Paralax = function ( obj ) {

        //private properties
        var _self = this,
            _obj = obj,
            _window = $(window),
            _offsetTop = _obj.offset().top;

        //private methods
        var _onEvents = function () {
                _window.on( {
                    scroll: function(){

                        if ( _window.width() >= 768 ) {

                            $.each( _obj, function () {

                                _setPosition( $(this) );

                            });

                        }
                    }
                } );
            },
            _init = function () {

                $.each( _obj, function () {

                    this.startTop = 0;
                    this.distance = this.getAttribute('data-distance');

                });

                _onEvents();
            },
            _setPosition = function( item ){

                var startTop = item[ 0 ].startTop,
                    distance = item[ 0 ].distance,
                    direction = distance / Math.abs( distance ),
                    maxTop = startTop + ( Math.abs(distance) / 2 ),
                    minTop = startTop -  ( Math.abs(distance) / 2 ),
                    minScroll = _offsetTop + minTop,
                    maxScroll = _offsetTop + maxTop + item[ 0 ].height,
                    curPos = minTop,
                    curScroll = _window.scrollTop()+_window.height()/1.8;

                if ( curScroll <= minScroll ){

                    if ( direction < 0 ){

                        curPos = maxTop;

                    } else {

                        curPos = minTop;

                    }

                } else if ( curScroll >= maxScroll ){

                    if( direction < 0 ){

                        curPos = minTop;

                    } else {

                        curPos = maxTop;

                    }
                } else {

                    var t = ( curScroll - minScroll ) / ( maxScroll - minScroll ) * distance;

                    if( direction < 0 ){

                        curPos = maxTop + t;

                    } else {

                        curPos = minTop + t;

                    }
                }

                if ( item.hasClass( 'sideways' ) ) {

                    if ( curPos < 0 ) {

                        curPos = 0

                    }

                    item.css( {
                        transform: 'translate('+curPos+'px, 0)'
                    } );


                } else {

                    item.css( {
                        transform: 'translateY('+curPos+'px)'
                    } );
                }
            };

        //public properties

        //public methods

        _init();
    };

} )();





