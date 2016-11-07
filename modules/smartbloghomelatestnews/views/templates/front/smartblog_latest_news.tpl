<div class="block lastestnews col-sm-12">
    <h4 class='title_block'>{l s='Latest News' mod='smartbloghomelatestnews'}</h4>
    <div class="sdsblog-box-content row clearfix">
        {if isset($view_data) AND !empty($view_data)}
            {assign var='i' value=1}
            {foreach from=$view_data item=post}
               
                    {assign var="options" value=null}
                    {$options.id_post = $post.id}
                    {$options.slug = $post.link_rewrite}
                    <div class="sds_blog_post col-md-3 col-sm-6">
                        <div class="news_module_image_holder">
                             <a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"><img alt="{$post.title}" class="feat_img_small" src="{$modules_dir}smartblog/images/{$post.post_img}-home-small.jpg"></a>
							 <div class="sds_post_title"><a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}">{$post.title}</a></div>
                        </div>
                        
                        
                        <!--<p class="desc">
                            {$post.short_description|escape:'htmlall':'UTF-8'}
                        </p>
						<span class="date_added">{$post.date_added}</span>-->
                        
                    </div>
                
                {$i=$i+1}
            {/foreach}
        {/if}
		<!--<a href="{smartblog::GetSmartBlogLink('smartblog_post',$options)}"  class="r_more">{l s='Read More' mod='smartbloghomelatestnews'}</a>-->
     </div>
</div>