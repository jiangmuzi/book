<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
</div><!-- end #body -->

<footer id="footer" role="contentinfo">
    &copy; <?php echo date('Y'); ?> <a href="<?php $this->options->siteUrl(); ?>"><?php $this->options->title(); ?></a>.
    <?php _e('Powered by <a href="http://www.typecho.org" target="_blank">Typecho</a>'); ?>.
    <?php _e('Theme by <a href="http://lixianhua.com" target="_blank">绛木子</a>'); ?>.
    <?php if ($this->options->icpNum): ?>
    <a href="http://www.miitbeian.gov.cn/" target="blank"><?php $this->options->icpNum(); ?></a>
    <?php endif; ?>
</footer><!-- end #footer -->
</div>
<?php $this->footer(); ?>
<script>
$(function(){
	$('#srh-btn').click(function(){
	    var srh = $('#search');
	    if(srh.hasClass('active')){
	        srh.removeClass('active');
		}else{
			srh.addClass('active');
		}
		return false;
	});
	$('.go-top').click(function() {
        $("html, body").animate({ scrollTop: 0 }, 120);
        return false;
	});
	// 锚点平滑滚动
    $( document ).on( "click", "a[data-scroll]", function() {
        var href = $.attr( this, "href" );
        $("html, body").animate( {
            scrollTop: $( href ).offset().top
        }, 500, function() {
            window.location.hash = href;
        } );
        return false;
    } );
});
</script>
</body>
</html>
