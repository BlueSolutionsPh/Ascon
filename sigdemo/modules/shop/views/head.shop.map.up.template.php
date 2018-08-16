<?php echo Html::style("css/popup_help.css", array('media'=>'screen, projection'), FALSE),"\n" ?>
<?php echo Html::script("js/jquery/jquery.popup_help.js"),"\n" ?>
<script language="javascript">
//<![CDATA[
function func_page_search(page){
	var frm_obj = document.getElementById("shop_search_form");
	var input_page = document.createElement("input");
	input_page.type = "hidden";
	input_page.name = "page";
	input_page.value = page;
	frm_obj.appendChild(input_page);
	frm_obj.submit();
	return false;
}
$(function() {
    // Mouse over the? Mark to display a help message.
    $("span.popup_help").popupHelp();
});
//]]>
</script>
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyCBSJR94TRY5X0T7G6Rg2p_VY5oOqNZyWk"></script>
<script src="js/map.js"></script>
<script src="js/shop.up.js"></script>
