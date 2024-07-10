<?php

class PeepSoBlockLogin extends PeepSoBlockAbstract
{
	protected function get_slug() {
		return 'login';
	}

	protected function get_attributes() {
		$attributes = [
			'title' => [ 'type' => 'string', 'default' => '' ],
			'view_option' => [ 'type' => 'string', 'default' => 'vertical' ],
		];

		return apply_filters('peepso_block_attributes', $attributes, $this->get_slug());
	}
}
