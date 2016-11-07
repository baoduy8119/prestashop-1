
<div class="smartblogcat-inner grid row">
	{foreach from=$postcategory item=post}
		<div itemtype="#" itemscope="" class="sdsarticleCat col-sm-6">
			<div id="smartblogpost-{$post.id_post}" class="smartblogpost">
			<div class="articleContent clearfix">
				
				 
			{assign var="options" value=null}
									{$options.id_post = $post.id_post} 
									{$options.slug = $post.link_rewrite}
				  <a itemprop="url" title="{$post.meta_title}" class="imageFeaturedLink" href='{smartblog::GetSmartBlogLink('smartblog_post',$options)}'>
							{assign var="activeimgincat" value='0'}
							{$activeimgincat = $smartshownoimg} 
							
					  <img itemprop="image" alt="{$post.meta_title}" src="{$modules_dir}/smartblog/images/{$post.post_img}-home-default.jpg" class="imageFeatured">
							
				  </a>
				 <!-- <div class="sdsarticle-text">
						<div class="sdsarticle-info">
					<span itemprop="author" class="author"><i class="fa fa-user"></i> {if $smartshowauthor ==1} {if $smartshowauthorstyle != 0}{$post.firstname}{$post.lastname}{else}{$post.lastname}{$post.firstname}{/if}</span>{/if}
					<span class="viewed"><i class="fa fa-eye"></i> 
						{if $post.viewed > 1}
							{$post.viewed} {l s='Views' mod='smartblog'}
						{else}
							{$post.viewed} {l s='View' mod='smartblog'}
						{/if}
					</span>
					<span class="comment"> <a title="{$post.totalcomment} Comments" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}#articleComments"> <i class="fa fa-comment"></i>
						{if $post.totalcomment > 1}
							{$post.totalcomment} {l s='Comments' mod='smartblog'}
						{else}
							{$post.totalcomment} {l s='Comment' mod='smartblog'}
						{/if}
					</a></span>
				</div>-->
					
				   <div class="sdsarticleHeader">
						<div class="date_create">
							<span class="d">{$post.created|date_format:"%d"}</span>
							<span class="m">{$post.created|date_format:"%b"}</span>
						 </div>
						 {assign var="options" value=null}
											{$options.id_post = $post.id_post} 
											{$options.slug = $post.link_rewrite}
											<div class="sdstitle_block"><a title="{$post.meta_title}" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.meta_title|truncate:20:''}</a></div>
							 {assign var="options" value=null}
										{$options.id_post = $post.id_post}
										{$options.slug = $post.link_rewrite}
							   {assign var="catlink" value=null}
											{$catlink.id_category = $post.id_category}
											{$catlink.slug = $post.cat_link_rewrite}
						
						 <div class="sdsarticle-info">
							<span itemprop="author" class="author">{l s='By' mod='smartblog'} {if $smartshowauthor ==1} {if $smartshowauthorstyle != 0}{$post.firstname}{$post.lastname}{else}{$post.lastname}{$post.firstname}{/if}</span>{/if}
							<!--<span class="viewed"><i class="fa fa-eye"></i> 
								{if $post.viewed > 1}
									{$post.viewed} {l s='Views' mod='smartblog'}
								{else}
									{$post.viewed} {l s='View' mod='smartblog'}
								{/if}
							</span>-->
							<span class="sep"></span>
							<span class="comment"> <a title="{$post.totalcomment} Comments" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}#articleComments">
								{if $post.totalcomment > 1}
									 {l s='Comments:' mod='smartblog'} {$post.totalcomment}
								{else}
									 {l s='Comment:' mod='smartblog'} {$post.totalcomment}
								{/if}
							</a></span>
						</div>
					</div>
					
					
					<div class="sdsarticle-des">
						  <span itemprop="description"><div id="lipsum">
						{$post.short_description|truncate:100:''}</div></span>
					</div>
					<a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}" class="more">{l s='Read more' mod='smartblog'} <i class="fa fa-long-arrow-right"></i></a>	 
					
			
				  
				   
			</div>
			   
		   </div>
		</div>
	{/foreach}
</div>