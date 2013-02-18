/**
 * JavaScript for Leaflet in the MultiMaps extension.
 * @see http://www.mediawiki.org/wiki/Extension:MultiMaps
 *
 * @author Pavel Astakhov < pastakhov@yandex.ru >
 */

(function ($, mw) {
	$.fn.multimapsyandex = function ( options ) {
		var _this = this;
		this.map = null;
		this.options = options;

		/**
		 * Convert properties given from multimaps extension to options of map element
		 * @param {Object} properties Contains the fields lat, lon, title, text and icon
		 * @return {Object} options of map element
		 */
		this.convertPropertiesToOptions = function (properties) {
			var prop = {};
			var options = {};

			if( properties.icon !== undefined ) {
				options.iconImageHref = properties.icon;
			}
			if( properties.color !== undefined ) {
				options.strokeColor = properties.color;
			}
			if( properties.weight !== undefined ) {
				options.strokeWidth = properties.weight;
			}
			if( properties.opacity !== undefined ) {
				options.strokeOpacity = properties.opacity;
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

			if( properties.title !== undefined && properties.text !== undefined ) {
				prop.hintContent = properties.title;
				prop.balloonContent = '<strong>' + properties.title + '</strong><hr />' + properties.text;
			} else if( properties.title !== undefined ) {
				prop.hintContent = properties.title;
				prop.balloonContent = '<strong>' + properties.title + '</strong>';
			} else if( properties.text  !== undefined ) {
				prop.balloonContent = properties.text;
			}

			return { properties:prop, options:options };
		};

		/**
		 * Add Marker to map
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

			var marker = new ymaps.Placemark( [properties.pos[0].lat, properties.pos[0].lon], value.properties, value.options );
			this.map.geoObjects.add(marker);
		};

		/**
		 * Add Line to map
		 * @param {Object} properties
		 */
		this.addLine = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
			}

			var polyline = new ymaps.Polyline( latlngs, value.properties, value.options );
			this.map.geoObjects.add(polyline);
		};

		/**
		 * Add Polygon to map
		 * @param {Object} properties
		 */
		this.addPolygon = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push([properties.pos[x].lat, properties.pos[x].lon]);
			}
			latlngs.push([properties.pos[0].lat, properties.pos[0].lon]);

			var polygon = new ymaps.Polygon( [latlngs], value.properties, value.options );
			this.map.geoObjects.add(polygon);
		};

		/**
		 * Add Circle to map
		 * @param {Object} properties
		 */
		this.addCircle = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var circle = new ymaps.Circle( [[properties.pos[0].lat, properties.pos[0].lon], properties.radius[0]], value.properties, value.options );
			this.map.geoObjects.add(circle);
		};

		/**
		 * Add Rectangle to map
		 * @param {Object} properties
		 */
		this.addRectangle = function (properties) {
			var value = this.convertPropertiesToOptions(properties);

			var bounds = [[properties.pos[0].lat, properties.pos[0].lon], [properties.pos[1].lat, properties.pos[1].lon]];

			var rectangle = new ymaps.Rectangle( bounds, value.properties, value.options );
			this.map.geoObjects.add(rectangle);
		};

		this.setup = function () {

			var mapOptions = {};
			if (options.minzoom !== false ) mapOptions.minZoom = options.minzoom;
			if (options.maxzoom !== false ) mapOptions.maxZoom = options.maxzoom;
			var mapState = {
				center:[0, 0],
				zoom: 1
			};

			this.get(0).innerHTML = '';
			var map = new ymaps.Map( this.get(0), mapState, mapOptions );
			map.controls
                .add('zoomControl')
                .add('typeSelector')
                .add('smallZoomControl', { right: 5, top: 75 });
			this.map = map;

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
				map.setBounds( [
					[options.bounds.sw.lat, options.bounds.sw.lon],
					[options.bounds.ne.lat, options.bounds.ne.lon]
				] );
			} else {
				if( options.center ) {
					map.setCenter( [options.center.lat, options.center.lon], options.zoom );
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

	ymaps.ready( function() {

		$( '.multimaps-map-yandex' ).each( function() {
			var $this = $( this );
			$this.multimapsyandex( $.parseJSON( $this.find('div').text() ) );
		} );
	} );

})( window.jQuery, mediaWiki );
