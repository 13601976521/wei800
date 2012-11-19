var CDWeixin = {};
CDWeixin.addContact = function(wxid, cb) { 
	if (typeof WeixinJSBridge == 'undefined') return false;
	WeixinJSBridge.invoke('addContact', {
		webtype: '1',
		username: wxid
	}, function(d) {
		// 返回d.err_msg取值，d还有一个属性是err_desc
		// add_contact:cancel 用户取消
		// add_contact:fail　关注失败
		// add_contact:ok 关注成功
		// add_contact:added 已经关注
		WeixinJSBridge.log(d.err_msg);
		cb && cb(d.err_msg);
	});
};

CDWeixin.shareToWeixinFriend = function(data, cb){
	if (typeof WeixinJSBridge == 'undefined') return false;
	WeixinJSBridge.invoke('shareTimeline', {
		'img_url': data.img_url || '',
		'link': data.link,
		'desc': data.desc,
		'title': data.title
	}, function(d) {
		// 返回d.err_msg取值，d还有一个属性是err_desc
		// share_timeline:cancel 用户取消
		// share_timeline:fail　发送失败
		// share_timeline:confirm 发送成功
		WeixinJSBridge.log(d.err_msg);
		cb && cb(d.err_msg);
	});
};

CDWeixin.sendViewStats = function(postid, url){
	var jqXhr = $.ajax({
		type: 'post',
		dataType: 'jsonp',
		url: url,
		cache: false,
		data: {postid: postid}
	});
	jqXhr.done(function(data){
		// alert(data);
	});
};

CDWeixin.sendShareFriendStats = function(postid, url, msg){
	var jqXhr = $.ajax({
		type: 'post',
		dataType: 'jsonp',
		url: url,
		cache: false,
		data: {postid: postid, msg: msg}
	});
	jqXhr.done(function(data){
		//alert(data.msg);
	});
};

CDWeixin.sendFollowStats = function(postid, wxid, url, msg){
	var jqXhr = $.ajax({
		type: 'post',
		dataType: 'jsonp',
		url: url,
		cache: false,
		data: {postid: postid, wxid: wxid, msg: msg}
	});
	jqXhr.done(function(data){
		//alert(data.msg);
	});
};



