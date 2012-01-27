<?php

elgg_register_event_handler('init', 'system', 'quiet_deprecation_init');

function quiet_deprecation_init() {
    if (elgg_is_admin_logged_in()) {
        elgg_register_plugin_hook_handler('view', 'page/default', '_quiet_deprecation_alter_views');
        elgg_register_plugin_hook_handler('view', 'page/admin', '_quiet_deprecation_alter_views');
    }

    elgg_register_action('quiet_deprecation/settings/save', __DIR__ . '/actions/quiet_deprecation/settings/save.php');
}

function _quiet_deprecation_alter_views($hook, $type, $returnValue, $params) {
    if ($params['viewtype'] !== 'default') {
        return $returnValue;
    }
    $haystack = ',' . elgg_get_plugin_setting('user_whitelist_guids', 'quiet_deprecation') . ',';
    $needle = "," . elgg_get_logged_in_user_guid() . ",";
    if (false === strpos($haystack, $needle)) {
        // strip notices
        $returnValue = preg_replace('@<pre>Deprecated in \\d[^<]+</pre>@', '', $returnValue);
    }
    return $returnValue;
}
