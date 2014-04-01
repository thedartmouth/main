/**
 * Core javascript
 * Governs javascript for migration dashboard
 * 
 **/


$(document).ready(function() {
    
    // Hide all buttons
    hide_and_show_buttons('all', true);

    // Scroll to top after page load
    $(window).scrollTop(0);

    // Set progress bars to zero
    $( ".progress_bar" ).progressbar({
      value: 0
    });
    
    // Check wipe level
    check_wipe();
    
    // Check importer level
    check_importer();
    
    // Check processor level
    check_processor();

    // Bind click of all buttons
    $(".button").live('click',function(event){
        event.preventDefault();
        hide_and_show_buttons('all', true);
        
    });
        
    // Bind click of start-import button
    $("#import_now").live('click',function(){
        // Trigger the import loop
        import_loop(true, 1, 100);
      
    });    
    
    // Bind click of start-processing button
    $("#process_now").live('click',function(){
        // Trigger the import loop
        process_loop();
      
    });
    
    // Bind click of wipe-now
    $("#wipe_now").live('click',function(){

        var ajax_url = 'import_articles.php?force=true&truncate=true&starting_at=1&length=0';
        $.getJSON(ajax_url,{
                 randkey: new Date().getTime()
        },    
        function(ajax_response){
            if(ajax_response.response.type == 'success') {
                var id = 'wipe';
                setTimeout(function() {set_progress_bar(id, 25);}, 100);
                setTimeout(function() {set_progress_bar(id, 50);}, 250);
                setTimeout(function() {set_progress_bar(id, 75);}, 500);
                setTimeout(function() {set_progress_bar(id, 100);}, 1000);
                setTimeout(function() {
                    check_importer();
                    check_processor();
                    hide_and_show_buttons('wipe', true);
                }, 1500);

            } else {
                // JSON failed
                console.log('Failed to fetch the "'+ajax_url+'" content');
            }
        })
        // Error function
        .error(function() {
        console.log('Error getting JSON from '+ajax_url+' page');
        lightbox_error();
        });    
    
      
    });    
    
});

// Article import looper
function import_loop(truncate, start, length){
    var url = 'import_articles.php?force=true';
    if(truncate){
        url+='&truncate=true';
    }
    if(start){
        url+='&starting_at='+start;
    }
    if(length){
        url+='&length='+length;
    }
    $.getJSON(url,{
             randkey: new Date().getTime()
    },    
    function(ajax_response){
        if(ajax_response.response.type == 'success') {
            var total_tmp = parseInt(ajax_response.response.data.total_tmp);
            var total_legacy = parseInt(ajax_response.response.data.total_legacy);
            var is_synced = ajax_response.response.data.is_synced;
            var endpoint = ajax_response.response.data.id_ended;
            var total_processed = parseInt(ajax_response.response.data.total_processed);
            var percent_complete = ((total_tmp + total_processed) / total_legacy) * 100;  
            if((total_tmp + total_processed) >= total_legacy){
                percent_complete = 100;
            }
            set_progress_bar('import', percent_complete, null, true);
            var percent_left_in_tmp = (total_tmp / 50000) * 100;            
            set_progress_bar('process', percent_left_in_tmp, total_tmp, true);            
            if(is_synced != 'true'){
                new_start = endpoint + 1;
                setTimeout(function() {
                    import_loop(false,new_start,100);
                }, 50);  
            } else {
                check_importer();
                check_processor();
                check_wipe();
            }
        } else {
            // JSON failed
            console.log('Failed to fetch the "'+url+'" content');
        }
    })
    // Error function
    .error(function() {
    console.log('Error getting JSON from '+url+' page');
    lightbox_error();
    });   
}

// Article process looper
function process_loop(length){
    var url = 'process_articles.php';

    if(length){
        url+='?length='+length;
    }
    $.getJSON(url,{
             randkey: new Date().getTime()
    },    
    function(ajax_response){
        if(ajax_response.response.type == 'success') {
            var posts_left = parseInt(ajax_response.response.data.posts_left);
            var percent_complete = (posts_left / 50000) * 100;
            set_progress_bar('process', percent_complete, posts_left, true);
            if(posts_left > 0){
                setTimeout(function() {
                    process_loop();
                }, 50);  
            } else {
                check_importer();
                check_processor();
                check_wipe();                
            }
        } else {
            // JSON failed
            console.log('Failed to fetch the "'+url+'" content');
        }
    })
    // Error function
    .error(function() {
    console.log('Error getting JSON from '+url+' page');
    lightbox_error();
    });
    
}
function hide_and_show_buttons(phase, turn_off){
    var visibility = 'visible';
    if(turn_off == true){
        visibility = 'hidden';
    }
    $('#'+phase+'_now').css('visibility', visibility);
    if(phase == 'all'){
        $('.button').css('visibility', visibility);
    }        
}

function set_progress_bar(id, percent, remaining, hide_button){
    percent_int = Math.round(percent);
    var red = '#ffaaaa';
    var green = '#b4ffaa';
    $('#'+id+'_progress_bar').progressbar({
      value: percent_int
    });
    if(id == 'import'){
        hide_and_show_buttons(id, true);
        var percent_dev = percent.toFixed(2);
        $('#'+id+'_progress_counter .value').html(percent_dev);
        if(percent_dev == 100.00){
            $('#'+id+'_progress_bar .ui-progressbar-value').css('background', green);
        } else {
            if(hide_button != true){
                hide_and_show_buttons(id);
            }
        }
    }
    if(id == 'process'){
        hide_and_show_buttons(id, true);
        $('#'+id+'_progress_counter .value').html(remaining);
        if(remaining != 0){
            $('#'+id+'_progress_bar .ui-progressbar-value').css('background', red);
            $('#'+id+'_progress_bar').css('background', '#fff');
            if(hide_button != true){
                hide_and_show_buttons(id);
            }
        } else {
            $('#'+id+'_progress_bar').css('background', green);
        }  
    }
    if(id == 'wipe'){
        var percent_dev = percent.toFixed(2);
        $('#'+id+'_progress_counter .value').html(percent_dev);
        if(percent_dev == 100.00){
            $('#'+id+'_progress_bar .ui-progressbar-value').css('background', green);
        } else {
            hide_and_show_buttons(id);
        }
    }
}

function check_importer(){
    // Check real progress level of importer
    var ajax_url = 'import_articles.php?force=true&truncate=false&starting_at=1&length=0';
    $.getJSON(ajax_url,{
             randkey: new Date().getTime()
    },    
    function(ajax_response){
        if(ajax_response.response.type == 'success') {
            var total_tmp = parseInt(ajax_response.response.data.total_tmp);
            var total_legacy = parseInt(ajax_response.response.data.total_legacy);
            var total_processed = parseInt(ajax_response.response.data.total_processed);
            var percent_complete = ((total_tmp + total_processed) / total_legacy) * 100;
            var is_synced = ajax_response.response.data.is_synced;
            if((total_tmp + total_processed) >= total_legacy){
                percent_complete = 100;
            }
            console.log('Total tmp '+total_tmp+' Total legacy: '+total_legacy+' Total processed: '+total_processed);
            set_progress_bar('import', percent_complete);
        } else {
            // JSON failed
            console.log('Failed to fetch the "'+ajax_url+'" content');
        }
    })
    // Error function
    .error(function() {
    console.log('Error getting JSON from '+ajax_url+' page');
    lightbox_error();
    });
}

function check_processor(){
    // Check real queue-length of processor
    var ajax_url = 'process_articles.php?length=0';
    $.getJSON(ajax_url,{
             randkey: new Date().getTime()
    },    
    function(ajax_response){
        if(ajax_response.response.type == 'success') {
            var posts_left = parseInt(ajax_response.response.data.posts_left);
            var percent_complete = (posts_left / 50000) * 100;
            set_progress_bar('process', percent_complete, posts_left);
        } else {
            // JSON failed
            console.log('Failed to fetch the "'+ajax_url+'" content');
        }
    })
    // Error function
    .error(function() {
    console.log('Error getting JSON from '+ajax_url+' page');
    lightbox_error();
    });   
}

function check_wipe(){
    // Show the wipe button
    set_progress_bar('wipe', 0);
}

