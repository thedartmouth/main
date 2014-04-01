/**
 * IE detection
 * This ie-detection function is borrowed from James Padosley's awesome post here: http://james.padolsey.com/javascript/detect-ie-in-js-using-conditional-comments/
 * 
 **/

var ie = (function(){
    var undef,
        v = 3,
        div = document.createElement('div'),
        all = div.getElementsByTagName('i');
    while (
        div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
        all[0]
    );
    return v > 4 ? v : undef;
}());