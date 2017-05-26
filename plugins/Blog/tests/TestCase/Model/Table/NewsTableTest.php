<?php
namespace News\Test\TestCase\Model\Table;

use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use News\Model\Table\NewsTable;

/**
 * News\Model\Table\NewsTable Test Case
 */
class NewsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \News\Model\Table\NewsTable
     */
    public $News;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.news.news',
        'plugin.news.masters'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('News') ? [] : ['className' => 'News\Model\Table\NewsTable'];
        $this->News = TableRegistry::get('News', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->News);

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
