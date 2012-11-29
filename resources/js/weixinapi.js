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

CDWeixin.sendViewStats = function(data){
	if (typeof WeixinJSBridge == 'undefined') return false;
	var url = data.viewStatsUrl + '&t=' + (new Date).getTime();
	new Image().src = url;
};

CDWeixin.sendShareFriendStats = function(data, msg){
	var url = data.shareUrl + '&msg=' + msg + '&t=' + (new Date).getTime();
	new Image().src = url;
};

CDWeixin.sendFollowStats = function(data, wxid, msg){
	var url = data.followUrl + '&wxid=' + wxid + '&msg=' + msg + '&t=' + (new Date).getTime();
	new Image().src = url;
};

$(function(){
	setTimeout(function(){CDWeixin.sendViewStats(wxdata);}, 1000);
	
	$('[data-action=cd-follow]').on('click', function(event){
    	var originalWxid = this.getAttribute('data-wxid');
    	var wxid = this.getAttribute('data-id');
    	if (typeof originalWxid != 'undefined' && originalWxid.length > 0)
    	    CDWeixin.addContact(originalWxid, function(msg){
        	    CDWeixin.sendFollowStats(wxdata, wxid, msg);
    	    });
	});
	
	$('[data-action=cd-share]').on('click', function(event){
	    CDWeixin.shareToWeixinFriend(wxdata, function(msg){alert(msg);
	    	CDWeixin.sendShareFriendStats(wxdata, msg);
	    });
	});
});

