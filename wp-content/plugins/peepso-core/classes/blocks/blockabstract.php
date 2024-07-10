<?php

abstract class PeepSoBlockAbstract
{
	abstract protected function get_slug();

	public function __construct() {
		$slug = $this->get_slug();

		wp_register_script(
			"peepso-block-{$slug}-editor",
			PeepSo::get_asset("js/blocks/{$slug}-editor.js"),
			['wp-blocks', 'wp-i18n', 'wp-element'],
			PeepSo::PLUGIN_VERSION,
			TRUE
		);

		$dataKey = implode('', array_map('ucfirst', explode('-', $slug)));
		$dataKey = "peepsoBlock{$dataKey}EditorData";
		wp_localize_script("peepso-block-{$slug}-editor", $dataKey, [
			'attributes' => $this->get_attributes()
		]);

		register_block_type("peepso/{$slug}", [
			'attributes' => $this->get_attributes(),
			'editor_script' => "peepso-block-{$slug}-editor",
			'render_callback' => [$this, 'render_component'],
		]);
	}

	protected function get_attributes() {
		return [];
	}

	protected function get_render_args($attributes, $preview) {
		return [];
	}

	public function render_component($attributes) {
		$preview = isset($_GET['context']) && 'edit' === $_GET['context'];
		$widget_instance = $this->widget_instance($attributes);
		$args = ['attributes' => $attributes, 'preview' => $preview, 'widget_instance' => $widget_instance];
		$args =  array_merge($args, $this->get_render_args($attributes, $preview));
		$html = PeepSoTemplate::exec_template('blocks', $this->get_slug(), $args, TRUE);

		if ($preview && trim($html)) {
			$html = sprintf('<div class="ps-widget--preview" style="position:relative">
				%1$s
				<div class="ps-widget__disabler" style="position:absolute; top:0; left:0; right:0; bottom:0"></div>
			</div>', $html);
		}

		return $html;
	}

	/**
	 * For backward compatibility when the block is rendered as a widget, inside a "sidebar".
	 */
	protected function widget_instance($attributes) {
		if (isset($attributes['__sidebar_id'])) {
			global $wp_registered_sidebars;

			$sidebar_id = $attributes['__sidebar_id'];
			if (isset($wp_registered_sidebars[$sidebar_id])) {
				return $wp_registered_sidebars[$sidebar_id];
			}
		}

		return NULL;
	}
}

/**
 * For backward compatibility when the block is rendered as a widget, inside a "sidebar".
 */
add_filter('widget_display_callback', function($instance, $widget, $args) {
	if (isset($instance['content'])) {
		$content = $instance['content'];
		if (0 === strpos($content, '<!-- wp:peepso/') && FALSE === strpos($content, '__sidebar_id')) {
			$instance['content'] = preg_replace_callback('/(\}?)(\s*\/-->)$/', function($matches) use ($args) {
				return ($matches[1]? ',' : ' {') . '"__sidebar_id":"' . $args['id'] . '"}' . $matches[2];
			}, $content);
		}
	}

	return $instance;
}, 10, 3);
