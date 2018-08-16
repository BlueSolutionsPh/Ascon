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
	var frm_obj = document.getElementById("form");
	if($("#progview_sta_time_h").size() > 0){
		var input_sta_time_h = document.createElement("input");
		input_sta_time_h.type = "hidden";
		input_sta_time_h.name = "sta_time_h";
		input_sta_time_h.value = document.getElementById("progview_sta_time_h").value;
		frm_obj.appendChild(input_sta_time_h);
		
		var input_sta_time_m = document.createElement("input");
		input_sta_time_m.type = "hidden";
		input_sta_time_m.name = "sta_time_m";
		input_sta_time_m.value = document.getElementById("progview_sta_time_m").value;
		frm_obj.appendChild(input_sta_time_m);
		
		var input_end_time_h = document.createElement("input");
		input_end_time_h.type = "hidden";
		input_end_time_h.name = "end_time_h";
		input_end_time_h.value = document.getElementById("progview_end_time_h").value;
		frm_obj.appendChild(input_end_time_h);

		var input_end_time_m = document.createElement("input");
		input_end_time_m.type = "hidden";
		input_end_time_m.name = "end_time_m";
		input_end_time_m.value = document.getElementById("progview_end_time_m").value;
		frm_obj.appendChild(input_end_time_m);
	} else {
		var input_sta_dt = document.createElement("input");
		input_sta_dt.type = "hidden";
		input_sta_dt.name = "sta_dt";
		input_sta_dt.value = document.getElementById("progview_sta_dt").value;
		frm_obj.appendChild(input_sta_dt);
		
		var input_end_dt = document.createElement("input");
		input_end_dt.type = "hidden";
		input_end_dt.name = "end_dt";
		input_end_dt.value = document.getElementById("progview_end_dt").value;
		frm_obj.appendChild(input_end_dt);
	}
	
	var input_ch_1 = document.createElement("input");
	input_ch_1.type = "hidden";
	input_ch_1.name = "ch_1";
	input_ch_1.value = document.getElementById("progview_ch_1").value;
	frm_obj.appendChild(input_ch_1);
	
	var input_prog_name = document.createElement("input");
	input_prog_name.type = "hidden";
	input_prog_name.name = "prog_name";
	input_prog_name.value = document.getElementById("progview_prog_name").value;
	frm_obj.appendChild(input_prog_name);
	
	frm_obj.submit();

	return false;
};
//]]>
</script>