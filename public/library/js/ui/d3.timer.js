/* 
 * @reconstructor = Parama Fadli Kurnia
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

//increment by day
function incrementDateByDay(startDate, days) {
    var retDate = new Date();
    retDate.setTime(startDate.getTime() + (days * 86400000));
    return retDate;
}

//increment by week
function incrementDateByWeek(startDate, days) {
    var retDate = new Date();
    retDate.setTime(startDate.getTime() + (days * 86400000 * 7));
    return retDate;
}

//increment by month
function incrementDateByMonth(startDate, days) {
    var retDate = new Date();
    var currentDay = startDate.getDate();
    var currentMonth = startDate.getMonth();
    var currentYear = startDate.getFullYear();

    retDate.setDate(currentDay);

    var monthReal = (days + currentMonth) % 12;
    var addYear = Math.floor((days + currentMonth) / 12);

    retDate.setMonth(monthReal);
    retDate.setYear(currentYear + addYear);

    return retDate;
}

function incrementDateBy(startDate, days, by) {
    if (by == 0)
        return incrementDateByDay(startDate, days);
    else if (by == 1)
        return incrementDateByWeek(startDate, days);
    else if (by == 2)
        return incrementDateByMonth(startDate, days);
}

function setStartDate(year, month, day) {
    var startdate = new Date();
    startdate.setDate(day);
    startdate.setMonth(month);
    startdate.setFullYear(year);
    return startdate;
}

function setListDate(listDate) {
    dates = [];
    for (var index = 0; index < listDate.length; index++) {
        var tahun = parseInt(listDate[index].split("-")[0]);
        var bulan = parseInt(listDate[index].split("-")[1], 10) - 1;
        var hari = parseInt(listDate[index].split("-")[2], 10);
        
        var tanggal = new Date(tahun,bulan,hari);
//        var tanggal = new Date();
//        tanggal.setDate(hari);
//        tanggal.setMonth(bulan);
//        tanggal.setFullYear(tahun);
        dates.push(tanggal);
    }
    return dates;
}