/**
 * Core javascript
 * Governs javascript for search pages
 *
 **/


$(document).ready(function() {

    // Scroll to top after page load
    $(window).scrollTop(0);

    // On search form submit, grab input text, fetch results
    var form_id = 'search_form';
    var loading_id = 'loading_search_results';
    var more_id = 'more_search_results';
    var results_container_id = 'search_results_wrapper';

    // On search form submit, grab input text, fetch results
    $('form#'+form_id).live('submit',function(event){
        // Prevent default
        event.preventDefault();

        // Log the event
        console.log('Search form submitted');

        // Empty results container
        $('#'+results_container_id).empty();

        // Hide the "no results" text (if applicable)
        $('#no_results').hide();

        // Show loading bar
        $('#'+loading_id).fadeIn();

        // Hide the more bar
        $('#'+more_id).hide();

        // Grab parameters
        var parameters = 'randkey='+new Date().getTime();
        $('#'+form_id+' input, #'+form_id+' select, #'+form_id+' textarea').each(function(index){
            var input_name = $(this).attr('name');
            var input_value = $(this).val();
            parameters += '&'+input_name+'='+input_value;
        });

        // Submit Query
        $.getJSON("search/process_query.php",parameters,
        function(ajax_response){
            if(ajax_response.response.type == 'success') {
                // Form submission successful
                var article_count = ajax_response.response.data.article_count;
                var article_ids = ajax_response.response.data.article_ids;
                $('#'+loading_id).hide();
                if(article_count > 0){
                    $.each(article_ids, function(){
                        $('#'+results_container_id).append('<input type="hidden" class="hidden_result unprocessed" id="hidden_id_'+this+'" value="'+this+'" />');
                    });
                    show_results();
                } else {
                    $('#no_results').fadeIn();
                }
            } else {
                // Form submission failed, show the error message
                $('#'+loading_id).hide();
                console.log('Error submitting search query via ajax');
            }
        })
        // Error function
        .error(function() {
            console.log('Error getting JSON from process_query page');
            $('#'+loading_id).hide();
        });
    });


// Cycle through hidden results and show them
function show_results(){
    var quantity = 10;
    for (var i=1; i<=quantity; i++){
        var cxs = '#'+results_container_id+' input.hidden_result:first-child';
        var new_id = $('#'+results_container_id+' input.hidden_result').first().attr('id');
        $('#'+new_id).remove();
        show_single_result(new_id);
    }
    $('#'+loading_id).hide();
    if($('#'+results_container_id+' input.hidden_result.unprocessed').length > 0){
        $('#'+more_id).fadeIn();
    }
}


// Show a single result
function show_single_result(article_id){
    console.log('entered');
    // Submit Query
    var parameters = 'id='+article_id+'&randkey='+new Date().getTime();
    $.getJSON("search/get_article_preview.php",parameters,
    function(ajax_response){
        if(ajax_response.response.type == 'success') {
            // Form result grabbed successfully
            var headline = ajax_response.response.data.headline;
            var content = ajax_response.response.data.content;
            var authors = ajax_response.response.data.authors;
            var date = ajax_response.response.data.date;
            var url = ajax_response.response.data.url;
            var article_id = ajax_response.response.data.id;

            if (article_id == "") {
                console.log('Error getting article preview');
                return;
            }

            $('#'+results_container_id).append('<div class="result_item" id="article_id_'+article_id+'"><div class="date">'+date+'</div><div class="headline"><a class="url" href="'+url+'">'+headline+'</a></div><div class="content"><div class="authors">By: </div><div>'+content+'...</div></div></div>');
            $.each(authors, function(key, value) {
                var author_name = value.name;
                var author_id = value.id;
                $('#article_id_'+article_id+' .authors').append('<a class="author" href="staff.php?id='+author_id+'" id="author_id_'+author_id+'">'+author_name+'</a>');
            });


        } else {
            // Show the error message
            console.log('Error getting article preview');
        }
    })
    // Error function
    .error(function() {
        console.log('Error getting JSON from get_article_preview.php page');
    });
}

// Bind click of more-buton
$('#'+more_id).live('click',function(event){
    $(this).hide();
    $('#'+loading_id).show();
    show_results();
});


// If query has been auto-populated on page load, submit form
var input_value = $('#search_input').val();
console.log('Input value: '+input_value);
if(input_value.length > 0){
    $('form#'+form_id).submit();
}

});
