var selectChk;
var addContentBtn;
var dateTxt;
var timeTxt;
var patchname;
var nameBool;
var timeBool;
var dateBool;

function disableAllCheck(elem)
{
    elem.prop("disabled",true);
}

function enableAllCheck(elem)
{
    elem.prop("disabled",false);
}




$(document).ready(function(){
    selectChk = $(".selectValueChk");
    addContentBtn = $(".addContentBtn");
    dateTxt = $("#patchDateTxt");
    timeTxt = $("#patchTimeTxt");
    patchname = $("#patchnameTxt");
    timeBool = false;
    dateBool = false;
    nameBool = false;

    patchname.on("input",function(){

        if($(this).val() != "")
        {
            nameBool = true;
            $(this).removeClass("error");
            if(dateBool == true && timeBool == true && nameBool == true)
            {
                addContentBtn.prop('disabled',false);
            }
        }
        else
        {
            $(this).addClass("error");
            dateBool = false;
            addContentBtn.prop('disabled',true);
        }
    });


    dateTxt.on("input",function(){
        reg = /^[0-9]{4}-[0-9]{2}-[0-9]{2}$/

        if(reg.test($(this).val()))
        {
            dateBool = true;
            $(this).removeClass("error");
            if(dateBool == true && timeBool == true && nameBool == true)
            {
                addContentBtn.prop('disabled',false);
            }
        }
        else
        {
            $(this).addClass("error");
            dateBool = false;
            addContentBtn.prop('disabled',true);
        }

    });


    timeTxt.on("input",function(){

        reg = /^[0-9]{2}:[0-9]{2}:[0-9]{2}$/

        if(reg.test($(this).val()))
        {
            dateBool = true;
            $(this).removeClass("error");
            if(dateBool == true && timeBool == true && nameBool == true)
            {
                addContentBtn.prop('disabled',false);
            }
        }
        else
        {
            $(this).addClass("error");
            dateBool = false;
            addContentBtn.prop('disabled',true);
        }
    });


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


});

