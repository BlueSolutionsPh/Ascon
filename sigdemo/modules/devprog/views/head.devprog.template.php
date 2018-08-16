<script language="javascript">
//<![CDATA[
function func_page_search(page){
	var frm_obj = document.getElementById("devprog_search_form");
	var input_page = document.createElement("input");
	input_page.type = "hidden";
	input_page.name = "page";
	input_page.value = page;
	frm_obj.appendChild(input_page);
	frm_obj.submit();
	return false;
}
$(function() {
	// Click number of booths, number of terminals
	$(document).on('click', 'a[id^=devprog_devprogview_]', function() {
		if ( ($(this).data('sex_id') !== "") && ($(this).data('client_id') !== "") && ($(this).data('timezone_id')!== "") ) {
			// Discriminate whether they are individual or common, and separate parameters according to each
			if (parseInt($(this).attr('id').split('_')[2].slice(-1))) {
				// In case of individual
				var param = {'client_id': $(this).data('client_id')};
			} else {
				// Common case
				var param = {'sex_id': $(this).data('sex_id'), 'timezone_id': $(this).data('timezone_id')};
			}
			sendPost($(this).attr('href'), param);

			return false;
		}
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
//]]>
</script>
