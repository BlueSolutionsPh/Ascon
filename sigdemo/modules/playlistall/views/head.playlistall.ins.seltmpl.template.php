<script language="javascript">
//<![CDATA[
/* Switch display */
//Template switching
function antsChange(flag) {

	var value = $("#dev_ins_ants_version").val(); // value

    var obj = jQuery("#playlistall_ins_seltmpl_draw_tmpl_id").children();
    var idArray = ["landscape_all_image", "vertical_all_image", "vertical_all_movie", "divide_movie_image", "divide_image_image_telop", "divide_movie_image_telop", "vertical_image_telop", "divide_telop_image_movie", "vertical_telop_image", "divide_telop_image_image", "divide_image_movie"];

	if(value == "1"){
		// ants1 When selected
		if(flag == "true"){
			$("#playlistall_ins_seltmpl_draw_tmpl_id").val("");
		}
	    for( var i=0; i<obj.length; i++ ){
			// Horizontal full screen video
	    	if(obj.eq(i).val() != "5" && obj.eq(i).val() != ""){
	    		obj.eq(i).css("display", "none");
	        }
	    }

	    // Hide template
	    for( var i=0; i<idArray.length; i++ ){
		    if( $("#" + idArray[i])){
		    	$("#" + idArray[i]).css("display", "none");
			}
	    }

	}else if(value == "2"){
		// ants2 When selected
		if(flag == "true"){
			$("#playlistall_ins_seltmpl_draw_tmpl_id").val("");
		}
	    for( var i=0; i<obj.length; i++ ){
    		obj.eq(i).css("display", "");
	    }

	    // Template display
	    for( var i=0; i<idArray.length; i++ ){
		    if( $("#" + idArray[i])){
		    	$("#" + idArray[i]).css("display", "");
			}
	    }

	}
}
//]]>
</script>
