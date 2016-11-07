{if $spmegamenu != ''}
	<div class="spmegamenu">
		<nav class="navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" id="show-megamenu" data-toggle="collapse" data-target="#sp-megamenu" class="navbar-toggle">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div id="sp-megamenu" class="{$spmegamenu_style} sp-megamenu clearfix">
				<span id="remove-megamenu" class="icon-remove"></span>
				<a href="#" class="navbar-brand">
					<i class="icon-home"></i>
				</a>
				{$spmegamenu}
			</div>
		</nav>	
	</div>	
{/if}
<script type="text/javascript">{literal}

	$(document).ready(function() {
		
		$("#sp-megamenu  li.parent  .grower").click(function(){
			if($(this).hasClass('close'))
				$(this).addClass('open').removeClass('close');
			else
				$(this).addClass('close').removeClass('open');
				
			$('.dropdown-menu',$(this).parent()).first().toggle(300);
			
		});
		
		var wd_width = $(window).width();
		if(wd_width > 767)
			offtogglemegamenu();
			
			
		$(window).resize(function() {
			var sp_width = $( window ).width();
			if(sp_width > 767)
				offtogglemegamenu();
		});
		
	});

	$('#show-megamenu').click(function() {
		if($('.sp-megamenu').hasClass('sp-megamenu-active'))
			$('.sp-megamenu').removeClass('sp-megamenu-active');
		else
			$('.sp-megamenu').addClass('sp-megamenu-active');
        return false;
    });
	$('#remove-megamenu').click(function() {
        $('.sp-megamenu').removeClass('sp-megamenu-active');
        return false;
    });
	
	
	function offtogglemegamenu()
	{
		$('#sp-megamenu li.parent .dropdown-menu').css('display','');	
		$('#sp-megamenu').removeClass('sp-megamenu-active');
		$("#sp-megamenu  li.parent  .grower").removeClass('open').addClass('close');	
	}
	
	
{/literal}</script>