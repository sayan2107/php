$(document).ready( function() {
 done();
});
 
function done() {
	  setTimeout( function() { 
	  updates(); 
	  done();
	  }, 200);
}
 
function updates() {
	 $.getJSON("php/fetch.php", function(data) {
       $("ul").empty();
	   $.each(data.result, function(){
	    $("ul").append("<li>Name: "+this['name']+"</li><li>Age: " +this['age']+"</li><li>Company: "+this['company']+"</li><li>Sex: "+this['sex']+"</li><br>");
	   });
 });
}