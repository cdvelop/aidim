<?php

$i = 0;
exec('ipconfig /all', $response);
foreach($response as $line) {
  
  $line = $line;
  
  if (strpos($line, "DNS")>0) {
    print (trim($line));
    echo ("\n");
    }
}
// A simple function to see if exec() is enabled on the server:


function exec_enabled() {
  $disabled = explode(', ', ini_get('disable_functions'));
  return !in_array('exec', $disabled);
}


echo exec_enabled();
    // shell_exec("notepad.exe");
    echo "test sms";
    // print exec("calc.exe");


    // $qq=system('calc.exe',$error);
	// echo "$qq::$error"; 
     // $rutasms = "C:/AppServ/\www/tesis/grafic/lib/sms/AutoIt3_x64.exe";
  $rutasms = "calc.exe -i 1 ";
		// $salida = shell_exec($rutasms);
		// echo "<pre>$salida</pre>";


		 exec($rutasms);
		

// function callTool ($path,$file) {

// chdir($path); $call = $path.$file;
// pclose(popen('start /b '.$call.'', 'r'));

// }

// -- Ejecuto la llamada ----- $location = "c:\el\directorio\que\necesitas"; $filename = "tuaplicacion.exe"; echo $location . $filename; callTool($location,$filename);

// $location = "C:\AppServ\www\tesis\grafic\lib\sms"; 
// $filename = "AutoIt3_x64"; 
// echo $location . $filename; callTool($location,$filename);


// -- Ejecuto la llamada 2----- $location = "c:\el\directorio\que\necesitas"; $filename = "tuaplicacion.bat"; echo $location . $filename; callTool($location,$filename);

// Esto lo consegui en las respuestas de php.net en base al exec luego de algunas paginas visitadas... espero esto le sirva de ayuda a alguien...



?>



