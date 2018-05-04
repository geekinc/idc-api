<?php
/**
 * Created by PhpStorm.
 * User: tecnova
 * Date: 26-03-2018
 * Time: 10:57
 */

namespace SLIMAPI\Controller\API\includes;


class Utils
{
    function tailFile($filepath, $lines) {
        ob_start();
        passthru('tail -'  . $lines . ' ' . escapeshellarg($filepath));
        return trim(ob_get_clean());
    }
}