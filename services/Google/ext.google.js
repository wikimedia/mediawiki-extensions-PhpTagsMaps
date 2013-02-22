/**
 * JavaScript for Leaflet in the MultiMaps extension.
 * @see http://www.mediawiki.org/wiki/Extension:MultiMaps
 *
 * @author Pavel Astakhov < pastakhov@yandex.ru >
 */

(function ($, mw) {
	$.fn.multimapsgoogle = function ( options ) {
		var _this = this;
		this.map = null;
		this.options = options;

		/**
		 * Convert properties given from multimaps extension to options of map element
		 * @param {Object} properties Contains the fields lat, lon, title, text and icon
		 * @return {Object} options of map element
		 */
		this.convertPropertiesToGoogleOptions = function (properties) {
			var options = {};

			if( properties.icon !== undefined ) {
				options.icon = properties.icon;
			}
			if( properties.color !== undefined ) {
				options.strokeColor = properties.color;
			}
			if( properties.weight !== undefined ) {
				options.strokeWeight = properties.weight;
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
		this.addMarker = function (properties) {
			var value = this.convertPropertiesToGoogleOptions(properties);
			value.options.position = new google.maps.LatLng(properties.pos[0].lat, properties.pos[0].lon);
			value.options.map = this.map;

			var marker = new google.maps.Marker( value.options );

			if( value.text ) {
				var infowindow = new google.maps.InfoWindow({ content: value.text });
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(marker.get('map'), marker);
				});
			}
		};

		this.addLine = function (properties) {
			var value = this.convertPropertiesToGoogleOptions(properties);

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push( new google.maps.LatLng(properties.pos[x].lat, properties.pos[x].lon) );
			}
			value.options.path = latlngs;
			value.options.map = this.map;

			var polyline = new google.maps.Polyline(value.options);
			if( value.text ) {
				var infowindow = new google.maps.InfoWindow({ content: value.text });
				google.maps.event.addListener(polyline, 'click', function() {
					infowindow.open(polyline.get('map'), polyline);
				});
			}
		};

		this.addPolygon = function (properties) {
			var value = this.convertPropertiesToGoogleOptions(properties);

			var latlngs = [];
			for (var x = 0; x < properties.pos.length; x++) {
				latlngs.push( new google.maps.LatLng(properties.pos[x].lat, properties.pos[x].lon) );
			}
			value.options.paths = latlngs;
			value.options.map = this.map;

			var polygon = new google.maps.Polygon(value.options);
			if( value.text ) {
				var infowindow = new google.maps.InfoWindow({ content: value.text });
				google.maps.event.addListener(polygon, 'click', function() {
					infowindow.open(polygon.get('map'), polygon);
				});
			}
		};

		this.addCircle = function (properties) {
			var value = this.convertPropertiesToGoogleOptions(properties);

			value.options.center = new google.maps.LatLng(properties.pos[0].lat, properties.pos[0].lon);
			value.options.radius = properties.radius[0];
			value.options.map = this.map;
			var circle = new google.maps.Circle(value.options);
			if( value.text ) {
				var infowindow = new google.maps.InfoWindow({ content: value.text });
				google.maps.event.addListener(circle, 'click', function() {
					infowindow.open(circle.get('map'), circle);
				});
			}
		};

		this.addRectangle = function (properties) {
			var value = this.convertPropertiesToGoogleOptions(properties);

			var bounds = new google.maps.LatLngBounds ();
			bounds.extend( new google.maps.LatLng(properties.pos[0].lat, properties.pos[0].lon) );
			bounds.extend( new google.maps.LatLng(properties.pos[1].lat, properties.pos[1].lon) );
			value.options.bounds = bounds;
			value.options.map = this.map;

			var rectangle = new google.maps.Rectangle( value.options );
			if( value.text ) {
				var infowindow = new google.maps.InfoWindow({ content: value.text });
				google.maps.event.addListener(rectangle, 'click', function() {
					infowindow.open(rectangle.get('map'), rectangle);
				});
			}
		};

		this.setDefaultOptions = function (elementname, elementoptions) {
			if( options.title && !elementoptions.title ) {
				elementoptions.title = options.title;
			}
			if( options.text && !elementoptions.text ) {
				elementoptions.text = options.text;
			}

			switch( elementname ) {
				case 'marker':
					if( options.icon && !elementoptions.icon ) {
						elementoptions.icon = options.icon;
					}
					break;
				case 'polygon':
				case 'circle':
				case 'rectangle':
					if( options.fillcolor && !elementoptions.fillcolor ) {
						elementoptions.fillcolor = options.fillcolor;
					}
					if( options.fillopacity && !elementoptions.fillopacity ) {
						elementoptions.fillopacity = options.fillopacity;
					}
					if( options.fill && !elementoptions.fill ) {
						elementoptions.fill = options.fill;
					}
					// break is not necessary here
				case 'line':
					if( options.color && !elementoptions.color ) {
						elementoptions.color = options.color;
					}
					if( options.weight && !elementoptions.weight ) {
						elementoptions.weight = options.weight;
					}
					if( options.opacity && !elementoptions.opacity ) {
						elementoptions.opacity = options.opacity;
					}
					break;
			}
			return elementoptions;
		};

		this.setup = function () {

			var mapOptions = {
				center: new google.maps.LatLng(0, 0),
				zoom: 1,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			if (options.minzoom !== false ) mapOptions.minZoom = options.minzoom;
			if (options.maxzoom !== false ) mapOptions.maxZoom = options.maxzoom;

			var map = new google.maps.Map( this.get(0), mapOptions); //.fitWorld();

			this.map = map;

			if (options.resizable) {
				mw.loader.using('ext.maps.resizable', function () {
					_this.resizable();
				});
			}

			// Add the markers.
			for (var im in options.markers) {
				this.addMarker( this.setDefaultOptions('marker', options.markers[im]) );
			}

			// Add lines
			for (var il in options.lines) {
				this.addLine( this.setDefaultOptions('line', options.lines[il]) );
			}

			// Add polygons
			for (var ip in options.polygons) {
				this.addPolygon( this.setDefaultOptions('polygon', options.polygons[ip]) );
			}

			// Add circles
			for (var ic in options.circles) {
				this.addCircle( this.setDefaultOptions('circle', options.circles[ic]) );
			}

			// Add rectangles
			for (var ir in options.rectangles) {
				this.addRectangle( this.setDefaultOptions('rectangle', options.rectangles[ir]) );
			}

			// Set map position (centre and zoom)
			if( options.bounds ) {
				map.fitBounds( new google.maps.LatLngBounds(
						new google.maps.LatLng(options.bounds.sw.lat, options.bounds.sw.lon),
						new google.maps.LatLng(options.bounds.ne.lat, options.bounds.ne.lon)
						) );
			} else {
				if( options.center ) {
					map.setCenter( new google.maps.LatLng(options.center.lat, options.center.lon) );
					map.setZoom( options.zoom );
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

		$( '.multimaps-map-google' ).each( function() {
			var $this = $( this );
			$this.multimapsgoogle( $.parseJSON( $this.find('div').text() ) );
		} );
	} );

})( window.jQuery, mediaWiki );
