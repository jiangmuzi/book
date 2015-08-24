<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    
    $siteMail = new Typecho_Widget_Helper_Form_Element_Text('siteMail', null, 'sisome@qq.com', _t('站点邮箱'), _t('站点邮箱，显示Gravatar头像'));
    $form->addInput($siteMail);
    
    $icpNum = new Typecho_Widget_Helper_Form_Element_Text('icpNum', NULL, NULL, _t('网站备案号'), _t('在这里填入网站备案号'));
    $form->addInput($icpNum);
    
    $siteStat = new Typecho_Widget_Helper_Form_Element_Textarea('siteStat', NULL, NULL, _t('统计代码'), _t('在这里填入网站统计代码'));
    $form->addInput($siteStat);
    
    //附件源地址
    $src_address = new Typecho_Widget_Helper_Form_Element_Text('src_add', NULL, NULL, _t('替换前地址'), _t('即你的附件存放地址，如http://www.yourblog.com/usr/uploads/'));
    $form->addInput($src_address);
    //替换后地址
    $cdn_address = new Typecho_Widget_Helper_Form_Element_Text('cdn_add', NULL, NULL, _t('替换后'), _t('即你的七牛云存储域名，如http://yourblog.qiniudn.com/'));
    $form->addInput($cdn_address);
    
    //默认缩略图
    $default = new Typecho_Widget_Helper_Form_Element_Text('default_thumb', NULL, '', _t('默认缩略图'),_t('文章没有图片时显示的默认缩略图，为空时表示不显示'));
    $form->addInput($default);
    //默认宽度
    $width = new Typecho_Widget_Helper_Form_Element_Text('thumb_width', NULL, '540', _t('缩略图默认宽度'));
    $form->addInput($width);
    //默认高度
    $height = new Typecho_Widget_Helper_Form_Element_Text('thumb_height', NULL, '324', _t('缩略图默认高度'));
    $form->addInput($height);
}


function showThumb($obj,$size=null,$link=false,$pattern='<div class="post-thumb"><a class="thumb" href="{permalink}" title="{title}" style="background-image:url({thumb})"></a></div>'){

    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $obj->content, $matches );
    $thumb = '';
    $options = Typecho_Widget::widget('Widget_Options');
    if(isset($matches[1][0])){
        $thumb = $matches[1][0];;
        if(!empty($options->src_add) && !empty($options->cdn_add)){
            $thumb = str_ireplace($options->src_add,$options->cdn_add,$thumb);
        }
        if($size!='full'){
            $thumb_width = $options->thumb_width;
            $thumb_height = $options->thumb_height;
    
            if($size!=null){
                $size = explode('x', $size);
                if(!empty($size[0]) && !empty($size[1])){
                    list($thumb_width,$thumb_height) = $size;
                }
            }
            $thumb .= '?imageView2/4/w/'.$thumb_width.'/h/'.$thumb_height;
        }
    }

	if(empty($thumb) && empty($options->default_thumb)){
	    return '';
	}else{
	    $thumb = empty($thumb) ? $options->default_thumb : $thumb;
	}
	if($link){
	    return $thumb;
	}
	echo str_replace(
	    array('{title}','{thumb}','{permalink}'),
	    array($obj->title,$thumb,$obj->permalink),
	    $pattern);
}
/**
 * 解析内容以实现附件加速
 * @access public
 * @param string $content 文章正文
 * @param Widget_Abstract_Contents $obj
 */
function parseContent($obj){
    $options = Typecho_Widget::widget('Widget_Options');
    if(!empty($options->src_add) && !empty($options->cdn_add)){
        $obj->content = str_ireplace($options->src_add,$options->cdn_add,$obj->content);
    }
    echo trim($obj->content);
}
/**
 * 生成随机颜色值
 * @return string
 */
function randColor(){
    return rand(120,200).','.rand(120,200).','.rand(120,200);
}
/**
 * 显示标签
 * @param string $parse 解析模版
 * @param number $limit 显示条数 为0时表示显示全部
 * @param string $sort 排序字段
 * @param number $desc 默认为0,表示倒序
 * @return void
 */
function showTagCloud($parse=null,$limit=30,$sort='mid',$desc=0){
    $parse = is_null($parse) ? '<li><a href="{permalink}" title="{count}个话题" style="{background}">{name}({count})</a></li>': $parse;
    Typecho_Widget::widget('Widget_Metas_Tag_Cloud', 'sort='.$sort.'&ignoreZeroCount=1&desc='.$desc.'&limit='.$limit)->to($tags);
    $output = '';
    if($tags->have()){
        while ($tags->next()){
            $color = 'color: rgb('.randColor().');';
            $background = 'background-'.$color;
            $output .= str_replace(
                array('{permalink}','{count}','{name}','{background}','{color}'),
                array($tags->permalink,$tags->count,$tags->name,$background,$color),
                $parse);
        }
    }
    echo $output;
}

/**
 * 重写评论显示函数
 */
function threadedComments($comments, $singleCommentOptions){
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }

$commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';

?>
<li itemscope itemtype="http://schema.org/UserComments" id="<?php $comments->theId(); ?>" class="comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    echo $commentClass;
?>">
    <div class="comment-author" itemprop="creator" itemscope itemtype="http://schema.org/Person">
        <span itemprop="image"><?php $comments->gravatar($singleCommentOptions->avatarSize, $singleCommentOptions->defaultAvatar); ?></span>
        <cite class="fn" itemprop="name" title="<?php $singleCommentOptions->beforeDate();
        $comments->date($singleCommentOptions->dateFormat);
        $singleCommentOptions->afterDate(); ?>"><?php $singleCommentOptions->beforeAuthor();
        $comments->author();
        $singleCommentOptions->afterAuthor(); _e('：');?></cite>
    </div>
    <div class="comment-meta">
        <?php if ('waiting' == $comments->status) { ?>
        <em class="comment-awaiting-moderation"><?php $singleCommentOptions->commentStatus(); ?></em>
        <?php } ?>
    </div>
    <div class="comment-content" itemprop="commentText">
    <?php $comments->content(); ?>
    </div>
    <div class="comment-reply">
        <?php $comments->reply($singleCommentOptions->replyWord); ?>
    </div>
    <?php if ($comments->children) { ?>
    <div class="comment-children" itemprop="discusses">
        <?php $comments->threadedComments(); ?>
    </div>
    <?php } ?>
</li>
<?php
    }