<?php
/**
 * User: thanhdx
 * Date: 6/9/12
 * Time: 9:03 PM
 * @file XenforeLoader.php
 */
class XenforeLoader
{
    static function  getPath()
    {
        return Yii::getPathOfAlias('webroot').'/forum/library';
    }

    static function autoload($class)
    {
        if (preg_match('#[^a-zA-Z0-9_]#', $class)) {
            return false;
        }
        $xenforoLib = self::getPath();

        if (@ini_get('open_basedir'))
        {
            // many servers don't seem to set include_path correctly with open_basedir, so don't use it
            set_include_path($xenforoLib . PATH_SEPARATOR . '.');
        }
        else
        {
            set_include_path($xenforoLib . PATH_SEPARATOR . '.' . PATH_SEPARATOR . get_include_path());
        }

        $filename = $xenforoLib . '/' . str_replace('_', '/', $class) . '.php';
        if (!$filename)
        {
            return false;
        }

        if (file_exists($filename))
        {
            include($filename);
            return (class_exists($class, false) || interface_exists($class, false));
        }
    }

}
