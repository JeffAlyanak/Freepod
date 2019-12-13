<?php

use Orbitale\Component\ImageMagick\Command;

Class Image
{
	private $imageName;	    // Source image name.
	private $imageSize;     // Output size.
	private $resizeType;    // Resize type (crop/scale options).

	private $fileName;      // Name of file generated.

	public function __construct($name, $size, $type)
	{
		try
		{
			$this->imageSize = $this->checkSize($size);
			$this->resizeType = $this->checkResizeType($type);
			$this->imageName = $this->checkFilename($name);
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	private function checkSize($size): string
	{
		$validSizes = [
			"Thumb",
			"Small",
			"Medium",
			"Large",
			"Original"
		];

		if (in_array($size, $validSizes, true))
		{
			return $size;
		}
		else
		{
			throw new Exception("Invalid image size, valid options are:\n" . implode(",\n", $validSizes) . ".");
		}
	}

	private function checkResizeType($type): string
	{
		$validTypes= [
			"Scale",
			"CropCenter",
			"CropLeft",
			"CropRight",
			"CropTop",
			"CropBottom"
		];

		if (in_array($type, $validTypes, true))
		{
			return $type;
		}
		else
		{
			throw new Exception("Invalid resize type, valid options are:\n" . implode(",\n", $validTypes) . ".");
		}
	}

	private function checkFilename($name): string
	{
		$compatibleImageFormats = "/^(?i)[a-z0-9]+\.(3FR|3G2|3GP|AAI|ART|ARW|AVI|AVS|BGR|BGRA|BGRO|BIE|BMP|BMP2|BMP3|CAL|CALS|CANVAS|CAPaTION|CIN|CLIP|CMYK|CMYKA|CR2|CR3|CRW|CUBE|CUR|CUT|DATA|DCM|DCR|DCRAW|DCX|DDS|DFONT|DJVU|DNG|DPX|DXT1|DXT5|EPDF|EPI|EPS|EPSF|EPSI|EPT|EPT2|EPT3|ERF|EXR|FAX|FILE|FITS|FLV|FRACTAL|FTP|FTS|GIF|GIF87|GRADIENT|GRAY|GRAYA|GROUP4|HALD|HDR|HRZ|HTTP|HTTPS|ICB|ICO|ICON|IIQ|INLINE|IPL|J2C|J2K|JBG|JBIG|JNG|JNX|JP2|JPC|JPE|JPEG|JPG|JPM|JPS|JPT|K25|KDC|LABEL|M2V|M4V|MAC|MAP|MASK|MAT|MEF|MIFF|MKV|MNG|MONO|MOV|MP4|MPC|MPEG|MPG|MRW|MSL|MSVG|MTV|MVG|NEF|NRW|NULL|ORF|OTB|OTF|PAL|PALM|PAM|PATTERN|PBM|PCD|PCDS|PCL|PCT|PCX|PDB|PDF|PDFA|PEF|PES|PFA|PFB|PFM|PGM|PGX|PICON|PICT|PIX|PJPEG|PLASMA|PNG|PNG00|PNG24|PNG32|PNG48|PNG64|PNG8|PNM|POCKETMOD|PPM|PSB|PSD|PTIF|PWP|RAF|RAS|RAW|RGB|RGB565|RGBA|RGBO|RGF|RLA|RLE|RMF|RW2|SCR|SCT|SFW|SGI|SIX|SIXEL|SR2|SRF|STEGANO|SUN|SVG|SVGZ|TEXT|TGA|TIFF|TIFF64|TILE|TIM|TM2|TTC|TTF|TXT|UYVY|VDA|VICAR|VID|VIFF|VIPS|VST|WBMP|WMF|WMV|WMZ|WPG|X3F|XBM|XCF|XPM|XPS|XWD|YCbCr|YCbCrA|YUV|)$/";

		if ( preg_match($compatibleImageFormats, $name, $matches) )
		{
			if (!file_exists(DIR_IMAGE . $this->fileName) )
			{
				throw new Exception('Source image not found.');
			}
			return $name;
		}
		else
		{
			throw new Exception('Incompatible image format.');
		}
	}

	private function cacheDir()
	{
		try
		{
			if(!is_dir(DIR_IMAGE . 'cache'))
			{
				mkdir(DIR_IMAGE . 'cache', 0755);
			}
		}
		catch (Exception $e)
		{
			echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}

	public function generateImage()
	{
		$size = array(
			"Thumb"     => "100x100",
			"Small"     => "400X400",
			"Medium"	=> "800X800",
			"Large"     => "1000x1000",
			"Original"  => "100%"
		);

		$gravity = array (
			"CropCenter"    => "Center",
			"CropLeft"      => "West",
			"CropRight"     => "East",
			"CropTop"       => "North",
			"CropBottom"    => "South"
		);

		$this->cacheDir();

		$this->fileName = explode(".", $this->imageName)[0] . '_' . $this->resizeType . '_' . $this->imageSize . '.jpg';

		$command = new Command('/usr/local/bin/magick');

		if ($this->resizeType === "Scale")
		{
			$response = $command
				->convert(DIR_IMAGE . $this->imageName)
				->output(DIR_IMAGE . 'cache/' . $this->fileName)
				->resize( $size[$this->imageSize] )
				->run()
			;
		}
		else
		{
			$response = $command
				->convert(DIR_IMAGE . $this->imageName)
				->output(DIR_IMAGE . 'cache/' . $this->fileName)
				->gravity( $gravity[$this->resizeType] )
				->extent( $size[$this->imageSize] )
				->run()
			;
		}

		if ($response->hasFailed())
		{
			throw new Exception('An error occurred:'.$response->getError());
		}
	}

	public function returnImage()
	{
		if (file_exists(DIR_IMAGE . 'cache/' . $this->fileName) )
		{
			header('Content-type: image/jpg');
			header('Content-Length: ' . filesize(DIR_IMAGE . 'cache/' . $this->fileName));
			header('Content-Disposition: inline; filename="' . $this->fileName . '"');

			readfile(DIR_IMAGE . 'cache/' . $this->fileName);
		}
		else
		{
			header("HTTP/1.0 404 Not Found");
			echo "404 not found.\n";
			die();
		}
	}
}

?>