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
		* @param {Object} properties Contains the fields lat, lon, title, text and icon
		*/
		this.addMarker = function (properties) {
			var options = {};

			if( properties.icon ) {
				options.icon = new L.Icon({
					iconUrl: properties.icon
				});
			}
			var text = false;
			if( properties.title && properties.text) {
				options.title = properties.title;
				text = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title ) {
				options.title = properties.title;
				text = '<strong>' + properties.title + '</strong>';
			} else if( properties.text ) {
				text = properties.text;
			}

			var marker = L.marker( [properties.pos[0].lat, properties.pos[0].lon], options ).addTo( this.map );
			if( text ) {
				marker.bindPopup( text );
			}
		};

		this.addLine = function (properties) {
			var options = {};

			if( properties.color ) {
				options.color = properties.color;
			}
			if( properties.weight ) {
				options.weight = properties.weight;
			}
			if( properties.opacity ) {
				options.opacity = properties.opacity;
			}
			if( properties.title ) {
				options.title = properties.title;
			}
			var text = false;
			if( properties.title && properties.text) {
				text = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title ) {
				text = '<strong>' + properties.title + '</strong>';
			} else if( properties.text ) {
				text = properties.text;
			}

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
			}

			var polyline = L.polyline(latlngs, options).addTo(this.map);
			if( text ) {
				polyline.bindPopup( text );
			}
		};

		/**
		 * TODO: check this
		 */
		this.addPolygon = function (properties) {
			var options = {};

			if( properties.color ) {
				options.color = properties.color;
			}
			if( properties.weight ) {
				options.weight = properties.weight;
			}
			if( properties.opacity ) {
				options.opacity = properties.opacity;
			}
			if( properties.fill ) {
				options.fill = properties.fill;
			}
			if( properties.fillColor ) {
				options.fillColor = properties.fillColor;
			}
			if( properties.fillOpacity ) {
				options.fillOpacity = properties.fillOpacity;
			}
			if( properties.title ) {
				options.title = properties.title;
			}
			var text = false;
			if( properties.title && properties.text) {
				text = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title ) {
				text = '<strong>' + properties.title + '</strong>';
			} else if( properties.text ) {
				text = properties.text;
			}

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
			}

			var polygon = L.polygon(latlngs, options).addTo(this.map);
			if( text ) {
				polygon.bindPopup( text );
			}
		};

		/**
		 * TODO: check this
		 */
		this.addCircle = function (properties) {
			var options = {};

			if( properties.color ) {
				options.color = properties.color;
			}
			if( properties.weight ) {
				options.weight = properties.weight;
			}
			if( properties.opacity ) {
				options.opacity = properties.opacity;
			}
			if( properties.fill ) {
				options.fill = properties.fill;
			}
			if( properties.fillColor ) {
				options.fillColor = properties.fillColor;
			}
			if( properties.fillOpacity ) {
				options.fillOpacity = properties.fillOpacity;
			}
			if( properties.title ) {
				options.title = properties.title;
			}
			var text = false;
			if( properties.title && properties.text) {
				text = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title ) {
				text = '<strong>' + properties.title + '</strong>';
			} else if( properties.text ) {
				text = properties.text;
			}

			var circle = L.circle([properties.pos[0].lat, properties.pos[0].lon], properties.radius[0], options).addTo(this.map);
			if( text ) {
				circle.bindPopup( text );
			}
		};

		/**
		 * TODO: check this
		 */
		this.addRectangle = function (properties) {
			var options = {};

			if( properties.color ) {
				options.color = properties.color;
			}
			if( properties.weight ) {
				options.weight = properties.weight;
			}
			if( properties.opacity ) {
				options.opacity = properties.opacity;
			}
			if( properties.fill ) {
				options.fill = properties.fill;
			}
			if( properties.fillColor ) {
				options.fillColor = properties.fillColor;
			}
			if( properties.fillOpacity ) {
				options.fillOpacity = properties.fillOpacity;
			}
			if( properties.title ) {
				options.title = properties.title;
			}
			var text = false;
			if( properties.title && properties.text) {
				text = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title ) {
				text = '<strong>' + properties.title + '</strong>';
			} else if( properties.text ) {
				text = properties.text;
			}

			var bounds = [[properties.pos[0].lat, properties.pos[0].lon], [properties.pos[1].lat, properties.pos[1].lon]];

			var rectangle = L.rectangle( bounds, options ).addTo(this.map);
			if( text ) {
				rectangle.bindPopup( text );
			}
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
			for (var im in options.markers) {
				this.addMarker( options.markers[im] );
			}

			// Add lines
			for (var il in options.lines) {
				this.addLine(options.lines[il]);
			}

			// Add polygons
			for (var ip in options.polygons) {
				this.addPolygon(options.polygons[ip]);
			}

			// Add circles
			for (var ic in options.circles) {
				this.addCircle(options.circles[ic]);
			}

			// Add rectangles
			for (var ir in options.rectangles) {
				this.addRectangle(options.rectangles[ir]);
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
