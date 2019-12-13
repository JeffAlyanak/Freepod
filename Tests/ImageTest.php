<?php

declare(strict_types=1);

// require_once __DIR__ . '/../freepod/freepod.php';
require_once DIR_VIEW . 'image.php';


use PHPUnit\Framework\TestCase;
use Orbitale\Component\ImageMagick\Command;

class ImageTest extends TestCase
{
	/**
	 *  @param string $imageName
	 *  @param string $imageSize
	 *  @param string $resizeType
	 *  @param string $fileName
	 * 
	 *  @dataProvider validImageSettings
	 */
	public function testValidConfigs($imageName, $imageSize, $resizeType, $fileName): void
	{
		static::assertNotEmpty($imageName);
		static::assertNotEmpty($imageSize);
		static::assertNotEmpty($resizeType);

		$img = new Image($imageName, $imageSize, $resizeType);
		$img->generateImage();

		static::assertFileExists(DIR_IMAGE . 'cache/' . $fileName);

	}

	public function validImageSettings(): ?\Generator
	{
		yield 0 => ["1.jpg", "Thumb", "Scale", "1_Scale_Thumb.jpg"];
		yield 1 => ["2.jpg", "Small", "CropCenter", "2_CropCenter_Small.jpg"];
		yield 2 => ["3.jpg", "Medium", "CropLeft", "3_CropLeft_Medium.jpg"];
		yield 3 => ["1.jpg", "Large", "CropRight", "1_CropRight_Large.jpg"];
		yield 4 => ["2.jpg", "Original", "CropTop", "2_CropTop_Original.jpg"];
		yield 5 => ["3.jpg", "Thumb", "CropBottom", "3_CropBottom_Thumb.jpg"];
	}
}