<?php namespace Craft;

/**
 * Pdfcrowd by Mark Croxton
 *
 * @author     	Mark Croxton <http://hallmark-design.co.uk>
 * @package    	Pdfcrowd
 * @since		Craft 2.6
 * @copyright 	Copyright (c) 2017, Mark Croxton
 * @license 	http://opensource.org/licenses/mit-license.php MIT License
 * @link       	http://github.com/croxton/Pdfcrowd-Craft
 */

class PdfCrowdVariable
{
	/**
	 * {{ craft.pdfcrowd.convert() }} variable tag
	 * Convert a URL to a PDF
	 *
	 * @param string $url The url to convert
	 * @param string $fielname The name of the file
	 * @return string
	 */
	public function convert($url = '', $filename='download') {
		
		/* Example usage:
		{{ craft.pdfcrowd.convert("https://www.mywebsite.com/my/webpage") }}
		or 
		{{ craft.pdfcrowd.convert() }}
		or
		{{ craft.pdfcrowd.convert({
			filename : 'my_pdf'
		}) }}
		*/
	
		// support arguments passed as an array
		if (is_array($url))
		{
			if (isset($url['filename']))
			{
				$filename = $url['filename'];
			}
			if (isset($url['url']))
			{
				$url = $url['url'];
			}
			else
			{
				$url = '';
			}
		}
		
		// prevent recursion
		if ( '1' === craft()->request->getParam('pdfcrowd') ) {
			return;
		}
		
		// use the current url by default
		if ( empty($url) ) {
			$url = craft()->request->getHostInfo() . craft()->request->getUrl();
		}

		// add ?pdfcrowd=1 to the url passed to the API
		$query = parse_url($url, PHP_URL_QUERY);

		if ( $query ) {
		    $url .= '&pdfcrowd=1';
		} else {
		    $url .= '?pdfcrowd=1';
		}

		return craft()->pdfCrowd->convert($url, $filename);
	}
}