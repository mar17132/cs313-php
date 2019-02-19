

var daysInCalendarLI;
var todaysDate;
var calendarNextBtn;
var calendarPrevBtn;
var monthNameDispaly;
var showingMonth; //this is an int 0-11
var showingYear; //this the year of the current showing month
var monthsObj; //an object with varibles and function related to month
var calendarElm;
var daysInWeek = 7;


function jsonCalendarObj(searchMonth, searchYear)
{
    urlString = "";

    if(searchMonth != null && searchYear != null)
    {
        urlString = "getCalendarEvent.php?month=" + searchMonth + "&year=" + searchYear;
    }
    else
    {
        urlString = "getCalendarEvent.php";
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            return JSON.parse(this.responseText);
        }
    };

    xmlhttp.open("GET", urlString, true);
    xmlhttp.send();

}

function bulidCalenderDayElm(dayNum)
{
    /*This is what is bulid and then return

    <li class="calendar-li-cell calendar-days col" >
        <div class="calendar-li-content" >
            <span>1</span>
        </div>
    </li>

    */

    newLiCell = $("<li class='calendar-li-cell calendar-days col' ></li>");
    newDivContent = $("<div class='calendar-li-content' >");
    newSpanNum = $("<span class='date-number' >" + dayNum + "</span>");

    if(showingMonth == todaysDate.getMonth() && dayNum == todaysDate.getDate()
      && showingYear == todaysDate.getFullYear())
    {
        newSpanNum.addClass("current-date");
    }

    newSpanNum.appendTo(newDivContent);

    //add one to month to change it from 0-11 to 1-12
    appointmentObj = jsonCalendarObj((showingMonth + 1), showingYear);
    if(appointmentObj)
    {
        $.each(appointments.patchdates,function(index,value){
            newAappointment = $("<a>" + value.name + "</a>");
            newAappointment.appendTo(newDivContent);
        });
    }

    newDivContent.appendTo(newLiCell);

    return newLiCell;

}


function bulidCalenderEmptyDayElm()
{
    /*This is what is bulid and then return
    <li class="calendar-li-cell calendar-days col" >
        <div class="calendar-li-content" >
            <span>1</span>
        </div>
    </li>
    */

    newLiCell = $("<li class='calendar-li-cell col' ></li>");
    newDivContent = $("<div class='calendar-li-content' >");
    newSpanNum = $("<span></span>");

    newSpanNum.appendTo(newDivContent);
    newDivContent.appendTo(newLiCell);

    return newLiCell;

}

function bulidCalendarEmptyWeekElm(emptyDays,newWeek)
{
    /*This is what is bulid and then return
    <ul class="calendar-ul-row row" >
    bulidCalenderDayElm(dayNum, appointments)
    </ul>
    */

    newUlRow = false;

    if(newWeek)
    {
        newUlRow = newWeek;
    }
    else
    {
        newUlRow = $("<ul class='calendar-ul-row row' ></ul>");
    }


    if($.isNumeric(emptyDays) && emptyDays > 0)
    {
        for(i = 0; i < emptyDays; i++)
        {
            newCell = bulidCalenderEmptyDayElm();
            newCell.appendTo(newUlRow);
        }
    }

    return newUlRow;
}



function bulidCalendarWeekElm(dayStart,daysAmount,newWeek)
{
    /*This is what is bulid and then return
    <ul class="calendar-ul-row row" >
    bulidCalenderDayElm(dayNum, appointments)
    </ul>
    */

    newUlRow = null;

    if(newWeek != null)
    {
        newUlRow = newWeek;
    }
    else
    {
        newUlRow = $("<ul class='calendar-ul-row row' ></ul>");
    }

    if($.isNumeric(dayStart) && $.isNumeric(daysAmount))
    {
        for(i = dayStart; i < (dayStart + daysAmount); i++)
        {
            newCell = bulidCalenderDayElm(i);
            newCell.appendTo(newUlRow);
        }
    }


    return newUlRow;
}


function bulidCalendar()
{
    monthName = monthsObj.getMonthName(showingMonth);
    daysInMonth = monthsObj.getDaysInMonth(showingMonth,showingYear);
    firstDayofWeek = monthsObj.getFirstDayofMonth(showingMonth,showingYear);
    endDayofWeek = monthsObj.getLastDayofMonth(showingMonth,showingYear);
    numWeeks = parseInt(monthsObj.getNumWeeks(showingMonth,showingYear));
    daysPrinted = 0;
    daysInfirstWeek = 0;
    firstWeek = false;
    lastWeek = false;
    newWeek = false;

    //build first week if there are empty days
    if(firstDayofWeek != 0)
    {
        daysPrinted +=  7 - firstDayofWeek;
        firstWeek = bulidCalendarWeekElm(1,( 7 - firstDayofWeek),
                    bulidCalendarEmptyWeekElm(firstDayofWeek));
        numWeeks--;
    }


     //build Last week if there are empty days
    if(endDayofWeek != 6)
    {
        //daysPrinted +=  6 - endDayofWeek;

        lastWeek = bulidCalendarEmptyWeekElm((6 - endDayofWeek),
                    bulidCalendarWeekElm((daysInMonth - endDayofWeek),
                    (endDayofWeek + 1)));
        numWeeks--;
    }

    if(firstWeek)
    {
        firstWeek.appendTo(calendarElm);
    }


    for(k = 0; k < numWeeks; k++)
    {
        newWeek = bulidCalendarWeekElm((daysPrinted + 1),7);
        daysPrinted += 7;
        newWeek.appendTo(calendarElm);
    }


    if(lastWeek)
    {
        lastWeek.appendTo(calendarElm);
    }

}


function removeKeep(elem,keepNum)
{
    childArray = elem.children();

    for(i = childArray.length; i > keepNum; i--)
    {
        childArray.eq(i).remove();
    }

}


$(document).ready(function(){

    daysInCalendarLI = $(".calendar-days");
    calendarElm = $(".calendar");
    monthNameDispaly = $("h1.month-name");
    calendarNextBtn = $(".next-calendar-btn");
    calendarPrevBtn = $(".prev-calendar-btn");


    todaysDate = new Date();
    showingMonth = todaysDate.getMonth();
    showingYear = todaysDate.getFullYear();


    monthsObj ={
        months:[
            {name:"January",jnum:0,dnum:1},
            {name:"February",jnum:1,dnum:2},
            {name:"March",jnum:2,dnum:3},
            {name:"April",jnum:3,dnum:4},
            {name:"May",jnum:4,dnum:5},
            {name:"June",jnum:5,dnum:6},
            {name:"July",jnum:6,dnum:7},
            {name:"August",jnum:7,dnum:8},
            {name:"September",jnum:8,dnum:9},
            {name:"October",jnum:9,dnum:10},
            {name:"November",jnum:10,dnum:11},
            {name:"December",jnum:11,dnum:12}
        ],

        getNextMonth:function(month){
            if((month + 1) <= 11)
            {
                return month + 1;
            }
            else
            {
                return 0;
            }
        },

        getPrevMonth:function(month){
            if((month - 1) < 0)
            {
                return 11;
            }
            else
            {
                return month - 1;
            }
        },

        getDaysInMonth:function(month,year){

            return new Date(year,this.getNextMonth(month),0).getDate();
        },

        getFirstDayofMonth:function(month,year){
            return new Date(year,month,1).getDay();
        },

        getLastDayofMonth:function(month,year){
            nextyear = year;
            if(month == 11 && this.getNextMonth(month) == 0)
            {
                nextyear = year + 1;
            }
            return new Date(nextyear,this.getNextMonth(month),0).getDay();
        },

        getNumWeeks:function(month,year){
            numberDays = this.getDaysInMonth(month,year);
            firstDay = this.getFirstDayofMonth(month,year);
            lastDay = this.getLastDayofMonth(month,year);
            weeks = 0;

            //Cal the first week
            //subtrack firstday by 7 to get all days including this day
            if(7 - firstDay < 7)
            {
                weeks++;
                numberDays = numberDays - (7 - firstDay);
            }

            //Cal the last week
            //subtrack lastday by 6 to get only the remaing days
            if(6 - lastDay > 0)
            {
                weeks++;
                numberDays = numberDays - (7 - (6 - lastDay));
            }

            //Cal the remaining weeks
            weeks += numberDays / 7;

            return weeks;

        },

        getMonthName:function(monthNum){
            monthName = "";

            $.each(this.months,function(index,value){
                if(monthNum == value.jnum)
                {
                    monthName = value.name;
                }
            });

            return monthName;
        },

        getMonthDisNum:function(monthNum){
            monthDNum = "";

            $.each(this.month,function(index,value){
                if(monthNum == value.jnum)
                {
                    monthDNum = value.dnum;
                }
            });

            return monthName;
        },

        getMonthObj:function(monthNum){
            monthObj = "";

            $.each(this.month,function(index,value){
                if(monthNum == value.jnum)
                {
                    monthObj = value;
                }
            });

            return monthObj;
        }


    };

    monthNameDispaly.text(monthsObj.getMonthName(showingMonth) + " " + showingYear);

    calendarNextBtn.on("click",function(){

        nextMonth = monthsObj.getNextMonth(showingMonth);

        if(nextMonth == 0)
        {
            showingYear++;
        }

        showingMonth = nextMonth;

        monthNameDispaly.text(monthsObj.getMonthName(showingMonth) + " " + showingYear);

        removeKeep(calendarElm,1);

        bulidCalendar();
    });

    calendarPrevBtn.on("click",function(){

        prevMonth = monthsObj.getPrevMonth(showingMonth);

        if(prevMonth == 11)
        {
            showingYear--;
        }

        showingMonth = prevMonth;

        monthNameDispaly.text(monthsObj.getMonthName(showingMonth) + " " + showingYear);

        removeKeep(calendarElm,1);

        bulidCalendar();
    });

    bulidCalendar();

});

