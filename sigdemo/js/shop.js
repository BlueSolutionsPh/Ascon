$(function() {
	/**
	 * Store search class
	 */
	$.ShopClass = $.Class({
		/* Initialize START *///{{{
		/**
		 * Initial processing variable definition
		 */
		initialize: function() {
			this.map;
			this.shopDatas = JSON.parse($('#json').html());
			this.markerData = {};
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
					lat: 34.70190399,
					lng: 135.510025
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
			this.fitBounds(this.markerData);
		},//}}}

		plotMarker: function() {
			for (var i in this.shopDatas) {
				var shopData = this.shopDatas[i];
				// Create a store marker
				var marker = new google.maps.Marker({
					position: new google.maps.LatLng(shopData.lat, shopData.lon),
					map: this.map,
					// icon: new google.maps.MarkerImage(
					// 	this.iconImg[brand].src,
					// 	null,
					// 	null,
					// 	new google.maps.Point(this.iconImg[brand].width / 2, this.iconImg[brand].height - 12),
					// 	new google.maps.Size(this.iconImg[brand].width, this.iconImg[brand].height)
					// 	),
					data: shopData,
					zIndex: 2
				});
				this.markerData[shopData.shop_id] = marker;
				this.setMarkerEvent(marker);
			}
			if (Object.keys(this.shopDatas).length == 1) this.clickMarker(marker);
		},

		setMarkerEvent: function(marker) {
			google.maps.event.addListener(marker, 'click', function() {
				this.clickMarker(marker);
			}.bind(this));
		},

		clickMarker: function(marker) {
			$('.map-text').find('.client_name').text(marker.data.client_name);
			$('.map-text').find('.shop_name').text(marker.data.shop_name);
			$('.map-text').find('.post').text(marker.data.post);
			$('.map-text').find('.address').text(marker.data.address);
			$('.map-text').find('.latlon').text(marker.data.lat + ', ' + marker.data.lon);
			$('.map-text-area input[name=shop_id]').val(marker.data.shop_id);
			$('.map-text-area input[type=submit]').attr('id', 'shop_up_' + marker.data.shop_id);
			$('.toggle').show();
		},

		fitBounds: function(markers) {
			var minX, minY, maxX, maxY;
			// Keep within range
			for (var i in markers) {
				var lt = markers[i].getPosition().lat();
				var lg = markers[i].getPosition().lng();
				if (typeof(minX) == 'undefined') {
					minX = markers[i].getPosition().lng();
					minY = markers[i].getPosition().lat();
					maxX = markers[i].getPosition().lng();;
					maxY = markers[i].getPosition().lat();;
				}
				if (lg <= minX) minX = lg;
				if (lg > maxX) maxX = lg;
				if (lt <= minY) minY = lt;
				if (lt > maxY) maxY = lt;
			}
			var sw = new google.maps.LatLng(maxY, minX);
			var ne = new google.maps.LatLng(minY, maxX);
			var bounds = new google.maps.LatLngBounds(sw, ne);
			this.map.fitBounds(bounds);
		},
	});
	$.ShopClass.action();

	// Transition to booth list
	$(document).on('click', '#menu_booth', function() {
		sendPost('booth', {shop: $('input[name=shop_id]').val()});
		return false;
	});

	/**
	 * Perform POST transmission
	 *
	 * @param url Transit destination URL
	 * @param data POST Data to send
	 */
	function sendPost(url, data) {
		var form = $('<form>').attr('method', 'post').attr('action', url);
		for (var i in data) {
			$('<input type="hidden">').attr('name', i).val(data[i]).appendTo(form);
		}
		form.appendTo('body').submit().remove();
	}
});
