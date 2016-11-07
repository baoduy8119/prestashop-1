
<div id="live-editor_btn">
	<i class="fa fa-hand-o-right"></i>
</div>		

<div id="live-editor">
	<form action="{$content_dir}" method="get" class="nomargin">
	
		<div class="title"> {l s="Live Theme Editor"} <span class="close-editor"><i class="fa fa-hand-o-left"></i></span></div>
		
		<div id="editor-option">
			<div class="option color">
				<label>{l s="Theme Color"}</label>
				<div class="skinbox">
					<input id="azlte_themeSkin" name="AZ_ltethemeSkin" class="form-control minicolors minicolors-input" type="text" value="{$AZ_themeSkin}" />
					<script type="text/javascript">
						(function($){
							$("#azlte_themeSkin").minicolors({
								position: "bottom right",
								changeDelay: 200,
								theme: "bootstrap"
							});
						})(jQuery)
					</script>
					<div class="themeSkin skin1 {if {'#e54e5d'}==$AZ_themeSkin} active {/if}" data-skin="1" data-themeskin="#e54e5d"><span></span></div>
					<div class="themeSkin skin2 {if {'#00B0FF'}==$AZ_themeSkin} active {/if}" data-skin="2" data-themeskin="#00B0FF"><span></span></div>
					<div class="themeSkin skin3 {if {'#43becc'}==$AZ_themeSkin} active {/if}" data-skin="3" data-themeskin="#43becc"><span></span></div>
					<div class="themeSkin skin4 {if {'#b0c052'}==$AZ_themeSkin} active {/if}" data-skin="4" data-themeskin="#b0c052"><span></span></div>
					<div class="themeSkin skin5 {if {'#c59d5f'}==$AZ_themeSkin} active {/if}" data-skin="5" data-themeskin="#c59d5f"><span></span></div>
				 </div>
			</div>
		
			<div class="option layout hidden-device">
				<label>{l s="Select Layout"}</label>
				<div class="layoutbox">
					<select name="AZ_ltelayoutOption">
						<option {if "layout-full"==$AZ_layoutOption}   selected="selected" {/if}value="layout-full">{l s="Fullwidth Layout"}</option>
						<option {if "layout-boxed"==$AZ_layoutOption}  selected="selected" {/if}value="layout-boxed">{l s="Boxed Layout"}</option>
					</select>
				</div>
			</div>
			
			<div class="option header hidden">
				<label>{l s="Select Header"}</label>
				<div class="layoutbox">
					<select name="AZ_lteheaderOption">
						<option {if "header-v1"==$AZ_headerOption}  selected="selected" {/if}value="header-v1">{l s="Header 1"}</option>
					</select>
				</div>
			</div>
			
			<div class="option content hidden">
				<label>{l s="Select Content"}</label>
				<div class="layoutbox">
					<select name="AZ_ltecontentOption">
						<option {if "content-v1"==$AZ_contentOption}  selected="selected" {/if}value="content-v1">{l s="Content 1"}</option>
					</select>
				</div>
			</div>
			
			<div class="option pattern hidden-device">
				<label>{l s="Background Images"}</label>
				<div class="patternbox">
					<input type="hidden" name="AZ_ltepattern" value="{$AZ_patternOption}" />
					<div data-pattern="none" class="img-pattern pattern_none {if {'none'}==$AZ_patternOption}  active {/if}"><span></span></div>
					{section name=patterns start=1 loop=10 step=1}
						<div data-pattern="{$smarty.section.patterns.index}" class="img-pattern pattern_{$smarty.section.patterns.index} {if {$smarty.section.patterns.index}==$AZ_patternOption}  active {/if}"><span></span></div>
					{/section}
				</div>
				

			</div>
			
			<div class="buttons">
				<input type="submit" class="btn btn-default" value="Reset" name="AZ_lteReset"/>
				<input type="submit" class="btn btn-success" value="Apply" name="AZ_lteApply"/>
			</div>
		</div>
	</form>	
</div>

<script type="text/javascript">
	
	(function($){
		$(".img-pattern").each(function(){
			var that = $(this) 	;
			that.on('click', function(){
				var _pattern =  $(this).data('pattern');
				$('input[name="AZ_ltepattern"]').val(_pattern);
				if($(this).hasClass('selected'))
					return;
				else{
					$(".img-pattern").removeClass('selected');
					$(".img-pattern").removeClass('active');
					$(this).addClass('selected');
				}
			});
		});
	})(jQuery);
	
	(function($){
		$(".themeSkin").each(function(){
			var that = $(this) 	;
			that.on('click', function(){
				var $skin = $(this).data('skin');
				var _themeSkin =  $(this).data('themeskin');
				$('input[name="AZ_ltethemeSkin"]').val(_themeSkin);
				if($(this).hasClass('selected'))
					return;
				else{
					$(".themeSkin").removeClass('selected');
					$(".themeSkin").removeClass('active');
					$(this).addClass('selected');
					$('body').removeClass('themeskin1 themeskin2 themeskin3 themeskin4 themeskin5');
					$('body').addClass('themeskin'+$skin);
					if($('body').hasClass('themeskin1'))
						$('head').append('<link href="{$css_dir}skins/skin1.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin2'))
						$('head').append('<link href="{$css_dir}skins/skin2.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin3'))
						$('head').append('<link href="{$css_dir}skins/skin3.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin4'))
						$('head').append('<link href="{$css_dir}skins/skin4.css" rel="stylesheet" type="text/css" media="all" />');
					if($('body').hasClass('themeskin5'))
						$('head').append('<link href="{$css_dir}skins/skin5.css" rel="stylesheet" type="text/css" media="all" />');
				}
			});
		});
	})(jQuery);
	
</script>