<?php
namespace phpbu\App\Backup;

/**
 * File test
 *
 * @package    phpbu
 * @subpackage tests
 * @author     Sebastian Feldmann <sebastian@phpbu.de>
 * @copyright  Sebastian Feldmann <sebastian@phpbu.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://www.phpbu.de/
 * @since      Class available since Release 1.1.5
 */
class FileTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Tests File::getFileInfo
     */
    public function testGetFileInfo()
    {
        $spl  = $this->getFileInfo();
        $file = new File($spl);
        $ret  = $file->getFileInfo();

        $this->assertEquals($spl, $ret, 'should be the same spl injected');
    }

    /**
     * Tests File::getSize
     */
    public function testGetSize()
    {
        $spl  = $this->getFileInfo();
        $file = new File($spl);
        $size = $file->getSize();

        $this->assertEquals($spl->getSize(), $size, 'size should match');
    }

    /**
     * Tests File::getFilename
     */
    public function testGetFilename()
    {
        $spl      = $this->getFileInfo();
        $file     = new File($spl);
        $filename = $file->getFilename();

        $this->assertEquals($spl->getFilename(), $filename);
    }

    /**
     * Tests File::getPath
     */
    public function testGetPath()
    {
        $spl  = $this->getFileInfo();
        $file = new File($spl);
        $path = $file->getPath();

        $this->assertEquals($spl->getPath(), $path);
    }

    /**
     * Tests File::getPathname
     */
    public function testGetPathname()
    {
        $spl  = $this->getFileInfo();
        $file = new File($spl);
        $path = $file->getPathname();

        $this->assertEquals($spl->getPathname(), $path);
    }

    /**
     * Tests File::getMTime
     */
    public function testGetMTime()
    {
        $spl  = $this->getFileInfo();
        $file = new File($spl);
        $time = $file->getMTime();

        $this->assertEquals($spl->getMTime(), $time);
    }

    /**
     * Tests File::isWritable
     */
    public function testIsWritable()
    {
        $spl      = $this->getDeletableFileInfo();
        $file     = new File($spl);
        $writable = $file->isWritable();

        unlink($spl->getPathname());

        $this->assertEquals(true, $writable);
    }

    /**
     * Tests File::unlink
     */
    public function testUnink()
    {
        $spl  = $this->getDeletableFileInfo();
        $file = new File($spl);
        $file->unlink();

        $existing = file_exists($spl->getPathname());

        $this->assertEquals(false, $existing);
    }

    /**
     * Tests File::unlink
     *
     * @expectedException \phpbu\App\Exception
     */
    public function testUninkFail()
    {
        $spl  = $this->getDeletableFileInfo();
        $file = new File($spl);

        // delete file so next unlink fails
        unlink($spl->getPathname());

        $file->unlink();

        $this->assertFalse(true, 'exception should be thrown');
    }

    /**
     * Return dummy FileInfo
     *
     * @return \SplFileInfo
     */
    protected function getFileInfo()
    {
        $spl  = new \SplFileInfo(__FILE__);
        return $spl;
    }

    /**
     * Create tmp file und return its FileInfo.
     *
     * @return \SplFileInfo
     */
    protected function getDeletableFileInfo()
    {
        $file = tempnam('.', '');
        $spl  = new \SplFileInfo($file);
        return $spl;
    }
}
