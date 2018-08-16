$(function(){
	var act = $('#act').val();
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
	$('.droplist td.drop-target').droppable({
		accept: 'tr.drag',
		over: function(e, ui) {
			$(this).addClass('dropover');
		},
		out: function(e, ui) {
			$(this).removeClass('dropover');
		},
		drop: function(e, ui) {
			$(this).removeClass('dropover blank');
			var dragNode = ui.draggable;
			var dropNode = $(e.target);
			dropNode.data('id', dragNode.find('td.data').data('id') + '_' + dropNode.parent().find('td').first().html());
			dropNode.find('span.value').html(dragNode.find('span.value').html());
			if (!dropNode.find('span.close')[0]) dropNode.append('<span class="close">×</span>');
		},
	})

	// close up
	$(document).on('click', '.droplist span.close', function() {
		$(this).parents('td').addClass('blank').data('id', '').find('span.value').html('');
		$(this).remove();
	});

	// Search
	$(document).on('click', '#playlist_' + act + '_search', function() {
		$('#act').val('cts_search');
		for (var i = 0; i < 2; i++) {
			for(var y = 1; y < 4; y++) {
				var tmp_arr_movie = '';
				$('.drop-target[data-name="' + i + y + '"').each(function() {
					tmp_arr_movie += '<option value="' + $(this).data('id') + '" selected>' + $(this).find('span.value') + '</option>';
				});
				$('#playlist_' + act + '_arr_movie'+ i + y).append(tmp_arr_movie);
			}
		}
		$('#form').submit();
	});

	// Replication
	$(document).on('click', '#commonplaylist_' + act + '_setting', function() {
		$('#act').val('cts_setting');
		$('<input>')
			.attr('type', 'hidden')
			.attr('name', 'cp_playlist_id')
			.val($('#playlist_' + act + '_cp_playlist_id').val())
			.appendTo('#form');
		$('#form').submit();
	});

	// Registration
	$(document).on('click', '#playlist_' + act + '_submit', function() {
		$('#act').val('conf');
		var append = '';
		$('.droplist td.drop-target').each(function() {
			if ($(this).data('id')) {
				append += '<input type="hidden" name="arr_movie' + $(this).data('name') + '[]" value="' + $(this).data('id') + '">' + "\n";
			}
		});
		$('#form').append(append).submit();
	});

	// Return
	$(document).on('click', '#playlist_' + act + '_back', function() {
		$('#disp').val(act + '_seltmpl');
		$('#act').val('back');
		$('#form').submit();
	});

	// Back (confirmation screen)
	$(document).on('click', '#playlist_' + act + '_conf_back', function() {
		$('#act').val('back');
		$('#form').submit();
	});

	// Invalid submit by return key
	$(document).on("keypress", "input:not(.allow_submit)", function(event) {
		return event.which !== 13;
	});

	// Sort playlist numbers
	function sortPlayListNum() {
		var cnt = 1;
		$('.droplist table tbody tr').each(function() {
			$(this).removeClass('odd even').addClass((cnt % 2) ? 'odd' : 'even')
			$(this).find('td').first().html(cnt++);
		});
		// $('#movie_count').html($('.droplist table tbody tr').not('.ui-sortable-placeholder').length + ' / ' + max);
	}
});
