/* 
 * @author = Parama Fadli Kurnia
 * and open the template in the editor.
 */
function hideMenu() {
    var res = document.getElementById("reset");
    res.style.display = "none";

    var pause = document.getElementById("pause");
    pause.style.display = "none";

    var close = document.getElementById("close");
    close.style.display = "none";

    var timer = document.getElementById("timer");
    timer.style.display = "none";

    var cluster = document.getElementById("cluster");
    cluster.style.display = "";

    var summary = document.getElementById("summary");
    summary.style.display = "";

    var play = document.getElementById("play");
    play.style.display = "";
}

function showMenu() {
    var res = document.getElementById("reset");
    res.style.display = "";

    var pause = document.getElementById("pause");
    pause.style.display = "";

    var close = document.getElementById("close");
    close.style.display = "";

    var timer = document.getElementById("timer");
    timer.style.display = "";

    var cluster = document.getElementById("cluster");
    cluster.style.display = "none";

    var summary = document.getElementById("summary");
    summary.style.display = "none";

    var play = document.getElementById("play");
    play.style.display = "none";

    location.reload();
}

function insertURLParams(key, value){
    document.location.hash = "&test=vad";
}