<?php

// Get block settings.
[
    'title' => $title,
    'limit' => $limit,
    'hide_empty' => $hide_empty,
    'show_total_online' => $show_total_online,
    'show_total_members' => $show_total_members,
] = $attributes;

$config = array();
$config['hideempty'] = (int) $hide_empty ? 1 : 0;
$config['totalmember'] = (int) $show_total_members ? 1 : 0;
$config['totalonline'] = (int) $show_total_online ? 1 : 0;
$config['limit'] = (int) $limit ? $limit : 5;

$id = 'peepso-online-members-' . md5(implode($config));

?><div class="ps-widget__wrapper--external ps-widget--external ps-js-widget-online-members"
        data-hideempty="<?php echo (int) $hide_empty ?>"
        data-totalmember="<?php echo (int) $show_total_members ?>"
        data-totalonline="<?php echo $show_total_online ?>"
        data-limit="<?php echo (int) $limit ?>">
    <div class="ps-widget__header--external">
        <?php if (isset($widget_instance['before_title'])) echo $widget_instance['before_title']; ?>
        <?php echo $title; ?>
        <?php if (isset($widget_instance['after_title'])) echo $widget_instance['after_title']; ?>
    </div>
    <div class="ps-widget__body--external">
        <div class="psw-members ps-js-widget-content" id="<?php echo $id; ?>">
            <img src="<?php echo PeepSo::get_asset('images/ajax-loader.gif'); ?>">
        </div>
    </div>
</div>
