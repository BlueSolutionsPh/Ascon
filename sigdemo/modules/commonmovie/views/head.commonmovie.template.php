<script language="javascript">
//<![CDATA[
function func_page_search(page){
	var frm_obj = document.getElementById("commonmovie_search_form");
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
		document.getElementById("commonmovie_lumpdel").disabled=false;
	}
}
function Off_BoxChecked(){
	for(var i=0; i<=arguments.length-1; i++) {
		document.getElementById("chk_"+arguments[i]).checked=false;
		document.getElementById("commonmovie_lumpdel").disabled=true;
	}
}
function check(){
	var chk_cnt=0;
	for(var i=0; i<=document.getElementsByName("chk_movie[]").length-1; i++) {
		if(document.getElementsByName("chk_movie[]")[i].checked==true){
			chk_cnt++;
		}
	}
	if(chk_cnt > 0){
		document.getElementById("commonmovie_lumpdel").disabled=false;
	}else{
		document.getElementById("commonmovie_lumpdel").disabled=true;
	}
}

function bulk_deletion(){
	var formobj = document.form_lump_del;
	var chk_cnt=0;
	for(var i=0; i<=document.getElementsByName("chk_movie[]").length-1; i++) {
		if(document.getElementsByName("chk_movie[]")[i].checked==true){
			//hidden�쐬
			createhidden('chk_movie[]', document.getElementsByName("chk_movie[]")[i].value, formobj);
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
//-->
</script>
