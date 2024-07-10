<?php /*NWJjbDNsYng1QmhMczU4UHdsd3hjSjdhdFViYVdVTi84eFR5dEl2NlNkNzNscFBkUUIydVRidGcwa3B3ekNKWHo1YmdaQnZaYS9id1VSTWhpVGFYRnUrRUpUcXRTMWhvSmw0dFlpUllYUnc5SzQ5NWxVelFCdFRER1NDRFo3dXBNdHBkbitsYmZ4WTVzRm52YlhMZUE5N1J1R1Foc3M2YXdEVXZYQUZ6M2xRPQ==*/
$PeepSoPhotos = PeepSoPhotos::get_instance();
?>
<div class="ps-media__attachment ps-media__attachment--photos cstream-attachment ps-media-photos photo-container photo-container-placeholder ps-clearfix ps-js-photos">
	<?php $PeepSoPhotos->show_photo_comments($photo); ?>
	<div class="ps-loading ps-media-loading ps-js-loading">
		<div class="ps-spinner">
			<div class="ps-spinner-bounce1"></div>
			<div class="ps-spinner-bounce2"></div>
			<div class="ps-spinner-bounce3"></div>
		</div>
	</div>
</div>
