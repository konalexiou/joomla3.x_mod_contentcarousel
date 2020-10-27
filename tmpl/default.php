<?php
// No direct access
defined('_JEXEC') or die;

$document = JFactory::getDocument();

$options = array("version" => "auto");
$attributes = array("defer" => "defer");
// $document->addScript(JURI::root() . "modules/mod_contentcarousel/js/jquery.js", $options, $attributes);
$document->addScript(JURI::root() . "modules/mod_contentcarousel/js/jquery.easing.js", $options, $attributes);
$document->addScript(JURI::root() . "modules/mod_contentcarousel/js/script.js", $options, $attributes);

$document->addStyleSheet(JURI::root() . "modules/mod_contentcarousel/css/style.css","text/css","screen");

?>


<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function(){
  // var buttons = { previous:jQuery('#jslidernews2 .button-previous'), next:jQuery('#jslidernews2 .button-next') };
  jQuery('#jslidernews2').lofJSidernews({
                      interval:5000,
  									 	easing:'easeInOutQuad',
  										duration:1200,
  										auto:true,
  										mainWidth:684,
  										mainHeight:300,
  										navigatorHeight		: 100,
  										navigatorWidth		: 310,
  										maxItemDisplay:3,
  										// buttons:buttons
                    });
});
</script>


<div id="jslidernews2" class="lof-slidecontent" style="width:100%; height:300px;">
	 <div class="preload"><div></div></div>


            <!-- <div  class="button-previous">Previous</div> -->

    		    <!-- MAIN CONTENT -->
              <div class="main-slider-content" style="width:100%; height:300px;">
                <ul class="sliders-wrap-inner">
                    <?php foreach($articles as $article){ ?>
                    <li>
                          <div style="position:relative;">
                          <img src="<?php echo JURI::root().$article->image; ?>" title="<?php echo $article->title; ?>" width="100%" >
                          </div>
                          <div class="slider-description">
                            <div class="slider-meta">
                              <a target="_parent" title="<?php echo $article->title; ?>" href="<?php echo $article->url; ?>"><?php echo $article->title; ?></a>
                            </div>
                            <?php echo $article->short; ?>
                          </div>
                    </li>
                    <?php } ?>
                  </ul>
            </div>
 		       <!-- END MAIN CONTENT -->
           <!-- NAVIGATOR -->
           	<div class="navigator-content">
                  <div class="navigator-wrapper">
                        <ul class="navigator-wrap-inner">
                          <?php foreach($articles as $article){ ?>
                          <li>
                                <div>
                                    <img src="<?php echo JURI::root().$article->image; ?>" />
                                    <h3> <?php echo $article->title; ?> </h3>
                                    <?php echo $article->short; ?>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                  </div>

             </div>
          <!-- END OF NAVIGATOR  -->
          <!-- <div class="button-next">Next</div> -->

 		      <!-- BUTTON PLAY-STOP -->
          <!-- <div class="button-control"><span></span></div> -->
          <!-- END OF BUTTON PLAY-STOP -->

 </div>
