<?php

/**
 * LimeSurvey plugin to assign question script and XSS filter permissions
 * on a user by basis
 * php version 8.1
 *
 * @category Plugin
 * @package  LimeSurvey
 * @author   Adam Zammit <adam.zammit@acspri.org.au>
 * @license  GPLv3 https://www.gnu.org/licenses/gpl-3.0.en.html
 * @link     https://www.github.com/adamzammit/ScriptXSSPermissions
 */
class ScriptXSSPermissions extends LimeSurvey\PluginManager\PluginBase
{
    protected $storage = 'LimeSurvey\PluginManager\DbStorage';

    protected static $description = ' Assign question script and XSS filter '
        . ' permissions on a user by user basis';
    protected static $name = 'ScriptXSSPermissions';

    /**
     * Set subscribed actions for this plugin
     *
     * @return none
     */
    public function init()
    {
        $this->subscribe('getGlobalBasePermissions');
        $this->subscribe('afterSuccessfulLogin', 'setPermissions');
        $this->subscribe('beforeControllerAction');
    }

    /**
     * Add question script permissions to global permissions
     * @return void
     */
    public function getGlobalBasePermissions()
    {
        $this->getEvent()->append('globalBasePermissions', [
            'question_script' => [
                'create' => false,
                'read' => false,
                'delete' => false,
                'import' => false,
                'export' => false,
                'title' => gT("Allow question javascript editing"),
                'description' => gT("Allow question javascript editing"),
                'img' => 'ri-javascript-fill'
            ],
             'filter_xss' => [
                'create' => false,
                'read' => false,
                'delete' => false,
                'import' => false,
                'export' => false,
                'title' => gT("Disable XSS filter"),
                'description' => gT("Disable XSS filter"),
                'img' => 'ri-shield-keyhole-fill'
            ],
        ]);
    }

    /**
     * If inside admin controller, set permissions
     * @return void
     */
    public function beforeControllerAction()
    {
        $controller = $this->getEvent()->get('controller');
        if ($controller === 'questionAdministration') {
            $this->setPermissions();
        }
    }

    /**
     * If user has script permission - override global config to allow
     * @return void
     */
    public function setPermissions()
    {
        $oEvent = $this->getEvent();
        if (Permission::model()->hasGlobalPermission('question_script', 'update')) {
            Yii::app()->setConfig('disablescriptwithxss', "0");
        }
        if (Permission::model()->hasGlobalPermission('filter_xss', 'update')) {
            Yii::app()->setConfig('filterxsshtml', "0");
        }
    }
}
