var CDBasic = {};
CDBasic.urlValidate = function(url) {
	var pattern = /http:\/\/[\w-]*(\.[\w-]*)+/ig;
	return pattern.test(url);
};
CDBasic.emailValidate = function(email) {
	var pattern = /^[\w-]+(\.[\w-]+)*@[\w-]+(\.[\w-]+)+$/ig;
	return pattern.test(email);
};