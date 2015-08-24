<?php
/**
 * 链接页
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div id="main" role="main">
    <div class="box-bar"></div>
    <article class="post box" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <ul class="tag-list">
                <?php Links_Plugin::output(null,0,'');?>
            </ul>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->
<?php $this->need('footer.php'); ?>
