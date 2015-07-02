/**
 * w3cookies (0.1) - 23/12/2006
 * Leandro Vieira Pinho
 * http://leandrovieira.com
 */
var w3cookies = {
	date: new Date(),
	// Cria o(s) cookie(s)
	// Forma de uso: w3cookies.create('nome_do_cookie','valor',dias_para_expirar);
	create: function(strName, strValue, intDays) {
		if ( intDays ) {
			this.date.setTime(this.date.getTime()+(intDays*24*60*60*1000));
			var expires = "; expires=" + this.date.toGMTString();
		} else {
			var expires = "";
		}
		document.cookie = strName + "=" + strValue + expires + "; path=/";
	},
	// Ler as informações de um cookie em específico
	// Forma de uso: w3cookies.read('nome_do_cookie');
	read: function(strName) {
		var strNameIgual = strName + "=";
		var arrCookies = document.cookie.split(";");
		for ( var i = 0, strCookie; strCookie = arrCookies[i]; i++ ) {
			while ( strCookie.charAt(0) == " ") {
				strCookie = strCookie.substring(1,strCookie.length);
			}
			if ( strCookie.indexOf(strNameIgual) == 0 ) {
				return strCookie.substring(strNameIgual.length,strCookie.length);
			}
		}
		return null;
	},
	// Delete um cookie desejado
	// Forma de uso: w3cookies.erase('nome_do_cookie');
	erase: function(strName) {
		this.create(strName,"",-1);
	}
}