$(function() {
    $('#pubtype').change(function(){
        if($('#pubtype').val() == 'Journal') {
            $('#journal').show(); 
        } else {
            $('#journal').hide(); 
        } 
    });
        $('#conferencepaper').hide(); 
    $('#pubtype').change(function(){
        if($('#pubtype').val() == 'Conference Paper') {
            $('#conferencepaper').show(); 
        } else {
            $('#conferencepaper').hide(); 
        } 
    });
        $('#studentreport').hide(); 
    $('#pubtype').change(function(){
        if($('#pubtype').val() == 'Student Report') {
            $('#studentreport').show(); 
        } else {
            $('#studentreport').hide(); 
        } 
    });
        $('#researchreport').hide(); 
    $('#pubtype').change(function(){
        if($('#pubtype').val() == 'Research Report') {
            $('#researchreport').show(); 
        } else {
            $('#researchreport').hide(); 
        } 
    });
        $('#otherpub').hide(); 
    $('#pubtype').change(function(){
        if($('#pubtype').val() == 'Other Publications') {
            $('#otherpub').show(); 
        } else {
            $('#otherpub').hide(); 
        } 
    });
 $('#location').hide(); 
    $('#format').change(function(){
        if($('#format').val() == 'Printed') {
            $('#location').show(); 
        } else {
            $('#location').hide(); 
        } 
    });
 $('#newauthor').hide(); 
    $('#authorselect').change(function(){
        if($('#authorselect').val() == 'Add New Author') {
            $('#newauthor').show(); 
        } else {
            $('#newauthor').hide(); 
        } 
    });
 $(document).ready(function(e){
    $('.search-panel .dropdown-menu').find('a').click(function(e) {
		e.preventDefault();
		var param = $(this).attr("href").replace("#","");
		var concept = $(this).text();
		$('.search-panel span#search_concept').text(concept);
		$('.input-group #search_param').val(param);
	});
});
});

//table with filter
(function(){
    'use strict';
	var $ = jQuery;
	$.fn.extend({
		filterTable: function(){
			return this.each(function(){
				$(this).on('keyup', function(e){
					$('.filterTable_no_results').remove();
					var $this = $(this), 
                        search = $this.val().toLowerCase(), 
                        target = $this.attr('data-filters'), 
                        $target = $(target), 
                        $rows = $target.find('tbody tr');
                        
					if(search == '') {
						$rows.show(); 
					} else {
						$rows.each(function(){
							var $this = $(this);
							$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
						})
						if($target.find('tbody tr:visible').size() === 0) {
							var col_count = $target.find('tr').first().find('td').size();
							var no_results = $('<tr class="filterTable_no_results"><td colspan="'+col_count+'">No results found</td></tr>')
							$target.find('tbody').append(no_results);
						}
					}
				});
			});
		}
	});
	$('[data-action="filter"]').filterTable();
})(jQuery);

$(function(){
    // attach table filter plugin to inputs
	$('[data-action="filter"]').filterTable();
	
	$('.container').on('click', '.panel-heading span.filter', function(e){
		var $this = $(this), 
			$panel = $this.parents('.panel');
		
		$panel.find('.panel-body').slideToggle();
		if($this.css('display') != 'none') {
			$panel.find('.panel-body input').focus();
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
})

