<?php

$plugin = $vars['entity'];
/* @var ElggPlugin $plugin */

$user_whitelist_guids = $plugin->getSetting('user_whitelist_guids');
if ($user_whitelist_guids) {
    $user_whitelist_guids = explode(',', $user_whitelist_guids);
} else {
    $user_whitelist_guids = array();
}

$plus = elgg_is_active_plugin('userpicker_plus') ? '_plus' : '';
$input = elgg_view("input/userpicker$plus", array(
    'value' => $user_whitelist_guids,
));

echo "<h4>Whitelist</h4>";
echo "<p>Deprecation notices will only be visible to admins in this list:</p>";
echo "<div style='border:1px solid #ccc;padding:1em; margin:1em'>$input</div>";