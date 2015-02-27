$(document).ready(function() {
	$('[data-toggle="tooltip"]').tooltip();

	$('td.cut-cell').text(function(i, text) {
	    var t = $.trim(text);
	    if (t.length > 30) {
	        return $.trim(t).substring(0, 30) + "...";
	    }
	    return t;
	});
});