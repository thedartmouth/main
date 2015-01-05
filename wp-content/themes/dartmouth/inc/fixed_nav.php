<script type="text/javascript">
(function($){
	$(document).ready(function() {
	    $('.header-main').height($("#primary-navigation").height());

	    $('#primary-navigation').affix({
	        offset: { top: 140 }
	    });
	});
})(jQuery);
</script>