<?php

/**
 * Used to validate a textarea used for json
 *
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @copyright 2011 Petr Skoda (http://skodak.org)
 */
class admin_setting_configjson extends admin_setting_configtextarea {

    /**
     * Validate the contents of the textarea as JSON
     *
     * @param string $data A JSON string
     * @return mixed bool true for success or string:error on failure
     */
    public function validate($data) {
        // TODO: All this.
        if(!empty($data)) {
            $ips = explode("\n", $data);
        } else {
            return true;
        }
        $result = true;
        $badips = array();
        foreach($ips as $ip) {
            $ip = trim($ip);
            if (empty($ip)) {
                continue;
            }
            if (preg_match('#^(\d{1,3})(\.\d{1,3}){0,3}$#', $ip, $match) ||
                preg_match('#^(\d{1,3})(\.\d{1,3}){0,3}(\/\d{1,2})$#', $ip, $match) ||
                preg_match('#^(\d{1,3})(\.\d{1,3}){3}(-\d{1,3})$#', $ip, $match)) {
            } else {
                $result = false;
                $badips[] = $ip;
            }
        }
        if($result) {
            return true;
        } else {
            return get_string('validateiperror', 'admin', join(', ', $badips));
        }
    }
}
