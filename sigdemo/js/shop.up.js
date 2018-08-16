$(function() {
	/**
	 * Store search class
	 */
	$.ShopUpClass = $.Class({
		/* Initialize START *///{{{
		/**
		 * Initial processing variable definition
		 */
		initialize: function() {
			this.map;
			this.shopDatas = JSON.parse($('#json').html());
			this.markerData = {};
			this.geocode;
		},
		/* Initialize END */ //}}}

		/**
		 * Initial processing
		 */
		action: function() {//{{{
			// Show map
			this.map = new google.maps.Map(document.getElementById('map'), {
				zoom: 15,
				center: {
					lat: parseFloat(this.shopDatas.lat),
					lng: parseFloat(this.shopDatas.lon),
				},
				minZoom: 5,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				panControl: false,
				mapTypeControl: false,
				overviewMapControl: false,
				rotateControl: false,
				streetViewControl: false,
				zoomControl: false,
				scaleControl: true,
				fullscreenControl: false,
				gestureHandling: 'greedy'
			});
			this.plotMarker();
		},//}}}

		plotMarker: function() {
			// Create a store marker
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(this.shopDatas.lat, this.shopDatas.lon),
				map: this.map,
				// icon: new google.maps.MarkerImage(
				// 	this.iconImg[brand].src,
				// 	null,
				// 	null,
				// 	new google.maps.Point(this.iconImg[brand].width / 2, this.iconImg[brand].height - 12),
				// 	new google.maps.Size(this.iconImg[brand].width, this.iconImg[brand].height)
				// 	),
				data: this.shopDatas,
				zIndex: 2
			});

			this.markerData = marker;
			this.setMarkerEvent(marker);
			var address = '';
			address += "〒" + $('#shop_up_post').val() + "　" + $('#shop_up_address').val() + "<br>";
			address += "Coordinate: " + $('#shop_up_lat').val() + ", " + $('#shop_up_lon').val() + "<br>";
			address += "OLC: ";
			new google.maps.InfoWindow({content: address}).open(marker.getMap(), marker);
		},

		setMarkerEvent: function(marker) {
			google.maps.event.addListener(marker, 'click', function() {
				this.clickMarker(marker);
			}.bind(this));
		},

		clickMarker: function(marker) {
			// $('.map-text').find('.shop_name').text(marker.data.shop_name);
			// $('.map-text').find('.post').text(marker.data.post);
			// $('.map-text').find('.address').text(marker.data.address);
			// $('.map-text').find('.latlon').text(marker.data.lat + ', ' + marker.data.lon);
			// $('.map-text-area input[name=shop_id]').val(marker.data.shop_id);
			// $('.map-text-area input[type=submit]').attr('id', 'shop_up_' + marker.data.shop_id);
			// $('.toggle').show();
		},

		searchPost: function(key) {
			sendAjax('application/geocode.php', {key: key}).done(function(data) {
				data = JSON.parse(data);
				if (data[1]) {
					data = data[1];
					// Embed the acquired data
					$('#shop_up_address').val(data.a);
					$('#shop_up_lat').val(data.y);
					$('#shop_up_lon').val(data.x);

					//$('#shop_up_lat').html(data.y);
					//$('#shop_up_lon').html(data.x);
					//$('input[name=shop_up_lat]').val(data.y);
					//$('input[name=shop_up_lon]').val(data.x);

					// Move the map and move the marker as well
					this.shopDatas.lat = data.y;
					this.shopDatas.lon = data.x;
					this.map.setCenter(new google.maps.LatLng(this.shopDatas.lat, this.shopDatas.lon));
					this.markerData.setMap(null);
					this.plotMarker();
				} else {
					alert('Address was not found');
				}
			}.bind(this)).fail(function() {
				alert('Automatic search failed');
			});
		},
	});
	$.ShopUpClass.action();

	$(document).on('click', '#search-up_post', function() {
		var key = $('#shop_up_post').val();
		$.ShopUpClass.searchPost(key);
	});

	$('#addr').keypress(function(e) {
		if (e.which == 13) {
			// Describe processing here
			return false;
		}
	});

	/**
	 * Perform Ajax communication
	 *
	 * @param url URL
	 * @param data Transmission data
	 */
	function sendAjax(url, data) {
		var jqXHR = new $.Deferred();
		$.ajax({
			type: 'POST',
			cache: false,
			url: url,
			data: data,
			timeout: 10000
		}).done(function(result) {
			jqXHR.resolve(result);
		}).fail(function(result) {
			jqXHR.reject(result);
		});

		return jqXHR.promise();
	}
});
