
<div class="header-form">
	<div class="button-header">
		<span class="line"></span>
		<span class="line"></span>
		<span class="line"></span>
	</div>
	<div class="dropdown-form">
		{hook h="displayUserinfo"}
		{hook h="displayTopNav"}
	</div>
</div>

<script type="text/javascript">
// <![CDATA[
	$(document).ready(function($){
		$(".dropdown-form").addClass('show-form');
		$(".button-header").click(function(){
			$(this).toggleClass("active").next().slideToggle("medium");
			
		});
	});
// ]]>
</script>