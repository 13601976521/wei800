<?php
define('CD_YES', 1);
define('CD_NO', 0);

define('TABLE_POST', '{{post}}');
define('TABLE_POST_WEIXIN', '{{post_weixin}}');
define('TABLE_COMMENT', '{{comment}}');
define('TABLE_CATEGORY', '{{category}}');
define('TABLE_CONFIG', '{{config}}');
define('TABLE_TAG', '{{tag}}');
define('TABLE_WEIXIN', '{{weixin}}');
define('TABLE_WEIXIN_TAG', '{{weixin_tag}}');
define('TABLE_USER', '{{user}}');
define('TABLE_USER_PROFILE', '{{user_profile}}');
define('TABLE_LINK', '{{link}}');
define('TABLE_ADVERT', '{{advert}}');
define('TABLE_ADCODE', '{{adcode}}');
define('TABLE_ADWEIXIN', '{{adweixin}}');

/* comment state */
define('COMMENT_STATE_NOT_VERIFY', -1);
define('COMMENT_STATE_DISABLED', 0);
define('COMMENT_STATE_ENABLED', 1);
/* comment rating */
define('COMMENT_RATING_SUPPORT', 1);
define('COMMENT_RATING_AGAINST', 2);
define('COMMENT_RATING_REPORT', 3);
/* user state */
define('USER_STATE_UNVERIFY', 0);
define('USER_STATE_ENABLED', 1);
define('USER_STATE_FORBIDDEN', -1);
/* advert state */
define('ADVERT_STATE_DISABLED', 0);
define('ADVERT_STATE_ENABLED', 1);
/* advert state */
define('ADCODE_STATE_DISABLED', 0);
define('ADCODE_STATE_ENABLED', 1);
/* weixin state */
define('WEIXIN_STATE_DISABLED', 0);
define('WEIXIN_STATE_ENABLED', 1);
/* adweixin state */
define('ADWEIXIN_STATE_DISABLED', 0);
define('ADWEIXIN_STATE_ENABLED', 1);

/* upload type */
define('UPLOAD_TYPE_UNKNOWN', 0);
define('UPLOAD_TYPE_PICTURE', 1);
define('UPLOAD_TYPE_FILE', 2);
define('UPLOAD_TYPE_AUDIO', 3);
define('UPLOAD_TYPE_VIDEO', 4);

define('TAG_DIVIDER', ',');
define('ADWEIXIN_DIVIDER', ',');

define('ROOT_CATEGORY_ID', 0);

/* post type */
define('POST_TYPE_ONE', 0);
define('POST_TYPE_GROUP', 1);
define('POST_GROUP_ID_DIVIDER', ',');







