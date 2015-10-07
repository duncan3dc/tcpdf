<?php

namespace duncan3dc\Tcpdf;

use duncan3dc\Helpers\Helper;

class Pdf extends \TCPDF
{
    /**
     * @var callable $headerFunction A function to run each time a new page is started
     */
    public  $headerFunction;

    /**
     * @var callable $footerFunction A function to run each time a page ends
     */
    public  $footerFunction;

    /**
     * @var int $defaultCellHeight The default height of a cell
     */
    public  $defaultCellHeight;


    public function __construct($options = null)
    {
        $options = Helper::getOptions($options, [
            "orientation"   =>  "P",
            "unit"          =>  "mm",
            "format"        =>  "A4",
            "unicode"       =>  true,
            "encoding"      =>  "UTF-8",
            "diskcache"     =>  false,
            "addpage"       =>  true,
            "pagebreaks"    =>  true,
            "header"        =>  false,
            "footer"        =>  false,
        ]);

        parent::__construct($options["orientation"], $options["unit"], $options["format"], $options["unicode"], $options["encoding"], $options["diskcache"]);

        $this->setPrintHeader($options["header"]);
        $this->setPrintFooter($options["footer"]);

        # Set auto page breaks
        $this->SetAutoPageBreak($options["pagebreaks"]);

        # Set font
        $this->SetFont("dejavusans", "", 10);

        # Set the default margin
        $this->SetMargins(4, 4);

        # Add a page
        if ($options["addpage"]) {
            $this->AddPage();
        }

        $this->headerFunction = false;
        $this->footerFunction = false;

        $this->defaultCellHeight = 0;
    }


    public function addCell($options)
    {
        $o = Helper::getOptions($options, [
            "width"     =>  0,
            "height"    =>  $this->defaultCellHeight,
            "content"   =>  "",
            "border"    =>  0,
            "align"     =>  "",
            "fill"      =>  false,
            "link"      =>  "",
            "stretch"   =>  0,
            "calign"    =>  "T",
            "valign"    =>  "M",
            "style"     =>  "",
        ]);

        if ($style = $o["style"]) {
            $current = $this->getFontStyle();
            $this->SetFont("", $style);
        }

        $return = $this->Cell($o["width"], $o["height"], $o["content"], $o["border"], 0, $o["align"],
                                $o["fill"], $o["link"], $o["stretch"], false, $o["calign"], $o["valign"]);

        if ($style) {
            $this->SetFont("", $current);
        }

        return $return;
    }


    public function moveX($move)
    {
        $x = $this->getX();

        $x += $move;

        return $this->setX($x);
    }


    public function moveY($move)
    {
        $y = $this->getY();

        $y += $move;

        return $this->setY($y);
    }


    public function bold($on = null)
    {
        $style = $this->getFontStyle();

        $style = str_replace("B", "", $style);

        if ($on) {
            $style .= "B";
        }

        return $this->setFont("", $style);
    }


    public function Header()
    {
        if (!$func = $this->headerFunction) {
            return false;
        }

        $func($this);

        return true;
    }


    public function Footer()
    {
        if (!$func = $this->footerFunction) {
            return false;
        }

        $func($this);

        return true;
    }
}
