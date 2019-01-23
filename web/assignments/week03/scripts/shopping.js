
$(document).ready(function(){

    var itemsInCartDis = $('.items-in-cart');
    var prodID = $('.itemID');
    var addCartBtn = $('.addCartBtn');
    var removeCartBtn = $('.removeCartBtn');
    var itemInCartDis = $('.items-in-cart');
    var hiddenIframe = $('.hiddenIframe');
    var baseURL = "https://enigmatic-lowlands-70024.herokuapp.com";
    var sessionURL = "/assignments/week03/scripts/session.manage.script.php";


    function addCart(value)
    {
        var urlVar = "scripts/session.manage.script.php?action=add&value=" + value;
        //var addURL = baseURL + sessionURL + urlVar;
       // hiddenIframe.attr('src',addURL);
        hiddenIframe.load(urlVar);
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


    addCartBtn.on('click',function(){
        addCart($(this).next(prodID).val());
        //updateCartNumberDis(hiddenIframe.contents().find("#cartItemCount").val());
    });


    removeCartBtn.on('click',function(){
        removeCart($(this).next(prodID).val());
    });


});
