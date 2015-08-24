<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类 %s 下的文章'),
            'search'    =>  _t('包含关键字 %s 的文章'),
            'tag'       =>  _t('标签 %s 下的文章'),
            'author'    =>  _t('%s 发布的文章')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <!-- 使用url函数转换相关路径 -->
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    <script src="http://apps.bdimg.com/libs/jquery/1.11.1/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="http://cdn.staticfile.org/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
    <?php if ($this->options->siteStat): ?><?php $this->options->siteStat(); ?><?php endif; ?>
</head>
<body>
<!--[if lt IE 8]>
    <div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->
<div class="wallpapers"></div>
<div id="wrapper" class="">
<header id="header" class="clearfix">
    <div class="site-name">
        <h1><a id="logo" href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title() ?></a></h1>
        <?php if($this->options->siteMail):?>
        <p class="avatar">
            <a href="<?php $this->options->siteUrl(); ?>"><img src="<?php echo TeGravatar_Plugin::gravatarUrl($this->options->siteMail,80); ?>"></a>
        </p>
        <?php endif;?>
	    <p class="description"><?php $this->options->description() ?></p>
    </div>
    <div class="site-search">
        <form id="search" method="post" action="./" role="search">
            <label for="s" class="sr-only"><?php _e('搜索关键字'); ?></label>
            <input type="text" name="s" class="text" placeholder="<?php _e('输入关键字搜索'); ?>" />
            <button type="submit" class="submit"><?php _e('搜索'); ?></button>
        </form>
    </div>
    <nav id="nav-menu" class="clearfix" role="navigation">
        <a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a>
        <?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
        <?php while($pages->next()): ?>
        <a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a>
        <?php endwhile; ?>
        <a id="srh-btn" href="#"><?php _e('搜索');?></a>
    </nav>
</header><!-- end #header -->
<div id="body">


    
    
