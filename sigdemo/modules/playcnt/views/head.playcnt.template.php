<script language="javascript">
//<![CDATA[
function func_page_search(page){
	var frm_obj = document.getElementById("playcnt_search_form");
	var input_page = document.createElement("input");
	input_page.type = "hidden";
	input_page.name = "page";
	input_page.value = page;
	frm_obj.appendChild(input_page);
	frm_obj.submit();
	return false;
}
//]]>
</script>