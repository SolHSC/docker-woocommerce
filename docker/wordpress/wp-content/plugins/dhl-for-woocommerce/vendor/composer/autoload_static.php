<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf157335b37588c2d91df9d32b4934c2d
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PR\\DHL\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PR\\DHL\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'PR\\DHL\\REST_API\\API_Client' => __DIR__ . '/../..' . '/includes/REST_API/API_Client.php',
        'PR\\DHL\\REST_API\\DHL_eCS_Asia\\Auth' => __DIR__ . '/../..' . '/includes/REST_API/DHL_eCS_Asia/Auth.php',
        'PR\\DHL\\REST_API\\DHL_eCS_Asia\\Client' => __DIR__ . '/../..' . '/includes/REST_API/DHL_eCS_Asia/Client.php',
        'PR\\DHL\\REST_API\\DHL_eCS_Asia\\Item_Info' => __DIR__ . '/../..' . '/includes/REST_API/DHL_eCS_Asia/Item_Info.php',
        'PR\\DHL\\REST_API\\Deutsche_Post\\Auth' => __DIR__ . '/../..' . '/includes/REST_API/Deutsche_Post/Auth.php',
        'PR\\DHL\\REST_API\\Deutsche_Post\\Client' => __DIR__ . '/../..' . '/includes/REST_API/Deutsche_Post/Client.php',
        'PR\\DHL\\REST_API\\Deutsche_Post\\Item_Info' => __DIR__ . '/../..' . '/includes/REST_API/Deutsche_Post/Item_Info.php',
        'PR\\DHL\\REST_API\\Drivers\\JSON_API_Driver' => __DIR__ . '/../..' . '/includes/REST_API/Drivers/JSON_API_Driver.php',
        'PR\\DHL\\REST_API\\Drivers\\Logging_Driver' => __DIR__ . '/../..' . '/includes/REST_API/Drivers/Logging_Driver.php',
        'PR\\DHL\\REST_API\\Drivers\\WP_API_Driver' => __DIR__ . '/../..' . '/includes/REST_API/Drivers/WP_API_Driver.php',
        'PR\\DHL\\REST_API\\Interfaces\\API_Auth_Interface' => __DIR__ . '/../..' . '/includes/REST_API/Interfaces/API_Auth_Interface.php',
        'PR\\DHL\\REST_API\\Interfaces\\API_Driver_Interface' => __DIR__ . '/../..' . '/includes/REST_API/Interfaces/API_Driver_Interface.php',
        'PR\\DHL\\REST_API\\Paket\\Auth' => __DIR__ . '/../..' . '/includes/REST_API/Paket/Auth.php',
        'PR\\DHL\\REST_API\\Paket\\Client' => __DIR__ . '/../..' . '/includes/REST_API/Paket/Client.php',
        'PR\\DHL\\REST_API\\Paket\\Pickup_Request_Info' => __DIR__ . '/../..' . '/includes/REST_API/Paket/Pickup_Request_Info.php',
        'PR\\DHL\\REST_API\\Parcel_DE\\Auth' => __DIR__ . '/../..' . '/includes/REST_API/Parcel_DE/Auth.php',
        'PR\\DHL\\REST_API\\Parcel_DE\\Client' => __DIR__ . '/../..' . '/includes/REST_API/Parcel_DE/Client.php',
        'PR\\DHL\\REST_API\\Parcel_DE\\Item_Info' => __DIR__ . '/../..' . '/includes/REST_API/Parcel_DE/Item_Info.php',
        'PR\\DHL\\REST_API\\Parcel_DE_MyAccount\\Auth' => __DIR__ . '/../..' . '/includes/REST_API/Parcel_DE_MyAccount/Auth.php',
        'PR\\DHL\\REST_API\\Parcel_DE_MyAccount\\Client' => __DIR__ . '/../..' . '/includes/REST_API/Parcel_DE_MyAccount/Client.php',
        'PR\\DHL\\REST_API\\Parcel_DE_MyAccount\\Item_Info' => __DIR__ . '/../..' . '/includes/REST_API/Parcel_DE_MyAccount/Item_Info.php',
        'PR\\DHL\\REST_API\\Request' => __DIR__ . '/../..' . '/includes/REST_API/Request.php',
        'PR\\DHL\\REST_API\\Response' => __DIR__ . '/../..' . '/includes/REST_API/Response.php',
        'PR\\DHL\\REST_API\\URL_Utils' => __DIR__ . '/../..' . '/includes/REST_API/URL_Utils.php',
        'PR\\DHL\\Utils\\API_Utils' => __DIR__ . '/../..' . '/includes/Utils/API_Utils.php',
        'PR\\DHL\\Utils\\Args_Parser' => __DIR__ . '/../..' . '/includes/Utils/Args_Parser.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf157335b37588c2d91df9d32b4934c2d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf157335b37588c2d91df9d32b4934c2d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf157335b37588c2d91df9d32b4934c2d::$classMap;

        }, null, ClassLoader::class);
    }
}
