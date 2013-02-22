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
		 * Convert properties given from multimaps extension to options of map element
		 * @param {Object} properties Contains the fields lat, lon, title, text and icon
		 * @return {Object} options of map element
		 */
		this.convertPropertiesToOptions = function (properties) {
			var options = {};

			if( properties.icon !== undefined ) {
				options.icon = new L.Icon({
					iconUrl: properties.icon
				});
			}
			if( properties.color !== undefined ) {
				options.color = properties.color;
			}
			if( properties.weight !== undefined ) {
				options.weight = properties.weight;
			}
			if( properties.opacity !== undefined ) {
				options.opacity = properties.opacity;
			}
			if( properties.fill !== undefined ) {
				options.fill = properties.fill;
			}
			if( properties.fillcolor !== undefined ) {
				options.fillColor = properties.fillcolor;
			}
			if( properties.fillopacity !== undefined ) {
				options.fillOpacity = properties.fillopacity;
			}

			var text = false;
			if( properties.title !== undefined && properties.text !== undefined ) {
				options.title = properties.title;
				text = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title !== undefined ) {
				options.title = properties.title;
				text = '<strong>' + properties.title + '</strong>';
			} else if( properties.text  !== undefined ) {
				text = properties.text;
			}

			return { options:options, text:text };
		};

		/**
		* Creates a new marker with the provided data,
		* adds it to the map, and returns it.
		* @param {Object} properties Contains the fields lat, lon, title, text and icon
		* @param {String} icon Global value for all icons
		*/
		this.addMarker = function (properties, icon) {
			if( icon ) {
				if( !properties.icon ) {
					properties.icon = icon;
				}
			}
			var value = this.convertPropertiesToOptions(properties);

			var marker = L.marker( [properties.pos[0].lat, properties.pos[0].lon], value.options ).addTo( this.map );
			if( value.text ) {
				marker.bindPopup( value.text );
			}
		};

		this.addLine = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
			}

			var polyline = L.polyline(latlngs, value.options).addTo(this.map);
			if( value.text ) {
				polyline.bindPopup( value.text );
			}
		};

		/**
		 * TODO: check this
		 */
		this.addPolygon = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
			}

			var polygon = L.polygon(latlngs, value.options).addTo(this.map);
			if( value.text ) {
				polygon.bindPopup( value.text );
			}
		};

		/**
		 * TODO: check this
		 */
		this.addCircle = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var circle = L.circle([properties.pos[0].lat, properties.pos[0].lon], properties.radius[0], value.options).addTo(this.map);
			if( value.text ) {
				circle.bindPopup( value.text );
			}
		};

		/**
		 * TODO: check this
		 */
		this.addRectangle = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var bounds = [[properties.pos[0].lat, properties.pos[0].lon], [properties.pos[1].lat, properties.pos[1].lon]];

			var rectangle = L.rectangle( bounds, value.options ).addTo(this.map);
			if( value.text ) {
				rectangle.bindPopup( value.text );
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
				this.addMarker( options.markers[im], options.icon );
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
			$this.multimapsleaflet( $.parseJSON( $this.find('div').text() ) );
		} );
	} );

})( window.jQuery, mediaWiki );
