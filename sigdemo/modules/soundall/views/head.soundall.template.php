<script language="javascript">
function handleFiles(){
	var form = document.getElementById("soundall_ins_sound_file");
	var disp = document.getElementById("disp");
	var fileList = form.files;
	disp.innerHTML = "";
	for(var i=0; i<fileList.length; i++){
		disp.innerHTML += "Movie file :" + fileList[i].name + "<br />";
	}
}
</script>