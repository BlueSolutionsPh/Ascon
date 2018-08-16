<?php echo Html::style("css/popup_help.css", array('media'=>'screen, projection'), FALSE),"\n" ?>
<?php echo Html::script("js/jquery/jquery.popup_help.js"),"\n" ?>

<script language="javascript">
//<![CDATA[
window.onload = function func_init(){
	func_change_dow();
};

function func_change_dow(){
	for(i = 0; i < $("th[id^='th_dow']").length; i++){
		if($("th[id^='th_dow[" + i + "]']").children("input[type='radio']:checked").length == 0){
			$("select[name^='base[" + i + "]']").attr("disabled", true);
			$("select[name^='sta_time_h[" + i + "]']").attr("disabled", true);
			$("select[name^='sta_time_m[" + i + "]']").attr("disabled", true);
			$("select[name^='end_time_h[" + i + "]']").attr("disabled", true);
			$("select[name^='end_time_m[" + i + "]']").attr("disabled", true);
			$("select[name^='playlist[" + i + "]']").attr("disabled", true);
			$("select[name^='base[" + i + "]']").val("");
			$("select[name^='sta_time_h[" + i + "]']").val("");
			$("select[name^='sta_time_m[" + i + "]']").val("");
			$("select[name^='end_time_h[" + i + "]']").val("");
			$("select[name^='end_time_m[" + i + "]']").val("");
			$("select[name^='playlist[" + i + "]']").val("");
		} else {
			$("select[name^='base[" + i + "]']").attr("disabled", false);
			$("select[name^='sta_time_h[" + i + "]']").attr("disabled", false);
			$("select[name^='sta_time_m[" + i + "]']").attr("disabled", false);
			$("select[name^='end_time_h[" + i + "]']").attr("disabled", false);
			$("select[name^='end_time_m[" + i + "]']").attr("disabled", false);
			$("select[name^='playlist[" + i + "]']").attr("disabled", false);
		}
	}
};

function func_search($reset_flag){
	var param = {ants_version:$("#dev_ins_ants_version").val(), shop_name:$("#progrgl_ins_shop_name").val(), dev_name:$("#progrgl_ins_dev_name").val(), note:$("#progrgl_ins_note").val(), dev_tag_1:$("#progrgl_ins_dev_tag").val()};
	$.ajax({
		type: "POST",
		url: "<?php echo(URL::base() . "util/search/dev/") ?>",
		async: false,
		data: param,
		success: func_search_res
	});
}

function func_search_res(xml){
	$("#progrgl_ins_arr_search_dev").empty();
	var tmp_arr_dev = new Array();
	$(xml).find("dev").each(function(){
		tmp_arr_dev.push('<option value="' + $(this).find("dev_id").text() + '">' + $(this).find("dev_name").text() + '</option>');
	});
	$("#progrgl_ins_arr_search_dev").append(tmp_arr_dev.join());
}

function func_reset(reset_flag,ants_version,max_playlist,max_dow,playlist_ants_version){
	if(reset_flag == "true"){
		if(ants_version != ""){
			//Set the initial value when updating
	 		$("#dev_ins_ants_version").val(ants_version);
		}
	} else if(reset_flag == "false"){
		//If you do not want to delete the search condition at the time of updating, if you clear the search condition here, it will be cleared only when the type is changed

	}
	//検索条件クリア
	$("#progrgl_ins_shop_name").val("");
	$("#progrgl_ins_dev_name").val("");
	$("#progrgl_ins_note").val("");
	$("#progrgl_ins_dev_tag").val("");

	//Initial type valid / invalid setting
	if($("#progrgl_ins_tmp_arr_dev").find("option").length != 0)
	{
		//When adding from 0 selection, fix the ant's type
		$("#dev_ins_ants_version").prop("disabled", true);
	} else {
		//When adding from 0 selection, fix the ant's type
		$("#dev_ins_ants_version").prop("disabled", false);
	}
	//Update terminal information
	func_search();

	//Change contents of playlist
 	func_playlist_update(max_playlist,max_dow,playlist_ants_version);
}

function func_playlist_update(max_playlist,max_dow,playlist_ants_version){
	for($i = 0; $i < max_dow; $i++){
		var obj_base = jQuery("#progrgl_ins_base_" + $i).children();
		if($("#dev_ins_ants_version").val() == "1"){
		    for( var k=0; k<obj_base.length; k++ ){
				// Horizontal full screen video
		    	if(playlist_ants_version[obj_base.eq(k).val()] != "1" && playlist_ants_version[obj_base.eq(k).val()] != ""){
		    		obj_base.eq(k).css("display", "none");
		        }else{
		        	obj_base.eq(k).css("display", "");
		        }
		    }
		} else {
		    for( var k=0; k<obj_base.length; k++ ){
				// Horizontal full screen video
		    	if(playlist_ants_version[obj_base.eq(k).val()] != "2" && playlist_ants_version[obj_base.eq(k).val()] != ""){
		    		obj_base.eq(k).css("display", "none");
		        }else{
		        	obj_base.eq(k).css("display", "");
		        }
		    }
		}

		for($j = 0; $j < max_playlist; $j++){
			var obj = jQuery("#progrgl_ins_playlist_" + $i + "_" + $j).children();
			if($("#dev_ins_ants_version").val() == "1"){
			    for( var k=0; k<obj.length; k++ ){
					// Horizontal full screen video
			    	if(playlist_ants_version[obj.eq(k).val()] != "1" && playlist_ants_version[obj.eq(k).val()] != ""){
			    		obj.eq(k).css("display", "none");
			        }else{
			        	obj.eq(k).css("display", "");
			        }
			    }
			} else {
			    for( var k=0; k<obj.length; k++ ){
					// Horizontal full screen video
			    	if(playlist_ants_version[obj.eq(k).val()] != "2" && playlist_ants_version[obj.eq(k).val()] != ""){
			    		obj.eq(k).css("display", "none");
			        }else{
			        	obj.eq(k).css("display", "");
			        }
			    }
			}
		}
	}
	//Clear content
	func_playlist_clear(max_playlist,max_dow,playlist_ants_version);
}

function func_playlist_clear(max_playlist,max_dow,playlist_ants_version){
	for($i = 0; $i < max_dow; $i++){
		$("#progrgl_ins_base_" + $i).val("");
		for($j = 0; $j < max_playlist; $j++){
			$("#progrgl_ins_playlist_" + $i + "_" + $j).val("");
		}
	}
}

function func_ins(){
	$("#act").val("conf");
	var tmp_arr_dev = new Array();
	$("#progrgl_ins_tmp_arr_dev").children().each(function(){
		tmp_arr_dev.push('<option value="' + $(this).val() + '" selected>' + $(this).text() + '</option>');
	});
	$("#progrgl_ins_arr_dev").append(tmp_arr_dev.join());
}

function func_ins(){
	$("#act").val("conf");
	var tmp_arr_dev = new Array();
	$("#progrgl_ins_tmp_arr_dev").children().each(function(){
		tmp_arr_dev.push('<option value="' + $(this).val() + '" selected>' + $(this).text() + '</option>');
	});
	$("#progrgl_ins_arr_dev").append(tmp_arr_dev.join());
}

function func_add(){
	var tmp_arr_dev = new Array();
	$("#progrgl_ins_arr_search_dev").children(":selected").each(function(){
		var id = $(this).val();
		var text = $(this).text();
		var exists = false;
		$("#progrgl_ins_tmp_arr_dev").children().each(function(){
			if(id == $(this).val()){
				exists = true;
				return false;
			}
		});
		if(exists == false){
			tmp_arr_dev.push('<option value="' + id + '">' + text + '</option>');
		}
	});
	$("#progrgl_ins_tmp_arr_dev").append(tmp_arr_dev.join());
	if($("#progrgl_ins_tmp_arr_dev").find("option").length != 0)
	{
		//When adding from 0 selection, fix the ant's type
		$("#dev_ins_ants_version").prop("disabled", true);
	}
	func_refresh_dev_count();

}

function func_del(){
	$("#progrgl_ins_tmp_arr_dev").children(":selected").each(function(){
		$(this).remove();
	});
	func_refresh_dev_count();
	if($("#progrgl_ins_tmp_arr_dev").find("option").length == 0)
	{
		//When selecting 0 units, unfix ant's type
		$("#dev_ins_ants_version").prop("disabled", false);
	}

}

function func_refresh_dev_count(){
	$("#dev_count").empty().append($("#progrgl_ins_tmp_arr_dev").find("option").length).append(" 台");
}

$(function(){
	func_refresh_dev_count();
});

$(function() {
    // ?Mouse over the mark to display a help message.
    $("span.popup_help").popupHelp();
});
//]]>
</script>
