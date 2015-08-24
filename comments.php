<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="box-bar"></div>
    <div class="box">
<div id="comments">
    <?php $this->comments()->to($comments); ?>
    <?php if($this->allow('comment')): ?>
    <h2>发表评论</h2>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
        <?php $comments->cancelReply(); ?>
        </div>
    	<form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" role="form">
    		<p>
                <textarea cols="50" name="text" id="textarea" class="textarea" required ><?php $this->remember('text'); ?></textarea>
            </p>
    		<div class="comment-form-meta">
    		    <?php if($this->user->hasLogin()): ?>
        		<p><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></p>
                <?php else: ?>
        		<p>
                    <label for="author" class="required"><?php _e('称呼'); ?></label>
        			<input type="text" name="author" id="author" class="text" value="<?php $this->remember('author'); ?>" required />
        		</p>
        		<p>
                    <label for="mail"<?php if ($this->options->commentsRequireMail): ?> class="required"<?php endif; ?>><?php _e('Email'); ?></label>
        			<input type="email" name="mail" id="mail" class="text" value="<?php $this->remember('mail'); ?>"<?php if ($this->options->commentsRequireMail): ?> required<?php endif; ?> />
        		</p>
        		<p>
                    <label for="url"<?php if ($this->options->commentsRequireURL): ?> class="required"<?php endif; ?>><?php _e('网站'); ?></label>
        			<input type="url" name="url" id="url" class="text" placeholder="<?php _e('http://'); ?>" value="<?php $this->remember('url'); ?>"<?php if ($this->options->commentsRequireURL): ?> required<?php endif; ?> />
        		</p>
                <?php endif; ?>
                <button type="submit" class="submit"><?php _e('提交评论'); ?>
            </div>
            
    	</form>
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
    
    <?php if ($comments->have()): ?>
	<h2><?php $this->commentsNum(_t('评论(%d)')); ?></h2>
    
    <?php $comments->listComments(); ?>

    <?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
    
    <?php endif; ?>
</div>
</div>