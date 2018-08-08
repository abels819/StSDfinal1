function clearfield(field){
    document.getElementById(field).value="";
}

function apply(info,toggle,content){
    document.getElementById(info).value=content;
    document.getElementById(toggle).innerHTML="chosen : "+content;   
}


function ajax_ini() {
var ajax;
        if (window.XMLHttpRequest) {
ajax = new XMLHttpRequest();
        } else {
ajax = new ActiveXObject('Microsoft.XMLHttp');
        }
return ajax;
}

function get_menu(parentid,url) {
    var ajax_menu = new ajax_ini();
    ajax_menu.onreadystatechange = function(){
        if(ajax_menu.readyState==4 && ajax_menu.status==200){
            document.getElementById(parentid).innerHTML=ajax_menu.responseText;
        }
    }
    ajax_menu.open('GET',url,true);
    ajax_menu.send();
}