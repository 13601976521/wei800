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

$(function(){
	$('.alert').alert();
});