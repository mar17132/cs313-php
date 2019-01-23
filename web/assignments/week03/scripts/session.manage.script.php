
<?php


function checkSession()
{
    if(session_status() != PHP_SESSION_ACTIVE)
    {
        session_start();
        $_SESSION["cart"] = array();
    }

    return true;
}


function setSessionVariables()
{
    if(checkSession())
    {
        if(isset($_GET["value"]))
        {
            $_SESSION["cart"][] = $_GET["value"];
            $_SESSION["cart"][] = $_GET["value"];
        }
    }
}


function getSessionCart()
{
    if(isset($_SESSION["cart"]))
    {
        return $_SESSION["cart"];
    }

    return false;
}


function removeItemCart($prodID)
{
    $newCartArray = array();
    $isfound = false;

    if(isset($_SESSION["cart"]))
    {
        foreach($_SESSION["cart"] as $item)
        {
            if($item != $prodID)
            {
                array_push($newCartArray,$item);
            }
            else if($isfound)
            {
                array_push($newCartArray,$item);
            }
            else
            {
                $isfound = true;
            }
        }

        unset($_SESSION["cart"]);
        $_SESSION["cart"][] = $newCartArray;
    }
}


function getCountCartArray()
{
    if(isset($_SESSION["cart"]))
    {
        return count($_SESSION["cart"]);
    }

    return 0;
}


function runJavaScript($arrayCount)
{
    echo "<script type='text/javascript' >
    if(window.updateCartNumberDis)
    {updateCartNumberDis($arrayCount);}
    else{parent.updateCartNumberDis($arrayCount);}
    </script>";

    var_dump($_SESSION["cart"]);
}


if(checkSession())
{
    if(isset($_GET["action"]))
    {
       if($_GET["action"] == "add")
       {
           setSessionVariables();
       }
       else if($_GET["action"] == "remove")
       {
           removeItemCart($_GET["value"]);
       }

       runJavaScript(getCountCartArray());
    }
}

?>
