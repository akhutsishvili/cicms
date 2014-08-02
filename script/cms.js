
var jsonData;
var form_cnt = 1;
var formCond = false;
var baseurl = $('body').attr('baseurl');
var tableName = $('#table-name-input').val();

function invertB(arg) {
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

var offset = 0;
function normalPaging() {
    $.ajax({
        dataType: "html",
        type: "GET",
        //data: data ,
        url: baseurl + "index.php/cms/ajax_get_table/" + tableName + "/" + offset,
        success: function(result) {
            $('#view-table').html(result);
        }
    });
}

$(document).on('click', '.next', function() {
    offset += 5;
    normalPaging();
});
$(document).on('click', '.previous', function() {
    if (offset > 0) {
        offset -= 5;
        normalPaging();
    }
});





function csvRelation(table, column, value) {
    $('#csv-' + column).append('<div><a href="' + baseurl + 'index.php/cms/form/' + column + '/' + value + '">' + $("#csv-dropdown-" + column + ">option:selected").html() + '</a> <span class="rm-csv" col="' + column + '" value="' + value + '"> [X]</span></div> ');
    $('#csv-form-' + column).val($('#csv-form-' + column).val() + ',' + value);
}

$(document).on('click', '.rm-csv', function() {
    var val = $(this).attr('value');
    var col = $(this).attr('col');
    var backToInput = '';
    $(this).parent().remove();
    $('#csv-' + col).find('div').each(function() {
        backToInput += ',' + $(this).find('.rm-csv').attr('value');
    });
    $('#csv-form-' + col).val(backToInput);
});




function filterPaging(data) {
    data = {"filters": data};
    console.log(data);
    $.ajax({
        dataType: "html",
        type: "POST",
        data: data,
        url: baseurl + "index.php/cms/ajax_filter_table/" + tableName + "/" + offset,
        success: function(result) {
            $('#view-table').html(result);
        }
    });

}


$(document).on('click', '#view-filter-btn', function() {
    var filterData = "[";
    $("#view-filters").children().find('input , select').each(function() {
        var name = $(this).attr('name');
        var val = $(this).val();
        if (val)
            filterData += '{"key": "' + name + '","value":"' + val + '"},';
    });
    filterData = filterData.substring(0, filterData.length - 1);
    if(filterData)
	filterData += "]";
    //console.log(filterData);
    offset = 0;
    filterPaging(filterData);
});


$(document).on('change', '.dropdown-json', function() {
    var jsonDiv = $(this).parent();
    var json = "[";
    jsonDiv.parent().find('div').each(function() {
        var inpVal = $(this).find('.input-json').val();
        var dropVal = $(this).find('.dropdown-json').val();
        if (dropVal)
            json += '{"key": "' + dropVal + '","value":"' + inpVal + '"},';
    });
    json = json.substring(0, json.length - 1);
    json += ']';
    jsonDiv.parent().find('.json-form').val(json);

});
$(document).on('change', '.input-json', function() {
    $('.dropdown-json').trigger('change');
});
$('.add-json').click(function() {
    $(this).parent().css('border', '1px solid black');
    var dropClone = $(this).parent().find('.json').find('.dropdown-json').clone();
    var inputClone = $(this).parent().find('.json').find('.input-json').clone();
    $(this).parent().append('<div class="json">');
    $(this).parent().find('.json').last().append(dropClone[0]);
    $(this).parent().find('.json').last().append(inputClone[0]);
});

$('#addParameter').click(function() {
    $(this).parent().prepend('<input type="text" class="generated"/> - <input type="text" class="generated" /></br>');
});

$(document).on('click', '#add-file-form', function() {
    $('#add-file-form').parent().prepend('<input type="file" name="userfile_' + Date.now() + '"><br/>');

});
$(document).on('click', '.cms-file-delete', function() {
    var path = $(this).attr('path');
    var that = $(this);
    $.post(baseurl + "index.php/cms/file_remove", {p: path})
        .done(function(data) {
            that.parent().parent().remove();
        });
});


$(document).ready(function() {
    //$( "#datepicker" ).datepicker();
    //$('#datepicker').datepicker( "option", "dateFormat", 'yy-mm-dd' );
    tableName = $('#table-name-input').val();
    $('#content').css('visibility', 'hidden');
    baseurl = $('body').attr('baseurl');
    setTimeout(function() {

        $('textarea').css({'display': 'block', 'height': '30px'});
    }, 2000);

});

$(document).on('submit' , 'form' , function(){
    var arr = [];
    $('.json').each(function(){
	var value = $(this).val();
	var key = $(this).attr('id');
	
	console.log(key);
	var newObj = {};
	newObj[key] = value;
        arr.push(newObj);

    });
    var textJSON = JSON.stringify(arr);
    $('#json-string').html(textJSON);
});


/* development */


$(document).on('click' , '#other-filters' , function(){
    $('body').append('<div class="popup well"></div>');
    var url = baseurl + 'index.php/ajax/get_category_filters';
    ajaxCall(url , {} , writeFiltersToPopup);
    
    
});

function writeFiltersToPopup(json){
    var html = "<span class='glyphicon glyphicon-remove pull-right close-popup'></span>";
    console.log(Object.keys(json));
    for(var i in json){
	html += "<h4>"+i+"</h4>";
	var currObj = json[i];
	for(var j in currObj){
	    html += "<div><label>"+j+"</label> : ";
	    html += currObj[j]+"</div>";
	}
	html += "<br clear='all'/><button name='"+i+"' class='apply-filters pull-right'>დადასტურება</button><hr/>";
    }

    $(".popup").html(html);
}



$(document).on('click' , '.apply-filters' , function(){
    var categoryName = $(this).attr('name');
    console.log(categoryName);
    var arr = [];
    var newObj = {};
    $('.popup select').each(function(){
	if($(this).attr('category') == categoryName){
	    var value = $(this).val();
	    var key = $(this).attr('name');
	    newObj[key] = value;
	}
    });
    arr.push(newObj);
    var textJSON = JSON.stringify(arr);
    var entryId = $('input[name=id]').val();
    console.log(entryId);
    var url = baseurl + 'index.php/ajax/apply_category_filters';
    ajaxCall(url , { properties : textJSON , id : entryId } , checkReport);
});

function checkReport(obj){
    alert(obj.result);
}

$(document).on('click' , '.popup button' , function(){
    $('.close-popup').trigger('click');
});

$(document).on('click' , '.close-popup' , function(){
   $('.popup').fadeOut().remove();
});


$(function(){$('a').tooltip();});
