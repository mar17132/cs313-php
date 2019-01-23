

var itemsInCartDis;
var prodID;
var addCartBtn;
var removeCartBtn;
var itemInCartDis;
var hiddenIframe;
var baseURL;
var sessionURL;


function addCart(value)
{
    var urlVar = "?action=add&value=" + value;
    var addURL = baseURL + sessionURL + urlVar;
    changeSrc(addURL);
}


function changeSrc(urlCart)
{
    hiddenIframe.attr('src',urlCart);
}

function removeCart(value)
{
    var urlVar = "?action=remove&value=" + value;
    var addURL = baseURL + sessionURL + urlVar ;
    hiddenIframe.attr('src',addURL);
}

function updateCartNumberDis(itemsInCart)
{
    itemsInCartDis.html(itemsInCart);
}


$(document).ready(function(){

    itemsInCartDis = $('.items-in-cart');
    prodID = $('.itemID');
    addCartBtn = $('.addCartBtn');
    removeCartBtn = $('.removeCartBtn');
    itemInCartDis = $('.items-in-cart');
    hiddenIframe = $('.hiddenIframe');
    baseURL = "scripts/";
    sessionURL = "session.manage.script.php";

    addCartBtn.on('click',function(){
        addCart($(this).next(prodID).val());
    });

    removeCartBtn.on('click',function(){
        removeCart($(this).next(prodID).val());
    });

});


