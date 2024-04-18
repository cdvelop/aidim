//*************** funcion backup bd server sql****************
var hoyser ="";
var hoyaidim ="";
window.setInterval(function() {
// obtener ultimo dia mes y año db server sql
$.get("lib/dtos.backup.php?backupms=1", function(nowser){
	hoyser = nowser;});
// $("#hoyser").html(hoyser);


// obtener ultimo dia mes y año db aidim mysql
$.get("lib/dtos.backup.php?backupms=2", function(nowaidim){
	hoyaidim = nowaidim;});
// $("#hoyaidim").html(hoyaidim);


 if (hoyser != hoyaidim) {//mes != realizamos backup db
  // var dia = hoyser.slice(0,2);
  // $("#dia").html(dia);
 
    $.get("lib/dtos.backup.php?backupms=3&dia="+hoyser+"&seg=5");
 }

}, 100000);

//*************** funcion backup bd server sql****************