<script language="javascript">
//<![CDATA[
window.onload = function func_init(){
	if(document.getElementById("playlistall_ins_target_client_0") !== null && document.getElementById("playlistall_ins_target_client_0").checked == true){
		func_change_target_client("0");
	} else if(document.getElementById("playlistall_ins_target_client_1") != null && document.getElementById("playlistall_ins_target_client_1").checked == true){
		func_change_target_client("1");
	}
};

function func_back() {
	var image_intvl = document.getElementById("playlistall_ins_image_intvl");
	if(image_intvl != null){
		image_intvl.required = false;
	}

	var input_disp = document.getElementById("disp");
	input_disp.value = "ins_seltmpl";

	var input_act = document.getElementById("act");
	input_act.value = "back";

	var frm_obj = document.getElementById("form");
	frm_obj.submit();
}

function func_back2() {
	var input_act = document.getElementById("act");
	input_act.value = "back";

	var frm_obj = document.getElementById("form");
	frm_obj.submit();
}

function func_change_target_client(param){
	if(param == "0"){
		document.getElementById("playlistall_ins_arr_client").disabled = true;
	} else if(param == "1"){
		document.getElementById("playlistall_ins_arr_client").disabled = false;
	}
};

function func_add(draw_area_id) {
	var arr_client = document.getElementById("playlistall_ins_arr_client");
	if(arr_client != null){
		arr_client.required = false;
	}

	var playlist_name = document.getElementById("playlistall_ins_playlist_name");
	if(playlist_name != null){
		playlist_name.required = false;
	}

	var image_intvl = document.getElementById("playlistall_ins_image_intvl");
	if(image_intvl != null){
		image_intvl.required = false;
	}

	var input_act = document.getElementById("act");
	input_act.value = "cts_add";

	var input_draw_area_id = document.createElement("input");
	input_draw_area_id.type = "hidden";
	input_draw_area_id.name = "draw_area_id";
	input_draw_area_id.value = draw_area_id;

	var frm_obj = document.getElementById("form");
	frm_obj.appendChild(input_draw_area_id);
	frm_obj.submit();
};

function func_del(draw_area_id, display_order) {
	var arr_client = document.getElementById("playlistall_ins_arr_client");
	if(arr_client != null){
		arr_client.required = false;
	}

	var playlist_name = document.getElementById("playlistall_ins_playlist_name");
	if(playlist_name != null){
		playlist_name.required = false;
	}

	var image_intvl = document.getElementById("playlistall_ins_image_intvl");
	if(image_intvl != null){
		image_intvl.required = false;
	}

	var input_act = document.getElementById("act");
	input_act.value = "cts_del";

	var input_draw_area_id = document.createElement("input");
	input_draw_area_id.type = "hidden";
	input_draw_area_id.name = "draw_area_id";
	input_draw_area_id.value = draw_area_id;

	var input_display_order = document.createElement("input");
	input_display_order.type = "hidden";
	input_display_order.name = "display_order";
	input_display_order.value = display_order;

	var frm_obj = document.getElementById("form");
	frm_obj.appendChild(input_draw_area_id);
	frm_obj.appendChild(input_display_order);
	frm_obj.submit();
};

/* Playlist setting DnD sort supported */
function initSortable(id){
    $(id).sortable({
        update: function(event, ui) {
            //Renumber the name of select and the onclick of delete button in the order after sorting
            var selectList = $(id + ' tr td select');
            var delBtnList = $(id + ' tr td button');
            for(var i=0; i < selectList.length ; i++){
                var replaceStr = selectList.eq(i).attr("name").replace(/\[[0-9]+\]$/,"["+i+"]");
                selectList.eq(i).attr("name",replaceStr);
                var btnReplaceStr = delBtnList.eq(i).attr("onclick").replace(/ [0-9]+\)$/," "+i+")");
                delBtnList.eq(i).attr("onclick",btnReplaceStr);
            }
        }
    });
	var userAgent = window.navigator.userAgent.toLowerCase();
	var userAgentArray = userAgent.split('/');
	if (userAgent.indexOf('firefox') != -1 && parseInt( userAgentArray[userAgentArray.length-1] ) >= 40 ) {
        //When Firefox is over version 40, event replacement is unnecessary, so return here
		return;
	}
    //Browser other than Firefox or Firefox ver.40 or less
	$(id).disableSelection().delegate('input,textarea,select','click',function(ev){
    	ev.target.focus();
    });
}
/* Playlist setting DnD sort supported */
$(function(){
    var sortableList = $('table tbody').filter(function(){
        return this.id.match(/sortable_[0-9]+/);
    });
    for(var i=0;i<sortableList.length;i++){
        initSortable('#'+sortableList[i].id);
    }
});

//]]>
</script>
