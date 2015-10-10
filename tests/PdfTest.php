<?php

namespace duncan3dc\TcpdfTests;

use duncan3dc\Tcpdf\Pdf;

class PdfTest extends \PHPUnit_Framework_TestCase
{
    private $pdf;

    public function setUp()
    {
        $this->pdf = new Pdf;
    }


    public function testConstructor()
    {
        $this->assertInstanceOf("TCPDF", $this->pdf);
    }


    public function testMoveX()
    {
        $x = $this->pdf->getX();
        $this->pdf->moveX(10);
        $this->assertEquals($x + 10, $this->pdf->getX());
    }


    public function testMoveY()
    {
        $y = $this->pdf->getY();
        $this->pdf->moveY(4);
        $this->assertEquals($y + 4, $this->pdf->getY());
    }


    public function testGetOptions1()
    {
        $check = $this->pdf->getOptions([
            "test"  =>  "override",
        ], [
            "test"  =>  "default",
        ]);
        $this->assertSame("override", $check["test"]);
    }
    public function testGetOptions2()
    {
        $check = $this->pdf->getOptions([], [
            "test"  =>  "default",
        ]);
        $this->assertSame("default", $check["test"]);
    }
    public function testGetOptions3()
    {
        $check = $this->pdf->getOptions(null, [
            "test"  =>  "default",
        ]);
        $this->assertSame("default", $check["test"]);
    }
}
