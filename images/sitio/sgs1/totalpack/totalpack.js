function fnAteFin() {
	var sRsp = '', aRsp;
				//ID motivos de atencion (1-6)
	sRsp = TPeje.FinTurno("1|2|3|4|5|6", "PAUSA");
	aRsp = sRsp.split('|');
	if (aRsp.length > 0) {
		//<< 0,OK 1,Err
		if (aRsp[0] == '0') {
			alert('OK');
		} else {
			alert('Error [' + aRsp[0] + ']\n' + aRsp[1]);
		}
	} else {
		alert('Error\n' + sRsp);
	}
