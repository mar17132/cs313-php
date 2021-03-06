

var itemsInCartDis;
var prodID;
var addCartBtn;
var removeCartBtn;
var itemInCartDis;
var hiddenIframe;
var baseURL;
var sessionURL;
var cartParentUL;
var checkOutBtn;
var allItemPrices;
var subTotalSpan;
var taxSpan;
var shippingSpan;
var totalSpan;


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


function removeCartItem(item)
{
    item.parents('.cart-items-li').remove();
}


function calTotals()
{
    subTotalItems = 0;
    tax = 0;
    total = 0;
    allItemPrices = $('.cart-itemPrice');

    if(allItemPrices.length > 0)
    {
        allItemPrices.each(function(){
            numberArray = $(this).html().split("$");
            subTotalItems += parseFloat(numberArray[1]);
        });

        tax = subTotalItems * parseFloat(taxSpan.html());
        total = tax + subTotalItems + parseFloat(shippingSpan.html().split("$")[1]);

    }

    subTotalSpan.html("$" + subTotalItems.toFixed(2));
    totalSpan.html("$" + total.toFixed(2));
}


$(document).ready(function(){

    itemsInCartDis = $('.items-in-cart');
    prodID = $('.itemID');
    addCartBtn = $('.addCartBtn');
    checkOutBtn = $('.checkoutCartBtn');
    removeCartBtn = $('.removeCartBtn');
    itemInCartDis = $('.items-in-cart');
    hiddenIframe = $('.hiddenIframe');
    baseURL = "scripts/";
    sessionURL = "session.manage.script.php";
    cartParentUL = $('.cart-items-ul');
    allItemPrices = $('.cart-itemPrice');

    subTotalSpan = $('#subTotal');
    taxSpan = $('#tax');
    shippingSpan = $('#shipping');
    totalSpan = $('#total');

    addCartBtn.on('click',function(){
        addCart($(this).next(prodID).val());
    });

    removeCartBtn.on('click',function(){
        baseURL = "../scripts/";
        removeCart($(this).next(prodID).val());
        removeCartItem($(this));
        calTotals();
    });

    checkOutBtn.on('click',function(){

    });


});


