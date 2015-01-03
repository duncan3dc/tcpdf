<?php

namespace duncan3dc\Tcpdf;

class PdfTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        $this->assertInstanceOf("TCPDF", new Pdf);
    }


    public function testMoveX()
    {
        $pdf = new PDf;
        $x = $pdf->getX();
        $pdf->moveX(10);
        $this->assertEquals($x + 10, $pdf->getX());
    }


    public function testMoveY()
    {
        $pdf = new PDf;
        $y = $pdf->getY();
        $pdf->moveY(4);
        $this->assertEquals($y + 4, $pdf->getY());
    }
}
