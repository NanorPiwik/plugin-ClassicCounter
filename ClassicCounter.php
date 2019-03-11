<?php
/**
 * Piwik - free/libre analytics platform
 *
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
// I changed the name here
namespace Piwik\Plugins\ClassicDownloadsCounter;

use Piwik\Access;

class ClassicCounter extends \Piwik\Plugin
{
    public static function getVisitorCount($idSite) {
        $visitsCount = Access::getInstance()->doAsSuperUser(function () use ($idSite) {
            // I changed this part here
            return \Piwik\API\Request::processRequest('Actions.getDownloads', array(
                'idSite' => $idSite,
                'period' => "range",
                'date' => "2000-01-01,2030-01-01",
            ))->getFirstRow()["nb_hits"];
        });
        return (int)$visitsCount;
    }

}
