<?php
/**
 * DokuWiki Plugin templatepagename (Action Component)
 *
 * @license GPL 2 http://www.gnu.org/licenses/gpl-2.0.html
 * @author  Martin <martin@sound4.biz>
 * @author  Ben van Magill <ben.vanmagill16@gmail.com>
 */

/**
 * Class action_plugin_templatepagename_TemplatePageName
 */
class action_plugin_templatepagename_TemplatePageName extends dokuwiki\Extension\ActionPlugin {

    /**
     * Registers a callback function for a given event
     *
     * @param Doku_Event_Handler $controller
     */
    public function register(Doku_Event_Handler $controller) {
        $controller->register_hook('COMMON_PAGETPL_LOAD', 'BEFORE', $this, 'handle_common_pagetpl_load');
    }

    /**
     * Adjust the pagetemplate names
     *
     * @param Doku_Event $event
     * @param $param
     */
    public function handle_common_pagetpl_load(Doku_Event $event, $param) {
        global $conf;

        // from here is it almost the same code as inc/common.php pageTemplate
        // function (core dokuwiki) but vars name are adjusted to be used
        // within the plugin.

        // Dont run if tplfile already exists
        if(!empty($event->data['tplfile'])) return;

        $path    = dirname(wikiFN($event->data['id']));
        $current = noNS($event->data['id']);
        $len     = strlen(rtrim($conf['datadir'], '/'));

        // Search 
        $search_order = array(
            $this->getConf('current_pagename_prefix'),
            $this->getConf('first_inherited_pagename_prefix'),
            $this->getConf('any_inherited_pagename_prefix')
        );
        $search_len   = count($search_order)-1;

        $shift  = 0; // Shift for search order. First search directory for presence of any template, then one level above, or any levels above.
        while(strlen($path) >= $len) {
            if ($shift>$search_len) $shift = $search_len; //Keep final shift on any level namespace

            // Will only iterate through full search order once (current namespace). Returns on first match.
            for ($i = $shift; $i<=$search_len; $i++) {
                $prefix = $search_order[$i];

                // Search for templates with same name before generic template.txt
                if(@file_exists($path . '/' . $prefix . $current . '.txt')) {
                    $event->data['tplfile'] = $path . '/' . $prefix . $current . '.txt';
                    return;
                }
                if(@file_exists($path . '/' . $prefix . 'template.txt')) {
                    $event->data['tplfile'] = $path . '/' . $prefix .'template.txt';
                    return;
                } 
            }
            $path = substr($path, 0, strrpos($path, '/'));
            $shift++;
        }
    }

}
