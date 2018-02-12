/* 
 * @aouther = Parama Fadli Kurnia
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function validateDate(date) {
    newDate = "";
    strDate = date.toString();
    lengthDate = strDate.length;
    if (lengthDate == 1)
        newDate = "0" + strDate;
    else
        newDate = date;
    return newDate
}

function getTimeWeek(date) {
  var now = date? new Date(date) : new Date();
  now.setHours(0,0,0,0);

  // Get the previous Monday
  var monday = new Date(now);
  monday.setDate(monday.getDate() - monday.getDay() + 1);
  
  // Get next Sunday
  var sunday = new Date(now);
  sunday.setDate(sunday.getDate() - sunday.getDay() + 7);

  var strInit = monday.toISOString().toString();
  var init = strInit.split("T");
  
  var strEnd = sunday.toISOString().toString();
  var end = strEnd.split("T");
  var fixDate = init[0].toString()+"+-+"+end[0].toString();
  return fixDate;
}

function getTimeMonth(date){
    var fixDate = "";var fixMonth = "";
    month = date.getMonth();
    year = date.getFullYear();
    monthName = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"];
    switch (month){
        case 0:fixMonth = monthName[0];
               break;
        case 1:fixMonth = monthName[1];
               break;
        case 2:fixMonth = monthName[2];
                break;
        case 3:fixMonth = monthName[3];
                break;
        case 4:fixMonth = monthName[4];
                break;
        case 5:fixMonth = monthName[5];
                break;
        case 6:fixMonth = monthName[6];
                break;
        case 7:fixMonth = monthName[7];
                break;
        case 8:fixMonth = monthName[8];
                break;
        case 9:fixMonth = monthName[9];
                break;
        case 10:fixMonth = monthName[10];
                break;
        case 11:fixMonth = monthName[11];
                break;
    }
    fixDate = fixMonth.toString()+" "+year.toString();
    return fixDate;
}

function getTimeDaily(date){
    day = date.getDate();
    month = date.getMonth()+1;
    year = date.getFullYear();
    
    newDay = validateDate(day.toString());
    newMonth = validateDate(month.toString());
    return year.toString()+"-"+newMonth+"-"+newDay;
}

function getGap(range, date){
    var fixDate = "";
    if(range==0)fixDate = getTimeDaily(date);
    else if(range==1)fixDate = getTimeWeek(date);
    else if(range==2)fixDate = getTimeMonth(date);
    return fixDate;
}