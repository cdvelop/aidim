#include <IE.au3>
#include <MsgBoxConstants.au3>

$fono = $CMDLINE[1]
$sms = $CMDLINE[2]

Local $oIE = _IECreate("http://192.168.8.1/html/smsinbox.html", 1)

If @extended Then
    ;MsgBox($MB_SYSTEMMODAL, "", "Attached to Existing Browser")

   _IEQuit($oIE)

Else
	   ;MsgBox($MB_SYSTEMMODAL, "", "Created New Browser")



   Local $sMyString = "SMS"
   Local $oLinks = _IELinkGetCollection($oIE)
   For $oLink In $oLinks
	   Local $sLinkText = _IEPropertyGet($oLink, "innerText")
	   If StringInStr($sLinkText, $sMyString) Then
		   _IEAction($oLink, "click")
		   ExitLoop
	   EndIf
	Next


   Send("admin")
   Send("{TAB 1}")
   Send("octubre23")
   Send("{ENTER 1}")
   Sleep(5000)

	  $oBtn = _IEGetObjById($oIE, "message")
	  _IEAction($oBtn, "Click")

   ;ClipPut("+56995109636")
   ClipPut($fono)



   Send("{CTRLDOWN}v{CTRLUP}")
   Send("{TAB 1}")
   Send($sms)

   $oBtn = _IEGetObjById($oIE, "pop_send");
   ;_IEAction($oBtn, "Click");

   Sleep(5000)
   _IEQuit($oIE)


EndIf










