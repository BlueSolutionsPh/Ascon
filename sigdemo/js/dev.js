$(function() {
	// Mouse over the ? Mark to display a help message.
	if ($('span.popup_help')[0]) $('span.popup_help').popupHelp();

	var list = (['Booth registration', 'Booth update'].indexOf($('.title').html()) >= 0) ? 'booth' : 'dev',
		disp = $('input[name="disp"]').val(),

		client_id = $('#' + list + '_' + disp + '_client_id'),
		shop = $('#' + list + '_' + disp + '_shop'),
		shop_values = shop.find('option').map(function(){
			return {
				'data-client_id': $(this).data('client_id'),
				value: $(this).val(),
				html: $(this).html()
			};
		}).toArray(),

		booth_id = $('#' + list + '_' + disp + '_booth_id'),
		booth_values = booth_id.find('option').map(function(){
			return {
				'data-sex_id': $(this).data('sex_id'),
				'data-floor_id': $(this).data('floor_id'),
				'data-shop_id': $(this).data('shop_id'),
				value: $(this).val(),
				html: $(this).html()
			};
		}).toArray(),

		floor_id = $('#' + list + '_' + disp + '_floor_id'),
		floor_values = floor_id.find('option').map(function() {
			return {value: $(this).val(), html: $(this).html()};
		}).toArray(),

		sex_id = $('#' + list + ((['Device registration', 'Confirmation'].indexOf($('.title').html()) >= 0) ? '_' + disp : '') + '_sex_id'),
		sex_values = sex_id.find('option').map(function() {
			return {value: $(this).val(), html: $(this).html()};
		}).toArray();
	// The value of the installation floor to be initially displayed
	if (booth_id[0]) {
		var floorValue = floor_id.val();
		var floors = [];
		for (var i in booth_values) floors.push(booth_values[i]['data-floor_id'].toString());
		var html = '';
		for (var i in floor_values) {
			if (floors.indexOf(floor_values[i].value.toString()) >= 0) {
				html += getOption(floor_values[i]);
			}
		}
		floor_id.html(html);
		floor_id.val(floorValue);
	}

	// Change contract client name
	$(document).on('change', client_id.selector, function() {
		var html = '';
		var shops = [];
		for (var i in shop_values) {
			if ($(this).val() === '' || ['', $(this).val().toString()].indexOf(shop_values[i]['data-client_id'].toString()) >= 0) {
				html += getOption(shop_values[i]);
				shops.push(shop_values[i].value);
			}
		}
		shop.html(html);
		if (booth_id[0]) {
			var html = '', fl = [], se = [];
			for (var i in booth_values) {
				if (shops.indexOf(booth_values[i]['data-shop_id'].toString()) >= 0) {
					html += getOption(booth_values[i]);
					if (fl.indexOf(booth_values[i]['data-floor_id']) < 0) fl.push(booth_values[i]['data-floor_id'].toString());
					if (se.indexOf(booth_values[i]['data-sex_id']) < 0) se.push(booth_values[i]['data-sex_id'].toString());
				}
			}
			booth_id.html(html);
			html = '';
			for (var i in floor_values) {
				if (floor_values[i].value === '' || fl.indexOf(floor_values[i].value) >= 0) {
					html += getOption(floor_values[i]);
				}
			}
			floor_id.html(html);
			html = '';
			for (var i in sex_values) {
				if (sex_values[i].value === '' || se.indexOf(sex_values[i].value) >= 0) {
					html += getOption(sex_values[i]);
				}
			}
			sex_id.html(html);
		}
	});
	// Change facility name
	$(document).on('change', shop.selector, function() {
		var value = $(this).val();
		var clientId = $(this).find('[value="' + $(this).val() + '"]').data('client_id');
		if (clientId !== '') client_id.val(clientId);
		client_id.trigger('change');
		$(this).val(value);
		if (booth_id[0]) {
			var html = '', fl = [], se = [];
			for (var i in booth_values) {
				if ($(this).val() === '' || ['', $(this).val().toString()].indexOf(booth_values[i]['data-shop_id'].toString()) >= 0) {
					html += getOption(booth_values[i]);
					if (fl.indexOf(booth_values[i]['data-floor_id']) < 0) fl.push(booth_values[i]['data-floor_id'].toString());
					if (se.indexOf(booth_values[i]['data-sex_id']) < 0) se.push(booth_values[i]['data-sex_id'].toString());
				}
			}
			booth_id.html(html);
			if (booth_id.children().length == 2) booth_id.val(booth_id.find('option[data-shop_id="' + value + '"]').val());
			html = '';
			for (var i in floor_values) {
				if (floor_values[i].value === '' || fl.indexOf(floor_values[i].value) >= 0) html += getOption(floor_values[i]);
			}
			floor_id.html(html);
			if (floor_id.children().length == 2) floor_id.val(booth_id.find('option[data-shop_id="' + value + '"]').data('floor_id'));
			html = '';
			for (var i in sex_values) {
				if (sex_values[i].value === '' || se.indexOf(sex_values[i].value) >= 0) {
					html += getOption(sex_values[i]);
				}
			}
			sex_id.html(html);
			if (sex_id.children().length == 2) sex_id.val(booth_id.find('option[data-shop_id="' + value + '"]').data('sex_id'));
		}
	});
	// Booth name change
	$(document).on('change', booth_id.selector, function() {
		var value = $(this).val(),
			floorId = $(this).find('option[value="' + $(this).val() + '"]').data('floor_id'),
			sexId = $(this).find('option[value="' + $(this).val() + '"]').data('sex_id'),
			shopId = $(this).find('[value="' + $(this).val() + '"]').data('shop_id');
		// If the facility list is not set, set it
		if (shopId !== '' && shopId != shop.val()) {
			shop.val(shopId);
			var clientId = shop.find('[value="' + shop.val() + '"]').data('client_id');
			if (clientId !== '') client_id.val(clientId);
		}

		// If the installation floor list is not set, set it
		if (!floor_id.val()) {
			floor_id.val(floorId);
		}
		// Confirm gender list
		var html = '';
		for (var i in sex_values) {
			if (sexId === '' || (sex_values[i].value !== '' && sexId.toString() === sex_values[i].value)) html += getOption(sex_values[i]);
		}
		sex_id.html(html);
		$(this).val(value);
	});
	// Change of installation floor
	$(document).on('change', floor_id.selector, function() {
		var value = $(this).val();
		if (booth_id[0]) {
			var shopId = shop.val();
			boothOption = [];
			for (var i in booth_values) {
				var bval = booth_values[i], floorStr = bval['data-floor_id'].toString(), shopStr = bval['data-shop_id'].toString();
				if (value.toString() === '' || floorStr === value.toString()) if (shopId.toString() === '' || shopStr === shopId) boothOption.push(booth_values[i]);
			}
			var boothId = [];
			for (var i in boothOption) boothId.push(boothOption[i].value.toString());
			var sexId = [];
			for (var i in boothOption) sexId.push((typeof(boothOption[i]['data-sex_id']) == 'undefined') ? '' : boothOption[i]['data-sex_id'].toString());
			var html = '';
			for (var i in booth_values) if (booth_values[i].value == '' || boothId.indexOf(booth_values[i].value.toString()) >= 0) html += getOption(booth_values[i]);
			booth_id.html(html);
			if (boothId.length == 1) booth_id.val(boothId[0]);
			// Confirm gender list
			var html = '';
			for (var i in sex_values) if (sex_values[i].value !== '' && sexId.indexOf(sex_values[i].value.toString()) >= 0) html += getOption(sex_values[i]);
			sex_id.html(html);
		}
	});
	// Change of gender
	$(document).on('change', sex_id.selector, function() {
		var value = $(this).val();
		var html = '';
		if (booth_id[0]) {
			for (var i in booth_values) {
				if (
					booth_values[i].value === '' ||
					(
					 ($(this).val() === '' || ['', $(this).val().toString()].indexOf(booth_values[i]['data-sex_id'].toString()) >= 0) &&
					 (!shop.val() || booth_values[i]['data-shop_id'].toString() == shop.val().toString()) &&
					 (!client_id.val() || client_id.val().toString() == shop.find('[value="' + booth_values[i]['data-shop_id'] + '"]').data('client_id'))
					)
				) {
					html += getOption(booth_values[i]);
				}
			}
			booth_id.html(html);
		}
	});

	// Click the number of terminals
	$(document).on('click', 'a[id^=booth_dev_]', function() {
		sendPost($(this).attr('href'), {
			'booth_id': $(this).attr('id').split('_').pop()
		});
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

	var updateFloor = floor_id.val();
	var updateSex = sex_id.val();
	var updateBooth = booth_id.val();
	// If set from the beginning, fire an event
	if (shop.val()) {
		shop.trigger('change');
	} else if (client_id.val()) {
		client_id.trigger('change');
	}
	if (updateBooth) {
		booth_id.val(updateBooth);
		booth_id.trigger('change');
	} else {
		if (updateFloor) {
			floor_id.trigger('change');
			floor_id.val(updateFloor);
		}
		if (updateSex) {
			sex_id.trigger('change');
			sex_id.val(updateSex);
		}
	}

	function getOption(data) {
		var attr = '';
		for (var i in data) if (i == 'value' || i.indexOf('data-') >= 0) attr += ' ' + i + '="' + data[i] + '"';
		return '<option' + attr + '>' + data.html + '</option>' + "\n";
	}
});
