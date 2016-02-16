<?php global $pinnacle; $icons = $pinnacle['icon_menu']; 
                if(!empty($pinnacle['home_icon_menu_column'])) {$columnsize = $pinnacle['home_icon_menu_column'];} else {$columnsize = 3;}
                        if ($columnsize == '2') {$itemsize = 'tcol-lg-6 tcol-md-6 tcol-sm-6 tcol-xs-12 tcol-ss-12'; $md = 2; $sm = 2; $xs = 1; $ss = 1;} 
                        else if ($columnsize == '3'){ $itemsize = 'tcol-lg-4 tcol-md-4 tcol-sm-4 tcol-xs-6 tcol-ss-12';  $md = 3; $sm = 3; $xs = 2; $ss = 1;} 
                        else if ($columnsize == '6'){ $itemsize = 'tcol-lg-2 tcol-md-2 tcol-sm-3 tcol-xs-4 tcol-ss-6'; $md = 6; $sm = 4; $xs = 3; $ss = 2;} 
                        else if ($columnsize == '5'){ $itemsize = 'tcol-lg-25 tcol-md-25 tcol-sm-3 tcol-xs-4 tcol-ss-6';} 
                        else {$itemsize = 'tcol-lg-3 tcol-md-3 tcol-sm-6 tcol-xs-6 tcol-ss-12';}
                    if(!empty($pinnacle['home_icon_menu_btn'])) {$iconbtn = $pinnacle['home_icon_menu_btn'];} else {$iconbtn = '';}
                    if(isset($pinnacle['home_icon_menu_btn_show']) && $pinnacle['home_icon_menu_btn_show'] == 0) {$iconbtncss = '';} else {$iconbtncss = 'kt-iconbtn-hide';}
                	?>
                <div class="home-margin home-padding">
                	<div class="rowtight homepromo">
                    <?php $counter = 1;?>
                        <?php foreach ($icons as $icon) : ?>
                        <?php if(!empty($icon['target']) && $icon['target'] == 1) {$target = '_blank';} else {$target = '_self';} ?>
                            <div class="<?php echo $itemsize;?> home-iconmenu kad-animation <?php echo 'homeitemcount'.$counter;?>" data-animation="fade-in" data-delay="<?php echo $counter*150;?>">
                                <?php if(!empty($icon['link'])) {?> 
	                            <a href="<?php echo $icon['link']; ?>" target="<?php echo $target; ?>"  title="<?php echo esc_attr($icon['title']); ?>" class="home-icon-item">
                               <?php } else { ?>
                                <div class="home-icon-item">
                                <?php } 
	                           if(!empty($icon['url'])) echo '<i><img src="'.$icon['url'].'"/></i>' ; else echo '<i class="'.$icon['icon_o'].'"></i>'; 
	                            if ($icon['title'] != '') echo '<h4>'.$icon['title'].'</h4>'; 
                                if (!empty($icon['description'])) echo '<p>'.$icon['description'].'</p>'; 
                                 if(!empty($iconbtn)) echo '<div class="kad-btn sm-kad-btn '.$iconbtncss.' kad-btn-primary">'.$iconbtn.'</div>';
                                if(!empty($icon['link'])) {?> 
	                            </a>
                                 <?php } else { ?>
                                </div>
                                <?php } ?>
                            </div>
                             <?php $counter ++ ?>
                        <?php endforeach; ?>

                    </div> <!--homepromo -->
                </div>