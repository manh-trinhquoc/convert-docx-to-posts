<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit83df7ea8a6f4a5151a7ea6f146fc1dc6
{
    public static $files = array (
        '42671a413efb740d7040437ff2a982cd' => __DIR__ . '/..' . '/ayecode/wp-super-duper/sd-functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PhpOffice\\PhpWord\\' => 18,
        ),
        'L' => 
        array (
            'Laminas\\Escaper\\' => 16,
        ),
        'I' => 
        array (
            'Inpsyde\\' => 8,
        ),
        'C' => 
        array (
            'Convert_Docx_To_Posts\\Rest\\' => 27,
            'Convert_Docx_To_Posts\\Internals\\' => 32,
            'Convert_Docx_To_Posts\\Integrations\\' => 35,
            'Convert_Docx_To_Posts\\Engine\\' => 29,
            'Convert_Docx_To_Posts\\Cli\\' => 26,
            'Convert_Docx_To_Posts\\Backend\\' => 30,
            'Convert_Docx_To_Posts\\Ajax\\' => 27,
            'Composer\\Installers\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PhpOffice\\PhpWord\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpoffice/phpword/src/PhpWord',
        ),
        'Laminas\\Escaper\\' => 
        array (
            0 => __DIR__ . '/..' . '/laminas/laminas-escaper/src',
        ),
        'Inpsyde\\' => 
        array (
            0 => __DIR__ . '/..' . '/inpsyde/wp-context/src',
        ),
        'Convert_Docx_To_Posts\\Rest\\' => 
        array (
            0 => __DIR__ . '/../..' . '/rest',
        ),
        'Convert_Docx_To_Posts\\Internals\\' => 
        array (
            0 => __DIR__ . '/../..' . '/internals',
        ),
        'Convert_Docx_To_Posts\\Integrations\\' => 
        array (
            0 => __DIR__ . '/../..' . '/integrations',
        ),
        'Convert_Docx_To_Posts\\Engine\\' => 
        array (
            0 => __DIR__ . '/../..' . '/engine',
        ),
        'Convert_Docx_To_Posts\\Cli\\' => 
        array (
            0 => __DIR__ . '/../..' . '/cli',
        ),
        'Convert_Docx_To_Posts\\Backend\\' => 
        array (
            0 => __DIR__ . '/../..' . '/backend',
        ),
        'Convert_Docx_To_Posts\\Ajax\\' => 
        array (
            0 => __DIR__ . '/../..' . '/ajax',
        ),
        'Composer\\Installers\\' => 
        array (
            0 => __DIR__ . '/..' . '/composer/installers/src/Composer/Installers',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'WP_Super_Duper' => __DIR__ . '/..' . '/ayecode/wp-super-duper/wp-super-duper.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit83df7ea8a6f4a5151a7ea6f146fc1dc6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit83df7ea8a6f4a5151a7ea6f146fc1dc6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit83df7ea8a6f4a5151a7ea6f146fc1dc6::$classMap;

        }, null, ClassLoader::class);
    }
}
