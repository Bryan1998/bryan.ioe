<div style="height:auto;max-width:75%;magin:auto;display:inline-block;">
<ul class="bxslider">
<?php
$dirname = "./img/slider/";
$images = glob($dirname."*.{jpg,gif,png}",GLOB_BRACE);
foreach($images as $image) {
    echo '<li><img src="'.$image.'" alt=""/></li>';
}
?>
</ul>
<script>
	$(document).ready(function(){
		$('.bxslider').bxSlider();
	});
</script>
</div>
