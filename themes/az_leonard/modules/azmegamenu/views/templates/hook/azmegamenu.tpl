{if $azmegamenu != ''}
	<div class="az_megamenu">
		<nav class="navbar" role="navigation">
			<div class="navbar-button">
				<button type="button" id="show-megamenu" data-toggle="collapse" data-target="#az_megamenu_wrap" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="az_megamenu_wrap" class="{$azmegamenu_style} az_megamenu_wrap clearfix">
				<span id="remove-megamenu" class="fa fa-remove"></span>
				<span class="label-menu">{l s='Menu' mod='azmegamenu'}</span>
				<div class="az_megamenu_inner">
					<div class="home">
						<a href="{$base_dir}">{l s='Home' mod='azmegamenu'}</a>
						
					</div>
					{$azmegamenu}
				</div>
				
			</div>
		</nav>	
	</div>	
{/if}
<script type="text/javascript">{literal}

	$(document).ready(function() {
		
		$("#az_megamenu_wrap  li.parent  .grower").click(function(){
			if($(this).hasClass('close'))
				$(this).addClass('open').removeClass('close');
			else
				$(this).addClass('close').removeClass('open');
				
			$('.dropdown-menu',$(this).parent()).first().toggle(300);
		});
		
		$("#az_megamenu_wrap  .home  .grower").click(function(){
			if($(this).hasClass('close'))
				$(this).addClass('open').removeClass('close');
			else
				$(this).addClass('close').removeClass('open');
				
			$('.dropdown-menu',$(this).parent()).first().toggle(300);
		});
		
		var wd_width = $(window).width();
		var wd_height = $(window).height();
		if(wd_width > 992)
			offtogglemegamenu();
			
		$(window).resize(function() {
			var sp_width = $( window ).width();
			if(sp_width > 992)
				offtogglemegamenu();
		});
		
	});

	$('#show-megamenu').click(function() {
		if($('.az_megamenu_wrap').hasClass('active-menu'))
			$('.az_megamenu_wrap').removeClass('active-menu');
		else
			$('.az_megamenu_wrap').addClass('active-menu');
        return false;
    });
	$('#remove-megamenu').click(function() {
        $('.az_megamenu_wrap').removeClass('active-menu');
        return false;
    });
	
	
	function offtogglemegamenu()
	{
		$('#az_megamenu_wrap li.parent .dropdown-menu').css('display','');	
		$('#az_megamenu_wrap').removeClass('active-menu');
		$("#az_megamenu_wrap  li.parent  .grower").removeClass('open').addClass('close');
		
		$('#az_megamenu_wrap .home .dropdown-menu').css('display','');	
		$('#az_megamenu_wrap').removeClass('active-menu');
		$("#az_megamenu_wrap .home  .grower").removeClass('open').addClass('close');	
	}
	
	
{/literal}</script>