<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BlogFunction
 *
 * @author thanhdx
 */
class Lnt
{
    const  WEB = 'http://dev.lnt.com';

    //put your code here
    static function removeHtmlTag($str)
    {
        $str = self::post_db_parse_html($str);
        //$str = html_entity_decode($this->post_db_parse_html($str),ENT_QUOTES, "UTF-8");
        //return strip_tags(html_entity_decode($str, ENT_QUOTES, "UTF-8"));
        return strip_tags($str);
    }

    static function limitWord($str, $length, $ellipsis = '...')
    {
        $str = self::removeMultiSpace($str);
        return (count($words = explode(' ', $str)) > $length)
            ? implode(' ', array_slice($words, 0, $length)) . $ellipsis : $str;
    }

    static function removeMultiSpace($str)
    {
        $str = self::removeHtmlTag($str);
        return preg_replace('/\s{2,}/i', ' ', $str);
    }

    static function getAssets($alias_of_path,$republish=false){
        $assetsUrl = '';
        if ($alias_of_path) {
            $assetsPath = Yii::getPathOfAlias($alias_of_path);
            // We need to republish the assets if debug mode is enabled.
            if ($republish === true)
                $assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath, false, -1, true);
            else
                $assetsUrl = Yii::app()->getAssetManager()->publish($assetsPath);
        }

        return $assetsUrl;
    }
    static function post_db_parse_html($t = "")
    {
        if ($t == "") {
            return $t;
        }
        $t = str_replace("&#39;", "'", $t);
        $t = str_replace("&#33;", "!", $t);
        $t = str_replace("&#036;", "$", $t);
        $t = str_replace("&#124;", "|", $t);
        $t = str_replace("&amp;", "&", $t);
        $t = str_replace("&gt;", ">", $t);
        $t = str_replace("&lt;", "<", $t);
        $t = str_replace("&quot;", '"', $t);

        //-----------------------------------------
        // Take a crack at parsing some of the nasties
        // NOTE: THIS IS NOT DESIGNED AS A FOOLPROOF METHOD
        // AND SHOULD NOT BE RELIED UPON!
        //-----------------------------------------

        $t = preg_replace("/javascript/i", "j&#097;v&#097;script", $t);
        $t = preg_replace("/alert/i", "&#097;lert", $t);
        $t = preg_replace("/about:/i", "&#097;bout:", $t);
        $t = preg_replace("/onmouseover/i", "&#111;nmouseover", $t);
        $t = preg_replace("/onmouseout/i", "&#111;nmouseout", $t);
        $t = preg_replace("/onclick/i", "&#111;nclick", $t);
        $t = preg_replace("/onload/i", "&#111;nload", $t);
        $t = preg_replace("/onsubmit/i", "&#111;nsubmit", $t);
        //$t = preg_replace( "/object/i"   , "&#111;bject"       , $t );
        $t = preg_replace("/frame/i", "fr&#097;me", $t);
        $t = preg_replace("/applet/i", "&#097;pplet", $t);
        $t = preg_replace("/meta/i", "met&#097;", $t);
        //$t = preg_replace( "/embed/i"   , "met&#097;"       , $t );

        return $t;
    }

    static function stripUnicode($str)
    {
        if (!$str)
            return false;
        $marTViet = array("à", "á", "ạ", "ả", "ã", "â", "ầ", "ấ", "ậ", "ẩ", "ẫ", "ă",
            "ằ", "ắ", "ặ", "ẳ", "ẵ", "è", "é", "ẹ", "ẻ", "ẽ", "ê", "ề"
        , "ế", "ệ", "ể", "ễ",
            "ì", "í", "ị", "ỉ", "ĩ",
            "ò", "ó", "ọ", "ỏ", "õ", "ô", "ồ", "ố", "ộ", "ổ", "ỗ", "ơ"
        , "ờ", "ớ", "ợ", "ở", "ỡ",
            "ù", "ú", "ụ", "ủ", "ũ", "ư", "ừ", "ứ", "ự", "ử", "ữ",
            "ỳ", "ý", "ỵ", "ỷ", "ỹ",
            "đ",
            "À", "Á", "Ạ", "Ả", "Ã", "Â", "Ầ", "Ấ", "Ậ", "Ẩ", "Ẫ", "Ă"
        , "Ằ", "Ắ", "Ặ", "Ẳ", "Ẵ",
            "È", "É", "Ẹ", "Ẻ", "Ẽ", "Ê", "Ề", "Ế", "Ệ", "Ể", "Ễ",
            "Ì", "Í", "Ị", "Ỉ", "Ĩ",
            "Ò", "Ó", "Ọ", "Ỏ", "Õ", "Ô", "Ồ", "Ố", "Ộ", "Ổ", "Ỗ", "Ơ"
        , "Ờ", "Ớ", "Ợ", "Ở", "Ỡ",
            "Ù", "Ú", "Ụ", "Ủ", "Ũ", "Ư", "Ừ", "Ứ", "Ự", "Ử", "Ữ",
            "Ỳ", "Ý", "Ỵ", "Ỷ", "Ỹ",
            "Đ");

        $marKoDau = array("a", "a", "a", "a", "a", "a", "a", "a", "a", "a", "a"
        , "a", "a", "a", "a", "a", "a",
            "e", "e", "e", "e", "e", "e", "e", "e", "e", "e", "e",
            "i", "i", "i", "i", "i",
            "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o", "o"
        , "o", "o", "o", "o", "o",
            "u", "u", "u", "u", "u", "u", "u", "u", "u", "u", "u",
            "y", "y", "y", "y", "y",
            "d",
            "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A", "A"
        , "A", "A", "A", "A", "A",
            "E", "E", "E", "E", "E", "E", "E", "E", "E", "E", "E",
            "I", "I", "I", "I", "I",
            "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O", "O"
        , "O", "O", "O", "O", "O",
            "U", "U", "U", "U", "U", "U", "U", "U", "U", "U", "U",
            "Y", "Y", "Y", "Y", "Y",
            "D");

        $str = str_replace($marTViet, $marKoDau, $str);
        return $str;
    }

    static function safeTitle($str)
    {
        return self::_name_cleaner(self::stripUnicode($str));
    }

    private static function _name_cleaner($name, $replace_string = "-")
    {
        $name = preg_replace("/\s\-/", "", $name);
        $name = preg_replace("/\-/", "", $name);
        $name = preg_replace("/\s\s/", " ", $name);
        return strtolower(preg_replace("/[^a-zA-Z0-9\-\_]/", $replace_string, $name));
    }

    public static function filterLink($link)
    {
        if (strpos($link, 'http://hocgioi.com.vn') === 0 || strpos($link, 'http://www.hocgioi.com.vn') === 0 || strpos($link, 'http://hocgioi.com.vn') === 0 || strpos($link, 'http://') === false) {
            return "<a href=\"$link\" target=\"_blank\">";
        }
        return "<a href=\"$link\" rel=\"nofollow\" target=\"_blank\">";
    }

    /**
     * @static
     * @param $user_id
     * @return string
     * Get ảnh avatar thành viên
     */
    public static function get_picture_href($user_id)
    {
        if (file_exists(Yii::getPathOfAlias('webroot') . 'data/avatars/m/0/' . $user_id . '.jpg')) {

            return Yii::app()->baseUrl . '/forum/data/avatars/m/0/' . $user_id . '.jpg';
        } else {
            $user = XfUser::model()->findByPk($user_id);
            if ($user) {
                if ($user->gender == 'male') {
                    return Yii::app()->baseUrl . '/forum/styles/default/xenforo/avatars/avatar_male_m.png';
                } elseif ($user->gender == 'female') {
                    return Yii::app()->baseUrl . '/forum/styles/default/xenforo/avatars/avatar_female_m.png';
                } else {
                    return Yii::app()->baseUrl . '/forum/styles/default/xenforo/avatars/avatar_m.png';
                }
            }
            return Yii::app()->baseUrl . '/forum/styles/default/xenforo/avatars/avatar_m.png';
        }
    }

    static function getYoutubeImage($youtubeLink)
    {

        $imageurl = '';
        if ($youtubeLink) {
            $youtubeurl = '';
            preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/watch(\?v\=|\/v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $youtubeLink, $matches);
            if (isset($matches[0]))
                $youtubeurl = $matches[0];
            if ($youtubeurl)
                $imageurl = "http://i.ytimg.com/vi/{$matches[3]}/4.jpg";
            // look for YouTube embed
            else preg_match("/([a-zA-Z0-9\-\_]+\.|)youtube\.com\/(v\/)([a-zA-Z0-9\-\_]{11})([^<\s]*)/", $youtubeLink, $matches);

            if (isset($matches[0])) $youtubeurl = $matches[0];

            if ($youtubeurl)
                $imageurl = "http://i.ytimg.com/vi/{$matches[3]}/3.jpg";
        }

        // If there is no youtube thumbnail, show a default image
        if (!$imageurl) {
            $imageurl = Yii::app()->baseUrl . "/images/video.jpg";
        }

        // Spit out the image path
        return $imageurl;
    }

    static function createImage($image,$width,$height){
        if(!class_exists('Image',false)){
            Yii::import('application.extensions.image.Image');
        }
        $path = Yii::getPathOfAlias('webroot').$image;
        if(!is_file($path)){
            $path = Yii::getPathOfAlias('webroot').'/guitar.jpg';
        }

        $img = new Image($path);
        return $img->createThumb($width,$height);
    }

}

?>
