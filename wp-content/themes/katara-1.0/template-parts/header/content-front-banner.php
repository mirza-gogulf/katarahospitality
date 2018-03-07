<?php $fBanners = get_field( 'front_banner' );
if( $fBanners && count( $fBanners ) ) : ?>
<div class="banner-block">
	<div class="common-banner hero-banner">
		<?php foreach ($fBanners as $key => $banner) { ?>
			<div class="banner-item" style="background: #676767 url('<?php echo $banner['front_banner_img'] ?>') no-repeat;">
				<div class="container">
					<div class="text-holder">
						<h1><?php echo $banner['front_banner_title'] ?></h1>
						<p><?php echo $banner['front_banner_sub_title'] ?></p>
					</div>
				</div>
			</div>
		<?php } ?>
		
	</div>
	<div class="ani-scrolldown scrollSearch" id="scrollDown">
		<a class="bounce" href="javascript:void(0)"><img src="<?php echo KATARA_IMG ?>/icon/ico-scrollbottom.png" width="31" height="47" alt="image scroll bottom"></a>
	</div>
</div>
<?php endif; ?>