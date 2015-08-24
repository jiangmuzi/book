<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main" role="main">
    <div class="box-bar"></div>
    <h3 class="archive-title box">
        <a href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a> &raquo;</li>
		<?php if ($this->is('index')): ?><!-- 页面为首页时 -->
			Latest Post
		<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
			<?php $this->category(); ?> &raquo; <?php $this->title() ?>
		<?php else: ?><!-- 页面为其他页时 -->
			<?php $this->archiveTitle(' &raquo; ','',''); ?>
		<?php endif; ?>
    </h3>
    <div class="box-bar"></div>
    <article class="post box" itemscope itemtype="http://schema.org/BlogPosting">
        <h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
        <div class="post-content">
			<?php parseContent($this); ?>
        </div>
        <ul class="post-meta">
            <li title="<?php _e('时间'); ?>"><time itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
			<li>
			    <a href="<?php $this->permalink() ?>"><?php _e('阅读：'); ?><?php $this->viewsNum(); ?></a>
			    <a href="<?php $this->permalink() ?>#comments"><?php _e('评论：'); ?><?php $this->commentsNum('%d'); ?></a>
			</li>
			<li title="<?php _e('分类'); ?>"><?php $this->category(','); ?></li>
			<?php if(!empty($this->tags)):?>
			<li title="<?php _e('标签'); ?>"><?php $this->tags(', ', true, 'none'); ?></li>
			<?php endif;?>
		</ul>
    </article>
    <?php $this->need('comments.php'); ?>
    <div class="box-bar"></div>
    <ul class="post-foot box">
        <li class="prev"><?php $this->thePrev('%s',''); ?></li>
        <li class="top"><a class="go-top" href="#">返回顶部</a></li>
        <li class="next"><?php $this->theNext('%s',''); ?></li>
    </ul>    
</div><!-- end #main-->
<?php $this->need('footer.php'); ?>
