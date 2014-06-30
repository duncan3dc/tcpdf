<?php

namespace duncan3dc\Tcpdf;

class Snappy extends \Knp\Snappy\Pdf {

    protected static $path;


    public function __construct($path=false) {

        if(!$path) {
            if(!$path = static::$path) {
                # Chcek which version we should use based on the current machine architecture
                $bin = "wkhtmltopdf-";
                if(posix_uname()["machine"][0] == "i") {
                    $bin .= "i386";
                } else {
                    $bin .= "amd64";
                }

                # Start in the directory that we are in
                $path = __DIR__;
                # Move up to the composer vendor directory
                $path .= "/../../..";
                # Add the wkhtmltopdf binary path
                $path .= "/h4cc/" . $bin . "/bin/" . $bin;

                static::$path = $path;
            }
        }

        parent::__construct($path);

    }


}
