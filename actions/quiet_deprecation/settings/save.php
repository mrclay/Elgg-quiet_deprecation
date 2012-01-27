<?php

$plugin = elgg_get_plugin_from_id('quiet_deprecation');
/* @var ElggPlugin $plugin */
$plugin_name = $plugin->getManifest()->getName();
$params = get_input('params');
$members = get_input('members');

$user_whitelist_guids = '';
if (is_array($members) && $members) {
    $user_whitelist_guids = implode(',', $members);
}
$plugin->setSetting('user_whitelist_guids', $user_whitelist_guids);

// whatever else gets passed as params
foreach ($params as $k => $v) {
    $result = $plugin->setSetting($k, $v);
    if (!$result) {
        register_error(elgg_echo('plugins:settings:save:fail', array($plugin_name)));
        forward(REFERER);
        exit;
    }
}

system_message(elgg_echo('plugins:settings:save:ok', array($plugin_name)));
forward(REFERER);