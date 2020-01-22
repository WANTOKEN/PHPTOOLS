<?php
$IMG = new \Imagick();
var_dump($IMG);
function pngMerge($o_pic,$out_pic){
    $begin_r = 255;
    $begin_g = 250;
    $begin_b = 250;
    list($src_w, $src_h) = getimagesize($o_pic);// 获取原图像信息 宽高
    $src_im = imagecreatefromjpeg($o_pic); //读取png图片
    //imagesavealpha($src_im,true);//这里很重要 意思是不要丢了$src_im图像的透明色
    $src_white = imagecolorallocatealpha($src_im, 255, 255, 255,127); // 创建一副白色透明的画布
    for ($x = 0; $x < $src_w; $x++) {
        for ($y = 0; $y < $src_h; $y++) {
            $rgb = imagecolorat($src_im, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            if($r==255 && $g==255 && $b == 255){
                imagefill($src_im,$x, $y, $src_white); //填充某个点的颜色
                imagecolortransparent($src_im, $src_white); //将原图颜色替换为透明色
            }else{
                $yColor = imagecolorallocatealpha($src_im, $r, $g, $b,100);
                imagefill($src_im,$x, $y, $yColor); //填充某个点的颜色
                imagecolortransparent($src_im, $yColor); //将原图颜色替换为透明色
            }
            if (!($r <= $begin_r && $g <= $begin_g && $b <= $begin_b)) {
                imagefill($src_im, $x, $y, $src_white);//替换成白色
                imagecolortransparent($src_im, $src_white); //将原图颜色替换为透明色
            }
        }
    }


    $target_im = imagecreatetruecolor($src_w, $src_h);//新图

    imagealphablending($target_im,false);//这里很重要,意思是不合并颜色,直接用$target_im图像颜色替换,包括透明色;
    imagesavealpha($target_im,true);//这里很重要,意思是不要丢了$target_im图像的透明色;
    $tag_white = imagecolorallocatealpha($target_im, 255, 255, 255,127);//把生成新图的白色改为透明色 存为tag_white
    imagefill($target_im, 0, 0, $tag_white);//在目标新图填充空白色
    imagecolortransparent($target_im, $tag_white);//替换成透明色
    imagecopymerge($target_im, $src_im, 0, 0, 0, 0, $src_w, $src_h, 100);//合并原图和新生成的透明图
    imagepng($target_im,$out_pic);
    return $out_pic;

}


$o_pic = 'http://biu-cn.dwstatic.com/zbshenqi/20200121/08e9e497ae64496f9788590e42ccbab0.jpg?w=798&h=798';
$name = pngMerge($o_pic,'aaaa.png');
print_r($name);
