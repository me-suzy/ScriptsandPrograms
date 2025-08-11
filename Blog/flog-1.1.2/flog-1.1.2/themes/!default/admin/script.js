/*
Copyright (C) 2005 Noah Medling

This program is licensed under the GNU General Public License, version 2,
as published by the Free Software Foundation, June 1991. For details, see
LICENSE.txt
*/

function focusfirst(){
	if(document.forms.length > 0){
		var form = document.forms[0];
		for(i=0; i<form.length; ++i){
			if(form.elements[i].type == "text" || form.elements[i].type == "textarea" || form.elements[i].type == "password"){
				document.forms[0].elements[i].focus();
				break;
			}
		}
	}
}
