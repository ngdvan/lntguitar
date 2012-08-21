<?php
/**
 * User: thanhdx
 * Date: 6/10/12
 * Time: 1:38 PM
 * @file BoxProfile.php
 */
class BoxProfile extends CWidget
{
    /**
     * @var $user XfUser
     */
    public $user;
    public function run(){
        //$this->user = XfUser::model()->find("username='".$_GET['username']."'");
        echo CHtml::openTag("div",array('id'=>"box_profile"));
        echo CHtml::image(Lnt::get_picture_href($this->user->user_id),'',array('width'=>'70px','height'=>'70px'));
        echo CHtml::openTag("p");
        echo $this->user->username;
        echo CHtml::closeTag("p");

        echo CHtml::openTag("div",array('class'=>'o_like'));
        echo CHtml::openTag("p",array('class'=>'like'));
        echo "5.134";
        echo CHtml::closeTag("p");
        echo CHtml::closeTag("div");

        echo CHtml::openTag("div",array('class'=>'reg_date'));
        echo "<span style='color:#2DB5DC'>Lưu bút</span><br/>";
        echo "Ym:<br/>";
        echo "Skype:<br/>";
        echo "Email: {$this->user->email} <br/>";
        echo "Website:<br/>";
        echo "Facebook:<br/>";
        echo "Điện thoại:<br/>";
        echo "<div style='font-size:11px;color:#797979;'>Ngày đăng ký: ".date("d/m/Y - H:i",$this->user->register_date)."</div>";
        echo "<div style='font-size:11px;color:#797979;'>Đăng nhập cuối: ".date("d/m/Y - H:i",$this->user->last_activity)."</div>";

        echo CHtml::closeTag("div");
        echo CHtml::closeTag("div");
    }
}
