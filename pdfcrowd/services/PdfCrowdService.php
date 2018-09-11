<?php 
namespace Craft;

require_once craft()->path->getPluginsPath() . 'pdfcrowd/libraries/pdfcrowd.php';

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

class PdfCrowdService extends BaseApplicationComponent 
{

	// --------------------------------------------------------------------
	// PROPERTIES
	// --------------------------------------------------------------------

	/**
	 * The PDF Crowd API user.
	 *
	 * @var        string
	 * @access     private
	 */
	private $apiUser = '';

	/**
	 * The PDF Crowd API key.
	 *
	 * @var        string
	 * @access     public
	 */
	private $apiKey = '';


	/** 
	 * Constructor.
	 *
	 * @access public
	 * @return void
	 */
	public function __construct() {

		// api auth
		if (isset(craft()->config->get('environmentVariables')['pdfCrowdApiUser'])) {
			$this->apiUser = craft()->config->get('environmentVariables')['pdfCrowdApiUser'];
		}
		if (isset(craft()->config->get('environmentVariables')['pdfCrowdApiKey'])) {
			$this->apiKey = craft()->config->get('environmentVariables')['pdfCrowdApiKey'];
		}
	}

	// --------------------------------------------------------------------
	// TAGS
	// --------------------------------------------------------------------

	/** 
	 * Convert a URL to a PDF
	 *
	 * @access public
	 * @param string $url The url to convert
	 * @param string $filename The name of the file (without the extension)
	 * @return string
	 */
	public function convert($url, $filename) {

		try {   
		    // create an API client instance
		    $client = new \Pdfcrowd\HtmlToPdfClient($this->apiUser, $this->apiKey);
		
			// see: https://pdfcrowd.com/web-html-to-pdf-php/#reference
			
			// HTML options
			// ... nothing to see here
			
			// PDF options
			$client->setPageMargins('0.4in', '0.8in', '0.4in', '0.8in');

		    // convert a web page and store the generated PDF into a $pdf variable
		    $pdf = $client->convertUrl($url);

		    // force download the generated PDF
		   	craft()->request->sendFile($filename.'.pdf', $pdf, array('forceDownload' => true));

		} catch(\Pdfcrowd\Error $why) {

			// log the error
			PdfCrowdPlugin::log(Craft::t('PdfCrowdService::' . __FUNCTION__ . '() error: ' . $why));

			// exit silently
		    return '';
		}
	}

}
