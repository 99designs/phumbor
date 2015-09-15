<?php

namespace Thumbor\Url;

use PHPUnit_Framework_TestCase as TestCase;

class CommandSetTest extends TestCase
{
    public function testDefaults()
    {
        $commandSet = new CommandSet();
        $this->assertEquals(
            array(),
            $commandSet->toArray()
        );
    }

    public function testTrim()
    {
        $commandSet = new CommandSet();
        $commandSet->trim();
        $this->assertEquals(
            array('trim'),
            $commandSet->toArray()
        );
        $commandSet->trim('bottom-right');
        $this->assertEquals(
            array('trim:bottom-right'),
            $commandSet->toArray()
        );
        $commandSet->trim('top-left', 50);
        $this->assertEquals(
            array('trim:top-left:50'),
            $commandSet->toArray()
        );
    }

    public function testCrop()
    {
        $commandSet = new CommandSet();
        $commandSet->crop(1, 2, 3, 4);
        $this->assertEquals(
            array('1x2:3x4'),
            $commandSet->toArray()
        );
    }

    public function testFitIn()
    {
        $commandSet = new CommandSet();
        $commandSet->fitIn(5, 6);
        $this->assertEquals(
            array('fit-in/5x6'),
            $commandSet->toArray()
        );
    }

    public function testResize()
    {
        $commandSet = new CommandSet();
        $commandSet->resize(5, 6);
        $this->assertEquals(
            array('5x6'),
            $commandSet->toArray()
        );
    }

    public function testHalign()
    {
        $commandSet = new CommandSet();
        $commandSet->halign('center');
        $this->assertEquals(
            array('center'),
            $commandSet->toArray()
        );
    }

    public function testValign()
    {
        $commandSet = new CommandSet();
        $commandSet->valign('bottom');
        $this->assertEquals(
            array('bottom'),
            $commandSet->toArray()
        );
    }

    public function testSmartCrop()
    {
        $commandSet = new CommandSet();
        $commandSet->smartCrop(true);
        $this->assertEquals(
            array('smart'),
            $commandSet->toArray()
        );
    }

    public function testAddFilter()
    {
        $commandSet = new CommandSet();
        $commandSet->addFilter('foo');
        $commandSet->addFilter('bar', 'baz');
        $commandSet->addFilter('bla', 'quux', 42);
        $this->assertEquals(
            array('filters:foo():bar(baz):bla(quux,42)'),
            $commandSet->toArray()
        );
    }

    public function testMetadataOnly()
    {
        $commandSet = new CommandSet();
        $commandSet->metadataOnly(true);
        $this->assertEquals(
            array('meta'),
            $commandSet->toArray()
        );
    }
}
