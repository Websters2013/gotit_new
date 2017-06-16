
( function() {
    "use strict";

    $( function() {

        $.each( $( '.contact__map' ), function() {

            new Map ( $( this ) );

        } );
    });

    var Map = function ( obj ) {

        // this.obj = obj;
        // this.mapWrap = this.obj;

        //private properties
        var _self = this,
            _wrap = obj,
            _map,
            _markers = [],
            _data = null;

        //private methods
        var _constructor = function () {
                _loadData();
                _onEvents();
            },
            _initMap = function () {

                var mapOptions = {
                    drag: false,
                    dragable: false,
                    disableDefaultUI: true,
                    scrollwheel: false,
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                };

                _map = new google.maps.Map( _wrap[0], mapOptions );

                _setMarkers( _map );

            },
            _loadData = function () {

                _data = _wrap.data( 'map' );

                _initMap();

            },
            _onEvents = function () {


            },
            _setMarkers = function ( map ) {

                for ( var j =0; j < _data[ 'places' ].length; j++ ) {

                    _addMarker( j, map )
                }
            },
            _addMarker = function ( i, map ) {

                var curItem = _data[ 'places' ][ i ],
                    curLatLng = new google.maps.LatLng( curItem[ 'lat' ], curItem[ 'lng' ] ),
                    bounds = new google.maps.LatLngBounds();

                _markers[ i ] = new google.maps.Marker( {
                    position: curLatLng,
                    map: map,
                    clickable: false,
                    icon: {
                        url: './img/map_icon.png',
                        scaledSize: new google.maps.Size( 24, 33 )
                    }
                } );

                for ( var j = 0; j < _markers.length; j++ ) {

                    if ( _markers[ j ] !== '' ) {
                        bounds.extend( _markers[ j ].getPosition() );
                    }
                }
                _map.fitBounds( bounds );
            };

        _constructor();
    };

} )();
