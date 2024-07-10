<div class="ps-comments__input-addon ps-comments__input-addon--photo ps-js-addon-photo">
	<img class="ps-js-img" alt="photo"
		src="<?php /*NWJjbDNsYng1QmhMczU4UHdsd3hjSjdhdFViYVdVTi84eFR5dEl2NlNkNnFRbGpuN1RLZnNTb3diWnVNYUhMSFhEMjlHZTQ3SUV4Y0VyOGFhYWZpTHY3VDdGZjVubm5VMDNMWnRrZUtEbUdoQVRYczlIVC9MSmdxRDlvSi91MnBxVUUxMy9xNWFIOHg1QWhlSyt2NUQwbUxVZGJTVHp3SXlsMDNHUmpaRjN2S3NsQ0RORGYrWlE4WWFZdFpRay93*/ echo isset($thumb) ? $thumb : ''; ?>"
		data-id="<?php echo isset($id) ? $id : ''; ?>" />

	<div class="ps-loading ps-js-loading">
		<img src="<?php echo PeepSo::get_asset('images/ajax-loader.gif'); ?>" alt="loading" />
	</div>

	<div class="ps-comments__input-addon-remove ps-js-remove">
		<?php wp_nonce_field('remove-temp-files', '_wpnonce_remove_temp_comment_photos'); ?>
		<i class="gcis gci-times"></i>
	</div>
</div>
