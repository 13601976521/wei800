var CDAdmin = {};

CDAdmin.changeWeixinState = function(url, success){
	if (url.length == 0 && CDBasic.urlValidate(url)) return false;
	var jqXhr = $.ajax({
		type: 'post',
		dataType: 'jsonp',
		url: url,
		beforeSend: function(){}
	});
	
	success && jqXhr.done(success);
};

CDAdmin.deleteRow = function(url, data, success, before, fail) {
	if (url.length == 0 && CDBasic.urlValidate(url)) return false;
	var jqXhr = $.ajax({
		type: 'post',
		dataType: 'jsonp',
		url: url,
		data: data || {},
		beforeSend: before || function(){}
	});
	
	success && jqXhr.done(success);
	fail && jqXhr.fail(fail);
};

$(function(){
	$('.alert').alert();
});