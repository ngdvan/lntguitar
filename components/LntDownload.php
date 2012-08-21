<?php
/**
 * User: thanhdx
 * Date: 8/5/12
 * Time: 10:18 AM
 * @file LntDownload.php
 */
class LntDownload
{
    static function download($path){

// place this code inside a php file and call it f.e. "download.php"
        $fullPath = Yii::getPathOfAlias('webroot').$path; // change the path to fit your websites document structure

        if ($fd = fopen ($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);
            switch ($ext) {
                case "xml":
                    header("Content-type: application/xml"); // add here more headers for diff. extensions
                    header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\"");
                    break;
                case "pdf":
                    header("Content-type: application/pdf"); // add here more headers for diff. extensions
                    header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a download
                    break;
                default;
                    header("Content-type: application/octet-stream");
                    header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
            }
            header("Content-length: $fsize");
            header("Cache-control: private"); //use this to open files directly
            while(!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        }
        fclose ($fd);
        exit;
    }
}
