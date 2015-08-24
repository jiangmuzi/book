<?php
/**
 * Lofter主题：簿
 * 
 * @package Book
 * @author 绛木子
 * @version 1.0
 * @link http://lixianhua.com
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>
<div id="main" role="main">
	<?php while($this->next()): ?>
	   <div class="box-bar"></div>
        <article class="post box" itemscope itemtype="http://schema.org/BlogPosting">
            <h2 class="post-title"><a href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h2>
            <?php $thumb = showThumb($this,null,true); if(!empty($thumb)):?>
                <div class="post-thumb">
        			<a class="thumb" href="<?php $this->permalink() ?>" style="background-image:url(<?php echo $thumb;?>)"></a>
                </div>
            <?php endif;?>
            <div class="post-content">
    			<?php $this->excerpt(); ?>
            </div>
            <ul class="post-meta">
                <li title="<?php _e('时间'); ?>"><time itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
				<li>
				    <a href="<?php $this->permalink() ?>"><?php _e('阅读：'); ?><?php $this->viewsNum(); ?></a>
				    <a href="<?php $this->permalink() ?>#comments"><?php _e('评论：'); ?><?php $this->commentsNum('%d'); ?></a>
				</li>
				<li title="<?php _e('分类');?>"><?php $this->category(','); ?></li>
			</ul>
        </article>
	<?php endwhile; ?>
    <div class="box-bar"></div>
    <ul class="post-foot box">
        <li class="prev" title="<?php _e('上一页');?>"><?php $this->pageLink('上一页','prev');?></li>
        <li class="top" title="<?php _e('返回顶部');?>"><a class="go-top" href="#">返回顶部</a></li>
        <li class="next" title="<?php _e('下一页');?>"><?php $this->pageLink('下一页','next');?></li>
    </ul>
</div><!-- end #main-->
<?php $this->need('footer.php'); ?>
