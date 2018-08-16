<script language="javascript">
//<![CDATA[
$(function(){
	$("tr").hover(function(){
		$("[class='" + $(this).attr("class") + "']").addClass("hover");
	},function(){
		$("[class='" + $(this).attr("class") + "']").removeClass("hover");
	});
});

function func_up() {
	var input_sta_dt = document.createElement("input");
	input_sta_dt.type = "hidden";
	input_sta_dt.name = "sta_dt";
	input_sta_dt.value = document.getElementById("devhtmlview_sta_dt").value;

	var input_end_dt = document.createElement("input");
	input_end_dt.type = "hidden";
	input_end_dt.name = "end_dt";
	input_end_dt.value = document.getElementById("devhtmlview_end_dt").value;

	var input_html = document.createElement("input");
	input_html.type = "hidden";
	input_html.name = "html";
	input_html.value = document.getElementById("devhtmlview_html").value;

	var frm_obj = document.getElementById("form");
	frm_obj.appendChild(input_sta_dt);
	frm_obj.appendChild(input_end_dt);
	frm_obj.appendChild(input_html);
	frm_obj.submit();

	return false;
};
//]]>
</script>
