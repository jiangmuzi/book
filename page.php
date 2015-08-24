<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div id="main" role="main">
    <div class="box-bar"></div>
    <article class="post box" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 class="post-title" itemprop="name headline"><a itemtype="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h1>
        <div class="post-content" itemprop="articleBody">
            <?php if($this->is('page','tags')):?>
                <ul class="tag-list">
                    <?php showTagCloud('<li><a href="{permalink}">{name}({count})</a></li>',0,'count',1);?>
                </ul>
            <?php elseif($this->is('page','archives')):?>
                <?php 
                    $stat = Typecho_Widget::widget('Widget_Stat');
                    Typecho_Widget::widget('Widget_Contents_Post_Recent', 'pageSize='.$stat->publishedPostsNum)->to($archives);
                    $year=0; $mon=0; $i=0; $j=0;
                    $output = '<div class="archives">';
                    while($archives->next()){
                        $year_tmp = date('Y',$archives->created);
                        $mon_tmp = date('m',$archives->created);
                        $y=$year; $m=$mon;
                        if ($year > $year_tmp || $mon > $mon_tmp) {
                            $output .= '</ul></div>';
                        }
                        if ($year != $year_tmp || $mon != $mon_tmp) {
                            $year = $year_tmp;
                            $mon = $mon_tmp;
                            $output .= '<div class="archives-item"><h2>'.date('Y年m月',$archives->created).'</h2><ul class="archives_list">'; //输出年份
                        }
                        $output .= '<li>'.date('d日',$archives->created).' <a href="'.$archives->permalink .'">'. $archives->title .'</a></li>'; //输出文章
                    }
                    $output .= '</ul></div></div>';
                    echo $output;
                ?>
            <?php elseif($this->is('page','links')):?>
            <ul class="tag-list flinks">
            <?php Links_Plugin::output(null,0,'');?>
        </ul>
            <?php else:?>
            <?php $this->content(); ?>
            
            <?php endif;?>
        </div>
    </article>
    <?php $this->need('comments.php'); ?>
</div><!-- end #main-->
<?php $this->need('footer.php'); ?>
