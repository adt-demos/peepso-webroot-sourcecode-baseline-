<?php

class PeepSoBlockHashtags extends PeepSoBlockAbstract
{
	protected function get_slug() {
		return 'hashtags';
	}

	protected function get_attributes() {
		$attributes = [
			'title' => [ 'type' => 'string', 'default' => __('Community Hashtags', 'peepso-core') ],
			'limit' => [ 'type' => 'integer', 'default' => 12 ],
			'displaystyle' => [ 'type' => 'integer', 'default' => 0 ],
			'sortby' => [ 'type' => 'integer', 'default' => 0 ],
			'sortorder' => [ 'type' => 'integer', 'default' => 0 ],
			'minsize' => [ 'type' => 'integer', 'default' => 0 ],
			'timestamp' => [ 'type' => 'integer', 'default' => 0 ]
		];

		return apply_filters('peepso_block_attributes', $attributes, $this->get_slug());
	}

	public function render_component($attributes) {
		$preview = isset($_GET['context']) && 'edit' === $_GET['context'];
		$data = $preview ? $this->get_data($attributes) : $this->get_cached_data($attributes);
		$widget_instance = $this->widget_instance($attributes);
		$args = ['attributes' => $attributes, 'data' => $data, 'widget_instance' => $widget_instance];
		$html = PeepSoTemplate::exec_template('blocks', 'hashtags', $args, TRUE);

		return $html;
	}

	private function get_data($attributes) {
		global $wpdb;

		$table_name = "";

		$where = '';
		if ($attributes['minsize'] > 0) {
			$where = " ht_count >= {$attributes['minsize']}";
		}

        $where = apply_filters('peepso_hashtags_query', $where);

		if (!empty($where)) {
            $where = 'WHERE ' . $where;
        }

		$order = ' ORDER BY';
		if ($attributes['sortby'] == 1) {
			$order .= ' ht_count ' . ($attributes['sortorder'] == 1 ? 'ASC' : 'DESC') . ',';
		}
		$order .= ' ht_name ' . ($attributes['sortorder'] == 1 ? 'ASC' : 'DESC');

		$sql = "SELECT * FROM {$wpdb->prefix}peepso_hashtags h $where $order LIMIT {$attributes['limit']}";
		$result = $wpdb->get_results($sql);

		return $result;
	}

	private function get_cached_data($attributes) {
		$timestamp = $attributes['timestamp'];
		$result = PeepSo3_Mayfly::get("peepso_hashtags_{$timestamp}");
		if (!$result) {
			$result = $this->get_data($attributes);
			PeepSo3_Mayfly::set("peepso_hashtags_{$timestamp}", $result, HOUR_IN_SECONDS);
		}

		return $result;
	}
}
