/*
 * @reconstructor = Parama Fadli Kurnia 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/****************************************************/
//return x position from data
function x(d) {
    return d.x;
}

//return y position from data
function y(d) {
    return d.y;
}

//return ner value
function key(d) {
    return d.ner;
}

//return ner value, used for specify the color for your dots
function color(d) {
    return d.ner;
}

function getSpecialName(name, list) {
    retval = 12;
    for (var i = 0; i < list.length; i++) {
        if (name.toLowerCase() == list[i].toLowerCase()) {
            retval = 24;
            break;
        }
    }
    return retval;
}
