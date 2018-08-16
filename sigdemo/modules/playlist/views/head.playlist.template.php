<script language="javascript">
//<![CDATA[
function func_page_search(page){
	var frm_obj = document.getElementById("playlist_search_form");
	var input_page = document.createElement("input");
	input_page.type = "hidden";
	input_page.name = "page";
	input_page.value = page;
	frm_obj.appendChild(input_page);
	frm_obj.submit();
	return false;
}

//]]>
<!--
function On_BoxChecked(){
	for(var i=0; i<=arguments.length-1; i++) {
		document.getElementById("chk_"+arguments[i]).checked=true;
		document.getElementById("playlist_lumpdel").disabled=false;
	}
}
function Off_BoxChecked(){
	for(var i=0; i<=arguments.length-1; i++) {
		document.getElementById("chk_"+arguments[i]).checked=false;
		document.getElementById("playlist_lumpdel").disabled=true;
	}
}

function check(){
	var chk_cnt=0;
	//for(var i=0; i<=document.all.item("hoge[]").length-1; i++) {
	for(var i=0; i<=document.getElementsByName("hoge[]").length-1; i++) {
		//if(document.all.item("hoge[]")[i].checked==true){
		if(document.getElementsByName("hoge[]")[i].checked==true){
			chk_cnt++;
		}
	}
	if(chk_cnt > 0){
		document.getElementById("playlist_lumpdel").disabled=false;
	}else{
		document.getElementById("playlist_lumpdel").disabled=true;
	}
}
function bulk_deletion(){
	var formobj = document.form_lump_del;
	var chk_cnt=0;
	//for(var i=0; i<=document.all.item("hoge[]").length-1; i++) {
	for(var i=0; i<=document.getElementsByName("hoge[]").length-1; i++) {
		//if(document.all.item("hoge[]")[i].checked==true){
		if(document.getElementsByName("hoge[]")[i].checked==true){
			//hidden作成
			//createhidden('hoge[]', document.all.item("hoge[]")[i].value, formobj);
			createhidden('hoge[]', document.getElementsByName("hoge[]")[i].value, formobj);
		}
	}
	document.form_lump_del.submit(); 
}
function createhidden( name, value, form ){
	var elm = document.createElement('input');
	elm.type = 'hidden';
	elm.name = name;
	elm.value = value;
	form.appendChild(elm);
}
function hideContentsList(){
	$("div.movie").hide();
	$("div.sound").hide();
	$("div.image").hide();
	$("div.telop").hide();
	$("input.toggle").val("表示");
}
function showContentsList(){
	$("div.movie").fadeIn("normal");
	$("div.sound").fadeIn("normal");
	$("div.image").fadeIn("normal");
	$("div.telop").fadeIn("normal");
	$("input.toggle").val("非表示");
}
function hideContents(thisObj){
	$(thisObj).parent().parent().find("div.movie").hide();
	$(thisObj).parent().parent().find("div.sound").hide();
	$(thisObj).parent().parent().find("div.image").hide();
	$(thisObj).parent().parent().find("div.telop").hide();
}
function showContents(thisObj){
	$(thisObj).parent().parent().find("div.movie").fadeIn("normal");
	$(thisObj).parent().parent().find("div.sound").fadeIn("normal");
	$(thisObj).parent().parent().find("div.image").fadeIn("normal");
	$(thisObj).parent().parent().find("div.telop").fadeIn("normal");
}
function toggleContents(thisObj){
	if( $(thisObj).val() == "表示" ){
		showContents(thisObj);
		$(thisObj).val("非表示");
	}else{
		hideContents(thisObj);
		$(thisObj).val("表示");
	}
}
$(function(){
	$("input.toggle").live("click", function(){toggleContents(this);} );
});
//-->
</script>