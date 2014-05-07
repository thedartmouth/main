$(document).ready(function() {
    $('#nav-wrapper').height($("#nav").height());

    $('#nav').affix({
        offset: { top: 140 }
    });
});
