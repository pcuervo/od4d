<?php global $pinnacle; 
?>
<div class="kt-call-sitewide-to-action">
  <div class="container">
    <div class="kt-cta row">
      <div class="col-md-10 kad-call-sitewide-title-case">
        <h2 class="kad-call-title"><?php if(isset($pinnacle['sitewide_action_text'])) echo $pinnacle['sitewide_action_text'];?></h2>
      </div>
      <div class="col-md-2 kad-call-sitewide-button-case">
      <a href="<?php if(isset($pinnacle['sitewide_action_link'])) echo $pinnacle['sitewide_action_link'];?>" class="kad-btn-primary kad-btn lg-kad-btn"><?php if(isset($pinnacle['sitewide_action_text_btn'])) echo $pinnacle['sitewide_action_text_btn'];?></a>    
      </div>
    </div>
  </div><!--container-->
</div><!--call class-->