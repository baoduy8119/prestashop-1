<div class="block lastestnews layout3">
    <h3 class='title_block'>{l s='Latest blog' mod='smartbloghomelatestnews'}</h3>
	<h4 class="subtitle"><span></span></h4>
    <ul class="lastest_posts row">
        {if isset($view_data) AND !empty($view_data)}
            {assign var='i' value=1}
            {foreach from=$view_data item=post}
               
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <li class="post col-md-6 col-sm-6">
						<div class="post-inner">
							<div class="post_image">
								 <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img" src="{$modules_dir}smartblog/images/{$post.post_img}-home-default2.jpg"></a>
							</div>
							
							<div class="post_content">
								<div class="date_added">
									<span class="d">{$post.date_added|date_format:"%d"}</span>
									<span class="sep">/</span>
									<span class="m">{$post.date_added|date_format:"%b"}</span>
								 </div>
								<div class="post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title|truncate:20:''|escape:'htmlall':'UTF-8'}</a></div>
								<!--<div class="post-info">
									<span class="author">
										<i class="fa fa-user"></i> {if $post.smartshowauthor ==1} {if $post.smartshowauthorstyle != 0}{$post.firstname}{$post.lastname}{/if}{/if}
									</span>
									<span class="view">
										<i class="fa fa-eye"></i> {$post.viewed} {if $post.viewed > 1} {l s='Views' mod='smartbloghomelatestnews'} {else} {l s='View' mod='smartbloghomelatestnews'} {/if}
									</span>
									<span class="comment">
										<i class="fa fa-comment"></i> {$post.countcomment} {if $post.countcomment > 1} {l s='Comments' mod='smartbloghomelatestnews'} {else} {l s='Comment' mod='smartbloghomelatestnews'} {/if}
									</span>
								</div>-->
								<div class="desc">
									{$post.short_description|truncate:60:'...'|escape:'htmlall':'UTF-8'}
								</div>
								<a class="readmore" href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{l s='Read more' mod='smartbloghomelatestnews'}</a>
							</div>
						</div>
                        
                        
                    </li>
                
                {$i=$i+1}
            {/foreach}
        {/if}
     </ul>
</div>