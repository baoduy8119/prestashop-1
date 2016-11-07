{*
 * @package AZ Templates
 * @version 1.0.0
 * @copyright (c) 2016 AZ Templates. (http://www.aztemplates.com)
 * @license http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *}

{if isset($list) && !empty($list)}
    {foreach from=$list item=items}
		{assign var="moduleclass_sfx" value=( isset( $items->params.moduleclass_sfx ) ) ?  $items->params.moduleclass_sfx : ''}
        <div class="az_module {$moduleclass_sfx|escape:'html':'UTF-8'}">
			{if isset($items->title_module[$cookie->id_lang]) && $items->params.display_title_module}
			<div class="az_titleModule">
				{$items->title_module[$cookie->id_lang]}
			</div>
			{/if}
        {$_list = $items->products}
        {if isset($_list) && $_list}
            {assign var="tag_id" value="azslider_{$items->id_module}"}
            <div class="az_slider">
                <div id="{$tag_id}" class="azslider-items-container owl-carousel product_list grid">
					{include file="./defaultDeal_items.tpl"}
                </div>
            </div>
			
			{assign var="nav" value=($items->params.show_nav == '1')?'true':'false'}			
			{assign var="dots" value=($items->params.show_page == '1')?'true':'false'}
			{assign var="autoplay" value=($items->params.auto == '1')?'true':'false'}
			{assign var="pause" value=($items->params.pause == '1')?'true':'false'}
			
			{if $items->params.specific_only}
				<script type="text/javascript">
					//<![CDATA[
					data = new Date(2013,10,26,12,00,00);
					function CountDown(date,id){
						dateNow = new Date();
						amount = date.getTime() - dateNow.getTime();
						if(amount < 0 && $('#'+id).length){
							$('.'+id).html("Now!");
						} else{
							days=0;hours=0;mins=0;secs=0;out="";
							amount = Math.floor(amount/1000);
							days=Math.floor(amount/86400);
							amount=amount%86400;
							hours=Math.floor(amount/3600);
							amount=amount%3600;
							mins=Math.floor(amount/60);
							amount=amount%60;
							secs=Math.floor(amount);
							if(days != 0){
								out += "<div class='time-item time-day'>" + "<div class='num-time titleFont'>" + days + "</div>" +" <div class='name-time'>"+((days==1)?"/Day":"/Days") + "</div>"+"</div> ";
							}
							
							out += "<div class='time-item time-hour'>" + "<div class='num-time titleFont'>" + hours + "</div>" +" <div class='name-time'>"+((hours==1)?"/Hour":"/Hours") + "</div>"+"</div> ";
							
							out += "<div class='time-item time-min'>" + "<div class='num-time titleFont'>" + mins + "</div>" +" <div class='name-time'>"+((mins==1)?"/Min":"/Mins") + "</div>"+"</div> ";
							out += "<div class='time-item time-sec'>" + "<div class='num-time titleFont'>" + secs + "</div>" +" <div class='name-time'>"+((secs==1)?"/Sec":"/Secs") + "</div>"+"</div> ";
							out = out.substr(0,out.length-2);
							$('.'+id).html(out) ;
							//setTimeout(function(){
								//CountDown(date,id);
							//},1000);
						}
					}
					if(listdeal.length > 0){
						for(var i=0; i < listdeal.length  ; i++) {
							var arr = listdeal[i].split("&&||&&"); 
							
							if (arr[1].length) {
								var data = new Date(arr[1]);
								CountDown(data, arr[0]);
							}			
						}	
					}					
					//]]>
				</script>			
			{/if}			
			
			<script type="text/javascript">
				jQuery('#{$tag_id}').owlCarousel({
					margin: 0,
					loop: false,
					touchDrag: false,
					pullDrag: false,
					autoplay: {$autoplay},
					autoplayHoverPause: {$pause},	
					dots: {$dots},					
					nav: {$nav},
					navText: [ 'Next', 'Prev' ],
					slideBy: {$items->params.step},
					autoplayTimeout: {$items->params.interval},
					smartSpeed: {$items->params.duration},
					responsive: {
						0:{
							items:1
						},
						480:{
							items:{$items->params.col_xs}
						},
						768:{
							items:{$items->params.col_sm}
						},
						992:{
							items:{$items->params.col_md}
						},
						1200:{
							items:{$items->params.col_lg}
						}
					}				   
				});
			</script>
			
        {else}
            {l s='Has no content to show' mod='azslider'}
        {/if}
        </div>
    {/foreach}
{/if}
