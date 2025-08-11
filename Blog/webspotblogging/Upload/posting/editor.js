var b = 2; var c = 2; var d = 2; var e = 2; var f = 2; var g = 2;
function tag(v, tagadd, newbut, tagclose, oldbut, name) { 
    if (eval(v)%2 == 0) { 
        eval("window.document.editform."+name+".value = newbut;"); 
        var content = window.document.editform.content.value; 
        window.document.editform.content.value = content + tagadd; 
        window.document.editform.content.focus(); 
    } else { 
        eval("window.document.editform."+name+".value = oldbut;"); 
        var content = window.document.editform.content.value; 
        window.document.editform.content.value = content + tagclose; 
        window.document.editform.content.focus(); 
    } 
    eval(v+"++;"); 
} 