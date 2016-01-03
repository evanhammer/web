<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n"; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="author" content="Evan Hammer" />
	<meta name="keywords" content="<?php 
		requireFileOrDefault('page-specific/keywords/' . $pageName . '.txt', 'page-specific/keywords/index.txt');
	?>" />
	<meta name="description" content="<?php 
		requireFileOrDefault('page-specific/description/' . $pageName . '.txt', 'page-specific/description/index.txt');
	?>" />
	<meta name="ROBOTS" content="<?php 
		requireFileOrDefault('page-specific/robots/' . $pageName . '.txt', 'page-specific/robots/index.txt');
	?>" />
	<meta name="copyright" content="Evan Hammer 2007-2008" />
	<meta name="CONTENT-LANGUAGE" content="EN" />
	<meta name="revisit-after" content="30 days" />

	<title><?php 
		requireFileOrDefault('page-specific/title/' . $pageName . '.txt', 'page-specific/title/index.txt'); 
	?></title>

	<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="/js/jquery.rightClick.js"></script>
	<script type="text/javascript" src="/js/swfobject.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
	<script type="text/javascript" src="/js/niftyplayer.js"></script>
	<script type="text/javascript" src="/js/myplayer.js.php"></script>

	<link rel="alternate" type="application/rss+xml" title="Evan Hammer's Updates" href="http://www.evanhammer.com/blog/category/news/feed/" />
	<link rel="shortcut icon" href="/images/favicon.ico" />
	<style type="text/css" title="currentStyle" media="screen">
		@import "/css/style.css";
	</style>
	
	<!-- openid section -->
	<link rel="openid.server" href="http://www.myopenid.com/server" />
	<link rel="openid.delegate" href="http://evanhammer.myopenid.com/" />
	<link rel="openid2.local_id" href="http://evanhammer.myopenid.com" />
	<link rel="openid2.provider" href="http://www.myopenid.com/server" />
	<meta http-equiv="X-XRDS-Location" content="http://www.myopenid.com/xrds?username=evanhammer.myopenid.com" />



	<!-- ie style hacks -->
	<!--[if lt IE 7]>  
		<link rel="stylesheet" type="text/css" href="/css/ie6.css" />  
	<![endif]--> 

</head>