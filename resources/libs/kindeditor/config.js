var weixinHtmlTags = {
    span: ['.color', '.text-decoration', '.font-weight', '.font-size', '.background-color'],
    div: [
        'align', '.border', '.margin', '.padding', '.text-align', '.color',
        '.background-color', '.font-size', '.font-weight', '.background',
        '.font-style', '.text-decoration', '.vertical-align', '.margin-left'
    ],
    a: ['href', 'target', 'name'],
    img: ['src', 'width', 'height', 'border', 'alt', 'title', 'align', '.width', '.height'],
    'p,ol,ul,li,blockquote,h1,h2,h3,h4,h5,h6': [
        'align', '.text-align', '.color', '.background-color', '.font-size', '.background',
        '.font-weight', '.font-style', '.text-decoration', '.vertical-align', '.text-indent', '.margin-left'
    ],
    pre: ['class'],
    'hr,br,strong,b,sub,sup,em,i,u,s,strike': []
};

var summaryHtmlTags = {
    span: ['.color', '.text-decoration', '.font-weight'],
    a: ['href', 'target', 'name'],
    embed: ['src', 'width', 'height', 'type', 'loop', 'autostart', 'quality', '.width', '.height', 'align', 'allowscriptaccess'],
    img: ['src', 'width', 'height', 'border', 'alt', 'title', 'align', '.width', '.height'],
    p: ['align', '.text-align'],
    'div,strong,b,sub,sup,em,i,u,s,strike': []
};

var contentHtmlTags = {
    span: ['.color', '.text-decoration', '.font-weight', '.font-size'],
    div: [
        'align', '.border', '.margin', '.padding', '.text-align', '.color',
        '.background-color', '.font-size', '.font-family', '.font-weight', '.background',
        '.font-style', '.text-decoration', '.vertical-align', '.margin-left'
    ],
    table: [
        'border', 'cellspacing', 'cellpadding', 'width', 'height', 'align', 'bordercolor',
        '.padding', '.margin', '.border', 'bgcolor', '.text-align', '.color', '.background-color',
        '.font-size', '.font-family', '.font-weight', '.font-style', '.text-decoration', '.background',
        '.width', '.height'
    ],
    'td,th': [
        'align', 'valign', 'width', 'height', 'colspan', 'rowspan', 'bgcolor',
        '.text-align', '.color', '.background-color', '.font-size', '.font-family', '.font-weight',
        '.font-style', '.text-decoration', '.vertical-align', '.background'
    ],
    a: ['href', 'target', 'name'],
    embed: ['src', 'width', 'height', 'type', 'loop', 'autostart', 'quality', '.width', '.height', 'align', 'allowscriptaccess', 'flashvars'],
    img: ['src', 'width', 'height', 'border', 'alt', 'title', 'align', '.width', '.height'],
    'p,ol,ul,li,blockquote,h1,h2,h3,h4,h5,h6': [
        'align', '.text-align', '.color', '.background-color', '.font-size', '.font-family', '.background',
        '.font-weight', '.font-style', '.text-decoration', '.vertical-align', '.text-indent', '.margin-left'
    ],
    pre: ['class'],
    'hr,br,tbody,tr,strong,b,sub,sup,em,i,u,s,strike': []
};

var KEConfig = {
	weixin: {
        resizeType: 1,
		allowFileManager: false,
		allowUpload: true,
		filterMode: true,
		allowImageUpload: true,
		allowFlashUpload: false,
		allowMediaUpload: false,
		htmlTags: weixinHtmlTags,
		bodyClass: 'cd-ke-content cd-post-content',
		items: ['source', '|', 'undo', 'redo', '|', 'plainpaste', 'wordpaste', 'fontsize', 'forecolor', 'hilitecolor', 'insertorderedlist',
	        'insertunorderedlist', 'bold', 'italic', 'underline', 'strikethrough', '|', 'justifyleft', 'justifycenter', 'justifyright',  '|', 'image',
	        'link', 'unlink', 'selectall', 'clearhtml', 'removeformat']
	},
	mini: {
        resizeType: 1,
		allowFileManager: false,
		allowUpload: true,
		filterMode: true,
		allowImageUpload: true,
		allowFlashUpload: false,
		allowMediaUpload: false,
		htmlTags: summaryHtmlTags,
		bodyClass: 'cd-ke-content cd-post-content',
		items: ['source', '|', 'undo', 'redo', '|', 'plainpaste', 'wordpaste', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'insertorderedlist',
	        'insertunorderedlist', 'bold', 'italic', 'underline', 'strikethrough', '|', 'image', 'flash', 'media',
	        'link', 'unlink', 'selectall', 'clearhtml', 'removeformat']
	},
	common: {
        resizeType: 1,
		allowFileManager: false,
		allowUpload: true,
		filterMode: true,
		allowImageUpload: true,
		allowFlashUpload: false,
		allowMediaUpload: false,
		htmlTags: contentHtmlTags,
		bodyClass: 'cd-ke-content cd-post-content',
		items: ['undo', 'redo', '|', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste',
	        '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'link', 'unlink', 'selectall', 'clearhtml', 'removeformat', 'quickformat',
	        '/', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough',
	        '|', 'image', 'flash', 'media', 'table', 'code', 'hr', 'emoticons', 'fullscreen', 'preview', '|', 'source']
	},
	adminmini: {
        resizeType: 1,
		allowFileManager: false,
		allowUpload: true,
		filterMode: true,
		allowImageUpload: true,
		allowFlashUpload: true,
		allowMediaUpload: true,
		htmlTags: summaryHtmlTags,
		bodyClass: 'cd-ke-content cd-post-content',
		items: ['source', '|', 'undo', 'redo', '|', 'plainpaste', 'wordpaste', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'insertorderedlist',
	        'insertunorderedlist', 'bold', 'italic', 'underline', 'strikethrough',
	        '|', 'image', 'flash', 'media', 'link', 'unlink',
	        '|', 'selectall', 'clearhtml', 'removeformat']
	},
	adminfull: {
        resizeType: 1,
		allowFileManager: true,
		allowUpload: true,
		filterMode: true,
		allowImageUpload: true,
		allowFlashUpload: true,
		allowMediaUpload: true,
		htmlTags: contentHtmlTags,
		bodyClass: 'cd-ke-content cd-post-content',
		items: ['source', '|', 'undo', 'redo', '|', 'cut', 'copy', 'paste', 'plainpaste', 'wordpaste',
	        '|', 'justifyleft', 'justifycenter', 'justifyright', 'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript', 'superscript', '|', 'link', 'unlink', 'selectall', 'clearhtml', 'removeformat', 'quickformat',
	        '/', 'fontname', 'fontsize', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline', 'strikethrough',
	        '|', 'image', 'flash', 'media', 'table', 'hr', 'emoticons',
	        '|', 'map', 'code', 'pagebreak',
	        '|', 'fullscreen', 'preview']

	}
};

