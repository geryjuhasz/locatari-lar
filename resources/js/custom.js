$(document).ready(function() {
	$('.text-index-nou').change(function(){
	  	input_name = $(this).attr('name').replace('_index_nou', '');
		index_vechi = $("input[name='" + input_name + "_index_vechi']").val();
		var consum = $(this).val() - index_vechi;
		$("input[name='" + input_name + "_consum']").val(consum);
	});

	$('.text-consum').change(function(){
	  	input_name = $(this).attr('name').replace('_consum', '');
		index_vechi = $("input[name='" + input_name + "_index_vechi']").val();
		var index_nou = parseInt(index_vechi) + parseInt($(this).val());
		$("input[name='" + input_name + "_index_nou']").val(index_nou);
	});
});


$( function() {
	options = {
    	dateFormat: 'yy-mm-dd', // Default is 'mm/yyyy' and separator char is not mandatory
    	 monthNames: ['Ian', 'Feb', 'Mar', 'Apr', 'Mai', 'Iun', 'Iul', 'Aug', 'Sep', 'Oct', 'Noi', 'Dec']
	};
	$( "#datepicker" ).datepicker(options);
} );



