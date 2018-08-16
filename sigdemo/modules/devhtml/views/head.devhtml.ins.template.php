<script language="javascript">
//<![CDATA[
function func_search(){
	var param = {shop_name:$("#devhtml_ins_shop_name").val(), dev_name:$("#devhtml_ins_dev_name").val(), dev_tag_1:$("#devhtml_ins_dev_tag").val()};
	$.ajax({
		type: "POST",
		url: "<?php echo(URL::base() . "util/search/dev/") ?>",
		async: false,
		data: param,
		success: func_search_res
	});
}

function func_search_res(xml){
	$("#devhtml_ins_arr_search_dev").empty();
	var tmp_arr_dev = new Array();
	$(xml).find("dev").each(function(){
		tmp_arr_dev.push('<option value="' + $(this).find("dev_id").text() + '">' + $(this).find("dev_name").text() + '</option>');
	});
	$("#devhtml_ins_arr_search_dev").append(tmp_arr_dev.join());
}

function func_ins(){
	$("#act").val("conf");
	var tmp_arr_dev = new Array();
	$("#devhtml_ins_tmp_arr_dev").children().each(function(){
		tmp_arr_dev.push('<option value="' + $(this).val() + '" selected>' + $(this).text() + '</option>');
	});
	$("#devhtml_ins_arr_dev").append(tmp_arr_dev.join());
}

function func_add(){
	var tmp_arr_dev = new Array();
	$("#devhtml_ins_arr_search_dev").children(":selected").each(function(){
		var id = $(this).val();
		var text = $(this).text();
		var exists = false;
		$("#devhtml_ins_tmp_arr_dev").children().each(function(){
			if(id == $(this).val()){
				exists = true;
				return false;
			}
		});
		if(exists == false){
			tmp_arr_dev.push('<option value="' + id + '">' + text + '</option>');
		}
	});
	$("#devhtml_ins_tmp_arr_dev").append(tmp_arr_dev.join());
}

function func_del(){
	$("#devhtml_ins_tmp_arr_dev").children(":selected").each(function(){
		$(this).remove();
	});
}
//]]>
</script>