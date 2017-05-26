<?php
namespace Cms\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Cms\Model\Table\CmsPagesTable;

/**
 * Cms\Model\Table\CmsPagesTable Test Case
 */
class CmsPagesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \Cms\Model\Table\CmsPagesTable
     */
    public $CmsPages;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.cms.cms_pages'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CmsPages') ? [] : ['className' => 'Cms\Model\Table\CmsPagesTable'];
        $this->CmsPages = TableRegistry::get('CmsPages', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CmsPages);

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
}
