<?php

/*
	Simple example of watermarking
*/

/* Create Imagick object */
$Imagick = new Imagick();
/* Create a drawing object and set the font size */
$ImagickDraw = new ImagickDraw();
$ImagickDraw->setFontSize( 50 );

/* Read image into object*/
//$Imagick->readImage( 'http://biu-cn.dwstatic.com/zbshenqi/20200218/e90b3d8a9af91de6acff295efbe88c50.jpg?w=900&h=900' );

/* Seek the place for the text */
$ImagickDraw->setGravity( Imagick::GRAVITY_CENTER );

/* Write the text on the image */
$Imagick->annotateImage( $ImagickDraw, 4, 20, 0, "Test Watermark" );

/* Set format to png */
$Imagick->setImageFormat( 'png' );

/* Output */
header( "Content-Type: image/{$Imagick->getImageFormat()}" );
echo $Imagick->getImageBlob();

?>