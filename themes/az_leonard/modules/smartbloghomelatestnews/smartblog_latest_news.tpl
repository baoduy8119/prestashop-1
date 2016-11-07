<div class="block az_lastesthomenews">
    <h3 class="title_block titleFont">{l s='Lastest blogs' mod='smartbloghomelatestnews'}</h3>
    <ul class="post_list row">
        {if isset($view_data) AND !empty($view_data)}
            {assign var='i' value=1}
            {foreach from=$view_data item=post}
               
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <li class="post post_{$i} col-md-12 col-sm-6">
						<div class="post-inner">
							
							<div class="post_image">
								 
								 <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default.jpg"></a>
							</div>
							
							<div class="post_content">
								<div class="post_header">
									 <div class="date_create">
										<span class="d">{$post.date_added|date_format:"%d"}</span>
										<span class="m">{$post.date_added|date_format:"%b"}</span>
									 </div>
									 <div class="post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title|truncate:25:''|escape:'htmlall':'UTF-8'}</a></div>
									 <div class="post_info">
									<span itemprop="author" class="author">{l s='By' mod='smartblog'} {$post.firstname}{$post.lastname}</span>
									<!--<span class="viewed"><i class="fa fa-eye"></i> 
										{if $post.viewed > 1}
											{$post.viewed} {l s='Views' mod='smartblog'}
										{else}
											{$post.viewed} {l s='View' mod='smartblog'}
										{/if}
									</span>-->
									<span class="sep"></span>
									<span class="comment"> <a title="{$post.countcomment} Comments" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}#articleComments">
										{if $post.countcomment > 1}
											 {l s='Comments:' mod='smartblog'} {$post.countcomment}
										{else}
											 {l s='Comment:' mod='smartblog'} {$post.countcomment}
										{/if}
									</a></span>
								</div>
								</div>
								<div class="post_desc">
									{$post.short_description|truncate:150:''|escape:'htmlall':'UTF-8'}
								</div>
								<a class="readmore" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{l s='Read more' mod='smartbloghomelatestnews'} <i class="fa fa-long-arrow-right"></i></a>
							</div>
						</div>
                        
                        
                    </li>
                
                {$i=$i+1}
            {/foreach}
        {/if}
     </ul>
</div>