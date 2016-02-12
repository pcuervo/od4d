<?php global $pinnacle; 
?>
<div class="kt-home-call-to-action panel-row-style-wide-parallax">
	<div class="container">
		<div class="kt-cta">
			<div class="col-md-10 kad-call-title-case">
			<?php if(isset($pinnacle['home_action_text_tag'])) {$tag = $pinnacle['home_action_text_tag'];} else {$tag = 'h1';}
			if(isset($pinnacle['home_action_text'])) {
				echo '<'.$tag.' class="kad-call-title">'.$pinnacle['home_action_text'].'</'.$tag.'>';
			}?>
			</div>
			<div class="col-md-2 kad-call-button-case">
			<a href="<?php if(isset($pinnacle['home_action_link'])) echo $pinnacle['home_action_link'];?>" class="kad-btn-primary kad-btn lg-kad-btn"><?php if(isset($pinnacle['home_action_text_btn'])) echo $pinnacle['home_action_text_btn'];?></a>   	
			</div>
		</div>
	</div><!--container-->
</div><!--call class-->