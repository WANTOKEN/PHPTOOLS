<?php
// Load source and mask
$source = imagecreatefromjpeg('http://biu-cn.dwstatic.com/zbshenqi/20200121/08e9e497ae64496f9788590e42ccbab0.jpg?w=798&h=798');
$mask = imagecreatefromjpeg('http://biu-cn.dwstatic.com/zbshenqi/20200121/08e9e497ae64496f9788590e42ccbab0.jpg?w=798&h=798');
// Apply mask to source
imagealphamask($source, $mask);
// Output
header("Content-type: image/png");
imagepng($source);

function imagealphamask(&$picture, $mask)
{
// Get sizes and set up new picture
    $xSize = imagesx($picture);
    $ySize = imagesy($picture);
    $newPicture = imagecreatetruecolor($xSize, $ySize);
    imagesavealpha($newPicture, true);
    imagefill($newPicture, 0, 0, imagecolorallocatealpha($newPicture, 0, 0, 0, 127));

// Resize mask if necessary
    if ($xSize != imagesx($mask) || $ySize != imagesy($mask)) {
        $tempPic = imagecreatetruecolor($xSize, $ySize);
        imagecopyresampled($tempPic, $mask, 0, 0, 0, 0, $xSize, $ySize, imagesx($mask), imagesy($mask));
        imagedestroy($mask);
        $mask = $tempPic;
    }

// Perform pixel-based alpha map application
    for ($x = 0; $x < $xSize; $x++) {
        for ($y = 0; $y < $ySize; $y++) {
            $alpha = imagecolorsforindex($mask, imagecolorat($mask, $x, $y));

            if (($alpha['red'] == 0) && ($alpha['green'] == 0) && ($alpha['blue'] == 0) && ($alpha['alpha'] == 0)) {
// It's a black part of the mask
                imagesetpixel($newPicture, $x, $y, imagecolorallocatealpha($newPicture, 0, 0, 0, 127)); // Stick a black, but totally transparent, pixel in.
            } else {
                $source = imagecreatefromjpeg('http://biu-cn.dwstatic.com/zbshenqi/20200121/08e9e497ae64496f9788590e42ccbab0.jpg?w=798&h=798');
// Check the alpha state of the corresponding pixel of the image we're dealing with.
                $alphaSource = imagecolorsforindex($source, imagecolorat($source, $x, $y));

                if (($alphaSource['alpha'] == 127)) {
                    imagesetpixel($newPicture, $x, $y, imagecolorallocatealpha($newPicture, 0, 0, 0, 127)); // Stick a black, but totally transparent, pixel in.
                } else {
                    $color = imagecolorsforindex($source, imagecolorat($source, $x, $y));
                    imagesetpixel($newPicture, $x, $y, imagecolorallocatealpha($newPicture, $color['red'], $color['green'], $color['blue'], $color['alpha'])); // Stick the pixel from the source image in
                }


            }
        }
    }

// Copy back to original picture
    imagedestroy($picture);
    $picture = $newPicture;
}