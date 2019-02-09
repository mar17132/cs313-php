
var baseURL;
var locationURL;
var hiddenIframe;


function bulidURL(value,action)
{
    var urlVar = "?action=" + action + "&value=" + value;
    var addURL = baseURL + locationURL + urlVar;
    changeSrc(addURL);
}


function changeSrc(urlCart)
{
    hiddenIframe.attr('src',urlCart);
}


