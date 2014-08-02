function invertB(arg){
    return !arg;
}

function ajaxCall(url , values , callback){
    $.ajax({
	dataType: "JSON",
	type: "POST" ,
	cache : false , 
	data: values ,
	url: url ,
	success: function(result) {
	    callback(result);
	}
    });
}
