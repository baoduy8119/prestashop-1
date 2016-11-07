{capture name=path}<a href="{smartblog::GetSmartBlogLink('smartblog')}">{l s='All Blog News' mod='smartblog'}</a><span class="navigation-pipe">{$navigationPipe}</span>{$meta_title}{/capture}
<div id="content">
   <div itemtype="#" itemscope="" id="sdsblogArticle" class="blog-post">
  
      <div itemprop="articleBody">
            <div id="lipsum" class="articleContent">
                    {assign var="activeimgincat" value='0'}
                    {$activeimgincat = $smartshownoimg} 
                       <img src="{$modules_dir}/smartblog/images/{$post_img}.jpg" alt="{$meta_title}">
             </div>
			 
			 
			 
			 <div class="article-header">
				<div class="date_create">
					<span class="d">{$created|date_format:"%d"}</span>
					<span class="m">{$created|date_format:"%b"}</span>
				 </div>
				 <div class="article-title">{$meta_title}</div>
				 <div class="article-info">
				 {assign var="catOptions" value=null}
								{$catOptions.id_category = $id_category}
								{$catOptions.slug = $cat_link_rewrite}
								
					
					
					 <span class="author">{l s='By:' mod='smartblog'} {if $smartshowauthor ==1}<span itemprop="author">{if $smartshowauthorstyle != 0}{$firstname} {$lastname}{else}{$lastname} {$firstname}{/if}</span>{/if}</span>
					<span class="sep"></span>
					 <span itemprop="articleSection" class="cat">{l s='Category:' mod='smartblog'} <a href="{smartblog::GetSmartBlogLink('smartblog_category',$catOptions)}">{$title_category}</a></span>
				</div>
			 </div>
			 
            <div class="sdsarticle-des">
               {$content}
            </div>
			
			<div class="sdsarticle-bottom">
				
				{if $tags != ''}
					<label><i class="fa fa-tags"></i></label>
					<div class="sdstags-update">
							{foreach from=$tags item=tag}
								{assign var="options" value=null}
								{$options.tag = $tag.name}
								<a title="tag" href="{smartblog::GetSmartBlogLink('smartblog_tag',$options)}">{$tag.name}</a>
							{/foreach}
						</span>
					</div>
			   {/if}
			   
			</div>
			
			
            
      </div>
     
	 
      <div class="sdsarticleBottom">
        {$HOOK_SMART_BLOG_POST_FOOTER}
      </div>
   </div>

{if $countcomment != ''}
<div id="articleComments">
        <h3 class="">{if $countcomment != ''}{$countcomment}{else}{l s='0' mod='smartblog'}{/if}{l s=' Comments' mod='smartblog'}</h3>
        <div id="comments">      
            <div class="commentList">
                  {$i=1}
                {foreach from=$comments item=comment}
                    
                       {include file="./comment_loop.tpl" childcommnets=$comment}
                   
                  {/foreach}
            </div>
        </div>
</div>
 {/if}

</div>
{if Configuration::get('smartenablecomment') == 1}
{if $comment_status == 1}
<div class="smartblogcomments" id="respond">
    
    <h4 class="comment-reply-title" id="reply-title">{l s="LEAVE A COMMENT "  mod="smartblog"} <small style="float:right;">
                <a style="display: none;" href="/wp/sellya/sellya/this-is-a-post-with-preview-image/#respond" 
                   id="cancel-comment-reply-link" rel="nofollow">{l s="Cancel Reply"  mod="smartblog"}</a>
            </small>
        </h4>
		<div id="commentInput">
            <form action="" method="post" id="commentform">
				<div class="input">
					<input type="text" tabindex="1" class="inputName form-control grey" value="" name="name" placeholder="Name" >																	
				</div>
				<div class="input">
					<input type="text" tabindex="2" class="inputMail form-control grey" value="" name="mail" placeholder="Email">
				</div>
		
			<div class="clearfix content">
				<textarea tabindex="4" class="inputContent form-control grey" rows="3" cols="50" name="comment" placeholder="Your Comment" ></textarea>
			</div>
	{if Configuration::get('smartcaptchaoption') == '1'}
		<div class="capcha">
			
			<span class="required">*</span> <b>{l s="Type Code" mod="smartblog"}</b> </br>
			<img src="{$modules_dir}smartblog/classes/CaptchaSecurityImages.php?width=100&height=40&characters=5">
			<input type="text" tabindex="" value="" name="smartblogcaptcha" class="smartblogcaptcha form-control grey">
			
		</div>
	{/if}
	
                 <input type='hidden' name='comment_post_ID' value='1478' id='comment_post_ID' />
                  <input type='hidden' name='id_post' value='{$id_post}' id='id_post' />

                <input type='hidden' name='comment_parent' id='comment_parent' value='0' />

      
        <div class="submit">
            <input type="submit" name="addComment" id="submitComment" class="bbutton btn btn-default button-medium" value="Comment">
		</div>

        </form>

		</div>
</div>

<script type="text/javascript">
$('#submitComment').bind('click',function(event) {
event.preventDefault();
 
 
var data = { 'action':'postcomment', 
'id_post':$('input[name=\'id_post\']').val(),
'comment_parent':$('input[name=\'comment_parent\']').val(),
'name':$('input[name=\'name\']').val(),
'website':$('input[name=\'website\']').val(),
'smartblogcaptcha':$('input[name=\'smartblogcaptcha\']').val(),
'comment':$('textarea[name=\'comment\']').val(),
'mail':$('input[name=\'mail\']').val() };
	$.ajax( {
	  url: baseDir + 'modules/smartblog/ajax.php',
	  data: data,
	  
	  dataType: 'json',
	  
	  beforeSend: function() {
				$('.success, .warning, .error').remove();
				$('#submitComment').attr('disabled', true);
				$('#commentInput').before('<div class="attention"><img src="http://321cart.com/sellya/catalog/view/theme/default/image/loading.gif" alt="" />Please wait!</div>');

				},
				complete: function() {
				$('#submitComment').attr('disabled', false);
				$('.attention').remove();
				},
		success: function(json) {
			if (json['error']) {
					 
						$('#commentInput').before('<div class="warning">' + '<i class="icon-warning-sign icon-lg"></i>' + json['error']['common'] + '</div>');
						
						if (json['error']['name']) {
							$('.inputName').after('<span class="error">' + json['error']['name'] + '</span>');
						}
						if (json['error']['mail']) {
							$('.inputMail').after('<span class="error">' + json['error']['mail'] + '</span>');
						}
						if (json['error']['comment']) {
							$('.inputContent').after('<span class="error">' + json['error']['comment'] + '</span>');
						}
						if (json['error']['captcha']) {
							$('.smartblogcaptcha').after('<span class="error">' + json['error']['captcha'] + '</span>');
						}
					}
					
					if (json['success']) {
						$('input[name=\'name\']').val('');
						$('input[name=\'mail\']').val('');
						$('input[name=\'website\']').val('');
						$('textarea[name=\'comment\']').val('');
				 		$('input[name=\'smartblogcaptcha\']').val('');
					
						$('#commentInput').before('<div class="success">' + json['success'] + '</div>');
						setTimeout(function(){
							$('.success').fadeOut(300).delay(450).remove();
													},2500);
					
					}
				}
			} );
		} );
		
 




    var addComment = {
	moveForm : function(commId, parentId, respondId, postId) {

		var t = this, div, comm = t.I(commId), respond = t.I(respondId), cancel = t.I('cancel-comment-reply-link'), parent = t.I('comment_parent'), post = t.I('comment_post_ID');

		if ( ! comm || ! respond || ! cancel || ! parent )
			return;
 
		t.respondId = respondId;
		postId = postId || false;

		if ( ! t.I('wp-temp-form-div') ) {
			div = document.createElement('div');
			div.id = 'wp-temp-form-div';
			div.style.display = 'none';
			respond.parentNode.insertBefore(div, respond);
		}


		comm.parentNode.insertBefore(respond, comm.nextSibling);
		if ( post && postId )
			post.value = postId;
		parent.value = parentId;
		cancel.style.display = '';

		cancel.onclick = function() {
			var t = addComment, temp = t.I('wp-temp-form-div'), respond = t.I(t.respondId);

			if ( ! temp || ! respond )
				return;

			t.I('comment_parent').value = '0';
			temp.parentNode.insertBefore(respond, temp);
			temp.parentNode.removeChild(temp);
			this.style.display = 'none';
			this.onclick = null;
			return false;
		};

		try { t.I('comment').focus(); }
		catch(e) {}

		return false;
	},

	I : function(e) {
		return document.getElementById(e);
	}
};

      
      
</script>
{/if}
{/if}
{if isset($smartcustomcss)}
    <style>
        {$smartcustomcss}
    </style>
{/if}
