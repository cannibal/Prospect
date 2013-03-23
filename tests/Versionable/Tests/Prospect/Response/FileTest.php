<?php

namespace Versionable\Prospect\Response;

/**
 * Test class for File.
 * Generated by PHPUnit on 2012-09-12 at 11:03:15.
 */
class FileTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var File
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new File();
    }

   /**
    * @covers Versionable\Prospect\Response\File::__construct
    * @covers Versionable\Prospect\Response\File::getFilename
    */
    public function testGetFilename()
    {
      $filename = $this->object->getFilename();
      $this->assertNotNull($filename);

      $test = new \SplFileInfo($filename);
      $this->assertFalse($test->isFile());
    }

    /**
     * @depends testGetFilename
     * @covers Versionable\Prospect\Response\File::setFilename
     * @covers Versionable\Prospect\Response\File::getFilename
     */
    public function testSetFilename()
    {
        $filename = 'test';

        $this->object->setFilename($filename);
        $this->assertEquals($filename, $this->object->getFilename());
    }
}