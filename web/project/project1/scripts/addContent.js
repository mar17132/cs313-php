var selectChk = $(".selectValueChk");
var addContentBtn = $(".addContentBtn");
var dateTxt = $("#patchDateTxt");
var timeTxt = $("#patchTimeTxt");
var timeBool = false;
var dateBool = false;

function disableAllCheck(elem)
{
    elem.prop("disabled",true);
}

function enableAllCheck(elem)
{
    elem.prop("disabled",false);
}

selectChk.on("click",function(){


    if($(this).is(":checked"))
    {
        disableAllCheck(selectChk);
        $(this).prop("disabled",false);
    }
    else
    {
        enableAllCheck(selectChk);
    }


});


dateTxt.on("change",function(){
    reg = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/

    if(reg.test($(this).val()))
    {
        dateBool = true;
        $(this).removeClass("error");
        if(dateBool == true && timeBool == true)
        {
            addContentBtn.attr('disabled',true);
        }
    }
    else
    {
        $(this).addClass("error");
        dateBool = false;
        addContentBtn.attr('disabled',false);
    }

});


timeTxt.on("keyup",function(){

    reg = /^[0-9]{2}:[0-9]{2}:[0-9]{2}$/

    if(reg.test($(this).val()))
    {
        timeBool = true;
        $(this).removeClass("error");
        if(dateBool == true && timeBool == true)
        {
            addContentBtn.attr('disabled',true);
        }
    }
    else
    {
        $(this).addClass("error");
        timeBool = false;
        addContentBtn.attr('disabled',false);
    }
});


