
$(document).ready(function(){

    var prodID = $('.itemID');
    var addCartBtn = $('.addCartBtn');
    var removeCartBtn = $('.removeCartBtn');
    var itemInCartDis = $('.items-in-cart');
    var hiddenIframe = $('.hiddenIframe');
    var baseURL = "https://enigmatic-lowlands-70024.herokuapp.com";
    var sessionURL = "/assignments/week03/scripts/session.manage.script.php";


    function addCart(value)
    {
        var urlVar = "?action=add&value=" + value;
        var addURL = baseURL + sessionURL + urlVar;
       // hiddenIframe.attr('src',addURL);
        hiddenIframe.load(addURL);
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
    });


    removeCartBtn.on('click',function(){
        removeCart($(this).next(prodID).val());
    });


});
