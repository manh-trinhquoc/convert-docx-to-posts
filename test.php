<?php

require "vendor/autoload.php";

$fileTmp =  "sample.docx";
$phpWord = \PhpOffice\PhpWord\IOFactory::load($fileTmp);
$htmlWriter = new \PhpOffice\PhpWord\Writer\HTML($phpWord);
// $htmlWriter->save('test1doc.html');

$class_method = get_class_methods($htmlWriter);
// var_dump($class_method);
// var_dump($htmlWriter);

echo $htmlWriter->getContent();