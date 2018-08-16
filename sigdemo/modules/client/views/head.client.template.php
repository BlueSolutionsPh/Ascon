<script language="javascript">
//<![CDATA[
function func_page_search(page){
	var frm_obj = document.getElementById("client_search_form");
	var input_page = document.createElement("input");
	input_page.type = "hidden";
	input_page.name = "page";
	input_page.value = page;
	frm_obj.appendChild(input_page);
	frm_obj.submit();
	return false;
}
$(function() {
	// Click number of facilities, number of booths, number of terminals
	$(document).on('click', 'a[id^=client_shop_], a[id^=client_booth_], a[id^=client_dev_]', function() {
		sendPost($(this).attr('href'), {
			'client_id': $(this).attr('id').split('_').pop()
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
});
//]]>})
</script>
