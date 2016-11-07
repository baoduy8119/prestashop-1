<div itemtype="#" itemscope="" class="sdsarticleCat clearfix">
    <div id="smartblogpost-{$post.id_post}">
	<div class="articleContent">
	{assign var="options" value=null}
                            {$options.id_post = $post.id_post} 
                            {$options.slug = $post.link_rewrite}
          <a itemprop="url" title="{$post.meta_title}" class="imageFeaturedLink" href='{smartblog::GetSmartBlogLink('smartblog_post',$options)}'>
                    {assign var="activeimgincat" value='0'}
                    {$activeimgincat = $smartshownoimg} 
                    {if ($post.post_img != "no" && $activeimgincat == 0) || $activeimgincat == 1}
              <img itemprop="image" alt="{$post.meta_title}" src="{$modules_dir}/smartblog/images/{$post.post_img}-single-default.jpg" class="imageFeatured">
                    {/if}
          </a>
		   <div class="sdsarticleHeader">
				 {assign var="options" value=null}
									{$options.id_post = $post.id_post} 
									{$options.slug = $post.link_rewrite}
									<div class="sdstitle_block"><a title="{$post.meta_title}" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.meta_title}</a></div>
					 {assign var="options" value=null}
								{$options.id_post = $post.id_post}
								{$options.slug = $post.link_rewrite}
					   {assign var="catlink" value=null}
									{$catlink.id_category = $post.id_category}
									{$catlink.slug = $post.cat_link_rewrite}
				 
			</div>
			<div class="date_added">
								{$post.created}
								
							 </div>
			<div class="sdsarticle-des">
				  <span itemprop="description"><div id="lipsum">
			{$post.short_description|truncate:340:''}</div></span>
				 </div>
			<div class="blog-info">
				<span class="comment"> <a title="{$post.totalcomment} Comments" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}#articleComments">{$post.totalcomment} {l s=' Comment(s)' mod='smartblog'}</a></span>
				| {l s='Posted By' mod='smartblog'} <span itemprop="author">{if $smartshowauthor ==1} {if $smartshowauthorstyle != 0}{$post.firstname} {$post.lastname}{else}{$post.lastname} {$post.firstname}{/if}</span>{/if} &nbsp;
			</div>
    </div>
       
   </div>
</div>

