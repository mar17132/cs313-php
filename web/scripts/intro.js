
var day_dis;
var hour_dis;
var minute_dis;
var second_dis;
var timeInMill = {
    day: 1000 * 60 * 60 * 24,
    hour: 1000 * 60 * 60,
    minute: 1000 * 60,
    second: 1000
};

function calTime(dateTo)
{
    currentTime = new Date();
    timeRemaning =  dateTo.getTime() - currentTime.getTime();
    if(timeRemaning > 0)
    {
        day_dis.html(addLeadingZero(Math.floor(timeRemaning / timeInMill.day)));
        hour_dis.html(addLeadingZero(Math.floor((timeRemaning % timeInMill.day) / timeInMill.hour)));
        minute_dis.html(addLeadingZero(Math.floor((timeRemaning % timeInMill.hour) / timeInMill.minute)));
        second_dis.html(addLeadingZero(Math.floor((timeRemaning % timeInMill.minute) / timeInMill.second)));
    }
    else
    {
        day_dis.html("00");
        hour_dis.html("00");
        minute_dis.html("00");
        second_dis.html("00");
    }
}


function addLeadingZero(num)
{
    if(num >= 0 && num < 10)
    {
        return "0" + num;
    }

    return num;
}



$(document).ready(function(){

    semesterEnd = new Date(2019,3,12); //april 12 2019
    day_dis = $('#d_countdown');
    hour_dis = $('#h_countdown');
    minute_dis = $('#m_countdown');
    second_dis = $('#s_countdown');
    calTime(semesterEnd);

    setInterval(function(){
        calTime(semesterEnd);
    }, 1000);
    
});
