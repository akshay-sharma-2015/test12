<?php
namespace TextSetting\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use TextSetting\Model\Table\TextSettingsTable;

/**
 * TextSetting\Model\Table\TextSettingsTable Test Case
 */
class TextSettingsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \TextSetting\Model\Table\TextSettingsTable
     */
    public $TextSettings;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.text_setting.text_settings',
        'plugin.text_setting.languages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TextSettings') ? [] : ['className' => 'TextSetting\Model\Table\TextSettingsTable'];
        $this->TextSettings = TableRegistry::get('TextSettings', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TextSettings);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
