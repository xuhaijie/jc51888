$(function() {
	$('input').filter(function(index){
		return $(this).attr("type")!="checkbox" && $(this).attr("type")!="radio";
	}).css({"min-width":"70px"}).tooltip()
});