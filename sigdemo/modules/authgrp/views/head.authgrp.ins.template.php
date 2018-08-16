<script language="javascript">
//<![CDATA[
function func_chk_all_btn(btn){
	var all_checked = true;
	$(btn).parent().parent().children("div").children("div").children("div").children("[type=checkbox]").each(function(){
		if($(this).attr("checked") != "checked"){
			all_checked = false;
		}
	});
	if(all_checked){
		$(btn).parent().parent().children("div").children("div").children("div").children("[type=checkbox]").each(function(){
			$(this).attr("checked", false);
		});
	} else {
		$(btn).parent().parent().children("div").children("div").children("div").children("[type=checkbox]").each(function(){
			$(this).attr("checked", true);
		});
	}
};
function func_chk_cat_btn(btn){
	var all_checked = true;
	$(btn).parent().parent().children("div").children("div").children("[type=checkbox]").each(function(){
		if($(this).attr("checked") != "checked"){
			all_checked = false;
		}
	});
	if(all_checked){
		$(btn).parent().parent().children("div").children("div").children("[type=checkbox]").each(function(){
			$(this).attr("checked", false);
		});
	} else {
		$(btn).parent().parent().children("div").children("div").children("[type=checkbox]").each(function(){
			$(this).attr("checked", true);
		});
	}
};

function func_chk_btn(btn){
	var all_checked = true;
	$(btn).parent().parent().children("div").children("[type=checkbox]").each(function(){
		if($(this).attr("checked") != "checked"){
			all_checked = false;
		}
	});
	if(all_checked){
		$(btn).parent().parent().children("div").children("[type=checkbox]").each(function(){
			$(this).attr("checked", false);
		});
	} else {
		$(btn).parent().parent().children("div").children("[type=checkbox]").each(function(){
			$(this).attr("checked", true);
		});
	}
};
//]]>
</script>