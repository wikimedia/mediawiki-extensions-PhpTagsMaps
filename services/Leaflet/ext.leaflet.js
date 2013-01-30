/**
 * JavaScript for Leaflet in the MultiMaps extension.
 * @see http://www.mediawiki.org/wiki/Extension:MultiMaps
 *
 * @author Pavel Astakhov < pastakhov@yandex.ru >
 */

(function ($, mw) {
    $.fn.multimapsleaflet = function ( options ) {
        var _this = this;
        this.map = null;
        this.options = options;

        /**
        * Creates a new marker with the provided data,
        * adds it to the map, and returns it.
        * @param {Object} markerData Contains the fields lat, lon, title, text and icon
        * @return {L.Marker}
        */
        this.addMarker = function (properties) {
            if( properties.icon ) {
                var icon = new L.Icon({
                    iconUrl: properties.icon
                });
            } else {
                var icon = new L.Icon.Default();
            }

            var markerOptions = {
                icon:icon
            };

            if( properties.title ) {
                markerOptions.title = properties.title;
            }

            var marker = L.marker( [properties.pos[0].lat, properties.pos[0].lon], markerOptions ).addTo( this.map );
            if( properties.text ) marker.bindPopup( properties.text );
        };

        this.addLine = function (properties) {
            var options = {
                color: properties.strokeColor,
                weight:properties.strokeWeight,
                opacity:properties.strokeOpacity
            };

            var latlngs = [];
            for (var x = 0; x < properties.pos.length; x++) {
                latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
                //this.points.push( new L.LatLng(properties.pos[x].lat, properties.pos[x].lon) );
            }

            L.polyline(latlngs, options).addTo(this.map);
        };

        /**
         * TODO: check this
         */
        this.addPolygon = function (properties) {
            var options = {
                color: properties.strokeColor,
                weight:properties.strokeWeight,
                opacity:properties.strokeOpacity,
                fill:properties.fill === false ? false : true, // TODO: check this
                fillColor:properties.fillColor,
                fillOpacity:properties.fillOpacity
            };

            var latlngs = [];
            for (var x = 0; x < properties.pos.length; x++) {
                latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
                //this.points.push( new L.LatLng(properties.pos[x].lat, properties.pos[x].lon) );
            }

            L.Polygon(latlngs, options).addTo(this.map);
        };

        /**
         * TODO: check this
         */
        this.addCircle = function (properties) {
            //this.points.push( new L.LatLng(properties.centre.lat-properties.radius, properties.centre.lon-properties.radius) ); // TODO: check this
            //this.points.push( new L.LatLng(properties.centre.lat+properties.radius, properties.centre.lon+properties.radius) ); // TODO: check this

            var options = {
                color: properties.strokeColor,
                weight:properties.strokeWeight,
                opacity:properties.strokeOpacity,
                fill:properties.fill === false ? false : true, // TODO: check this
                fillColor:properties.fillColor,
                fillOpacity:properties.fillOpacity
            };

            L.Circle([properties.centre.lat, properties.centre.lon], properties.radius, options).addTo(this.map);
        };

        /**
         * TODO: check this
         */
        this.addRectangle = function (properties) {
            //this.points.push( new L.LatLng(properties.sw.lat, properties.sw.lon) );
            //this.points.push( new L.LatLng(properties.ne.lat, properties.ne.lon) );

            var options = {
                color: properties.strokeColor,
                weight:properties.strokeWeight,
                opacity:properties.strokeOpacity,
                fill:properties.fill === false ? false : true, // TODO: check this
                fillColor:properties.fillColor,
                fillOpacity:properties.fillOpacity
            };

            var bounds = [[properties.sw.lat, properties.sw.lon], [properties.ne.lat, properties.ne.lon]];

            L.rectangle( bounds, options ).addTo(this.map);
        };

        this.setup = function () {

            var mapOptions = {};
            if (options.minzoom !== false ) mapOptions.minZoom = options.minzoom;
            if (options.maxzoom !== false ) mapOptions.maxZoom = options.maxzoom;

            var map = L.map( this.get(0), mapOptions ).fitWorld();
            this.map = map;

            // add an OpenStreetMap tile layer
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            if (options.resizable) {
                mw.loader.using('ext.maps.resizable', function () { //TODO: Fix moving map when resized
                    _this.resizable();
                });
            }

            // Add the markers.
            if ( options.markers ) {
                for (var i = 0; i < options.markers.length; i++) {
                    this.addMarker( options.markers[i] );
                }
            }

            // Add lines
            if (options.lines) {
                for (var i = 0; i < options.lines.length; i++) {
                    this.addLine(options.lines[i]);
                }
            }

            // Add polygons
            if (options.polygons) {
                for (var i = 0; i < options.polygons.length; i++) {
                    this.addPolygon(options.polygons[i]);
                }
            }

            // Add circles
            if (options.circles) {
                for (var i = 0; i < options.circles.length; i++) {
                    this.addCircle(options.circles[i]);
                }
            }

            // Add rectangles
            if (options.rectangles) {
                for (var i = 0; i < options.rectangles.length; i++) {
                    this.addRectangle(options.rectangles[i]);
                }
            }

            // Set map position (centre and zoom)
            if( options.bounds ) {
                map.fitBounds( [
                    [options.bounds.sw.lat, options.bounds.sw.lon],
                    [options.bounds.ne.lat, options.bounds.ne.lon]
                ] );
            } else {
                if( options.center ) {
                    map.setView( [options.center.lat, options.center.lon], options.zoom );
                } else if ( options.zoom ) {
                    map.setZoom( options.zoom );
                }
            }
        };

        this.setup();

        return this;

    };
})(jQuery, window.mediaWiki);

(function( $, mw ) {

    $( document ).ready( function() {

        $( '.multimaps-map-leaflet' ).each( function() {
            var $this = $( this );
            $this.multimapsleaflet( $.parseJSON( $this.find( 'div').text() ) );
        } );
    } );

})( window.jQuery, mediaWiki );
