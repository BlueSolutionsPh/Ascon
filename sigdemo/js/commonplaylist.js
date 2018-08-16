$(function() {
	var act = $('#act').val();
	var max = $('input[name="max_playlist"]').val();
	FixedMidashi.create();

	// Dragging a video title
	$('.draglist tr.drag').draggable({
		helper: 'clone',
		connectToSortable: '.droplist table tbody',
		start: function(e, ui) {
			setTimeout(function() {
				$('.ui-draggable-dragging').width($(this).width());
			}.bind(this));
		},
	});

	// Drop playlist
	$('.droplist').droppable({
		accept: 'tr.drag',
		drop: function(e, ui) {
			var dragNode = $(this).find('tr.drag:not(".ui-sortable-placeholder")');
			var exist = !!dragNode.length;

			if (!exist) {
				dragNode = ui.helper.clone();
				dragNode.css({position: '', left: '', top: '', width: '', height: ''})
			}
			dragNode.removeClass('odd even drag');
			dragNode.find('td').eq(3).remove();
			dragNode.find('td').eq(2).remove();
			dragNode.find('td').eq(1).append('<span class="close">×</span>');

			if (exist) {
				setTimeout(function() {
					if ($(this).find('tbody tr').length - 1 >= max) dragNode.remove();
					sortPlayListNum();
				}.bind(this));
			} else {
				$(this).find('tbody').append(dragNode);
				sortPlayListNum();
			}
		},
	})
	$('.droplist table tbody').sortable({
		stop: sortPlayListNum,
		start: function() {
			setTimeout(function() {
				var helper = $('.ui-sortable-helper:not(.ui-draggable-dragging) td');
				if (helper[0]) {
					$('.droplist table thead th').each(function(key) { helper.eq(key).outerWidth($(this).outerWidth()); });
				}
			}.bind(this));
		},
		// Adjust scrolling when sorting
		change: function() {
			var sortNode = $(this).find('tr.ui-sortable-placeholder'),
				list  = $('.droplist'),
				noH   = sortNode.height(),
				poTop = sortNode.position().top,
				scTop = list.scrollTop();
			// When scrolling up or down while dragging an element
			if (poTop + noH - scTop >= list.height()) {
				// Scroll down by two tr elements
				var he = parseInt(((poTop + noH - list.height() + 1) / noH) + 2) * noH;
				list.animate({scrollTop: scTop + he}, 100);
			} else if (poTop - scTop <= noH) {
				// Scroll up two tr elements
				var he = parseInt(((poTop - scTop) / noH) - 2) * noH;
				list.animate({scrollTop: scTop + he}, 100);
			}
		},
	});

	// close up
	$(document).on('click', '.droplist span.close', function() {
		$(this).parents('tr').remove();
		sortPlayListNum();
	});

	// Search
	$(document).on('click', '#commonplaylist_' + act + '_search', function() {
		$('#act').val('cts_search');
		$('#commonplaylist_' + act + '_arr_movie').append(getTmpArrMovie());
		$('#form').submit();
	});

	// Replication
	$(document).on('click', '#commonplaylist_' + act + '_setting', function() {
		$('#act').val('cts_setting');
		$('<input>')
			.attr('type', 'hidden')
			.attr('name', 'cp_playlist_id')
			.val($('#commonplaylist_' + act + '_cp_playlist_id').val())
			.appendTo('#form');
		$('#form').submit();
	});

	// Registration
	$(document).on('click', '#commonplaylist_' + act + '_submit', function() {
		$('#act').val('conf');
		$('#commonplaylist_' + act + '_arr_movie').append(getTmpArrMovie());
		$('#form').submit();
	});

	// Return
	$(document).on('click', '#commonplaylist_' + act + '_back', function() {
		$('#disp').val(act + '_seltmpl');
		$('#act').val('back');
		$('#form').submit();
	});

	// Back (confirmation screen)
	$(document).on('click', '#commonplaylist_' + act + '_conf_back', function() {
		$('#act').val('back');
		$('#form').submit();
	});

	// Invalid submit by return key
	$(document).on("keypress", "input:not(.allow_submit)", function(event) {
		return event.which !== 13;
	});

	var bury = false;
	// Embed playlist data in hidden
	function getTmpArrMovie() {
		if (bury) return '';
		bury = true;
		var tmp_arr_movie = '';
		$('.droplist tbody tr').not('.ui-sortable-placeholder').each(function(){
			tmp_arr_movie += '<option value="' + $(this).find('td').eq(1).data('id') + '" selected>' + $(this).find('span.value').html() + '</option>' + '\n';
		});
		return tmp_arr_movie;
	}
	// Sort playlist numbers
	function sortPlayListNum() {
		var cnt = 1;
		$('.droplist table tbody tr').each(function() {
			$(this).removeClass('odd even').addClass((cnt % 2) ? 'odd' : 'even')
			$(this).find('td').first().html(cnt++);
		});
		$('#movie_count').html($('.droplist table tbody tr').not('.ui-sortable-placeholder').length + ' / ' + max);
	}
});
