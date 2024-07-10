<?php

class PeepSoBlockLatestMembers extends PeepSoBlockAbstract
{
	protected function get_slug() {
		return 'latest-members';
	}

	protected function get_attributes() {
		$attributes = [
			'title' => [ 'type' => 'string', 'default' => __('Latest Members', 'peepso-core') ],
			'limit' => [ 'type' => 'integer', 'default' => 12 ],
			'hide_empty' => [ 'type' => 'integer', 'default' => 0 ],
			'show_total_members' => [ 'type' => 'integer', 'default' => 0 ],
		];

		return apply_filters('peepso_block_attributes', $attributes, $this->get_slug());
	}

	public function render_component($attributes) {
		$preview = isset($_GET['context']) && 'edit' === $_GET['context'];
		$data = [];
		$widget_instance = $this->widget_instance($attributes);
		$args = ['attributes' => $attributes, 'data' => $data, 'widget_instance' => $widget_instance];
		$html = PeepSoTemplate::exec_template('blocks', 'latest-members', $args, TRUE);

		return $html;
	}
}
