<?php echo Html::style("css/popup_help.css", array('media'=>'screen, projection'), FALSE),"\n" ?>
<?php echo Html::script("js/jquery/jquery.popup_help.js"),"\n" ?>

<script language="javascript">
//<![CDATA[
function func_search(){
	var param = {ants_version:$("#dev_ins_ants_version").val(), shop_name:$("#prog_ins_shop_name").val(), dev_name:$("#prog_ins_dev_name").val(), note:$("#prog_ins_note").val(), dev_tag_1:$("#prog_ins_dev_tag").val()};
	$.ajax({
		type: "POST",
		url: "<?php echo(URL::base() . "util/search/dev/") ?>",
		async: false,
		data: param,
		success: func_search_res
	});
}

function func_search_res(xml){
	$("#prog_ins_arr_search_dev").empty();
	var tmp_arr_dev = new Array();
	$(xml).find("dev").each(function(){
		tmp_arr_dev.push('<option value="' + $(this).find("dev_id").text() + '">' + $(this).find("dev_name").text() + '</option>');
	});
	$("#prog_ins_arr_search_dev").append(tmp_arr_dev.join());
}

function func_reset(reset_flag,ants_version,playlist_ants_version){
	if(reset_flag == "true"){
		if(ants_version != ""){
			//Set the initial value when updating
	 		$("#dev_ins_ants_version").val(ants_version);
		}
	} else if(reset_flag == "false"){
		//If you do not want to delete the search condition at the time of updating, if you clear the search condition here, it will be cleared only when the type is changed

	}
	//Clear search condition
	$("#prog_ins_shop_name").val("");
	$("#prog_ins_dev_name").val("");
	$("#prog_ins_note").val("");
	$("#prog_ins_dev_tag").val("");

	//Keep Ant's type temporarily
	$("#dev_ins_ants_version_tmp").val($("#dev_ins_ants_version").val());

	//Initial type valid / invalid setting
	if($("#prog_ins_tmp_arr_dev").find("option").length != 0)
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
 	func_playlist_update(playlist_ants_version);
}

function func_playlist_update(playlist_ants_version){
	var obj = jQuery("#prog_ins_ch_1").children();
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
	//Clear content
	func_playlist_clear();
}

function func_playlist_clear(){
	$("#prog_ins_ch_1").val("");
}

function func_ins(){
	$("#act").val("conf");
	var tmp_arr_dev = new Array();
	$("#prog_ins_tmp_arr_dev").children().each(function(){
		tmp_arr_dev.push('<option value="' + $(this).val() + '" selected>' + $(this).text() + '</option>');
	});
	$("#prog_ins_arr_dev").append(tmp_arr_dev.join());
}

function func_add(){
	var tmp_arr_dev = new Array();
	$("#prog_ins_arr_search_dev").children(":selected").each(function(){
		var id = $(this).val();
		var text = $(this).text();
		var exists = false;
		$("#prog_ins_tmp_arr_dev").children().each(function(){
			if(id == $(this).val()){
				exists = true;
				return false;
			}
		});
		if(exists == false){
			tmp_arr_dev.push('<option value="' + id + '">' + text + '</option>');
		}
	});
	$("#prog_ins_tmp_arr_dev").append(tmp_arr_dev.join());
	if($("#prog_ins_tmp_arr_dev").find("option").length != 0)
	{
		//When adding from 0 selection, fix the ant's type
		$("#dev_ins_ants_version").prop("disabled", true);
	}
	func_refresh_dev_count();
}

function func_del(){
	$("#prog_ins_tmp_arr_dev").children(":selected").each(function(){
		$(this).remove();
	});
	func_refresh_dev_count();
	if($("#prog_ins_tmp_arr_dev").find("option").length == 0)
	{
		//When selecting 0 units, unfix ant's type
		$("#dev_ins_ants_version").prop("disabled", false);
	}
}

function func_refresh_dev_count(){
	$("#dev_count").empty().append($("#prog_ins_tmp_arr_dev").find("option").length).append(" 台");
}

$(function(){
	func_refresh_dev_count();
});

$(function() {
    // Mouse over the? Mark to display a help message.
    $("span.popup_help").popupHelp();
});

//]]>
</script>
