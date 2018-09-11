# Pdfcrowd for Craft CMS 2.x

* Author: [Mark Croxton](http://hallmark-design.co.uk/)

## Version 1.0.0

This plugin allows you to generate PDFs of your webpages using [Pdfcrowd API v2](https://pdfcrowd.com/doc/api/)

## Requirements

* Craft 2.x
* A Pdfcrowd account

## Installation

1. Copy the `pdfcrowd` folder to `./craft/plugins/`
3. Open your craft/config/general.php file, and add `pdfCrowdApiUser` and `pdfCrowdApiKey` to your `environmentVariables` array:
	```php
	'environmentVariables' => array(
		'pdfCrowdApiUser' => '',
		'pdfCrowdApiKey' => '',
	),
	```


## Usage
	
	{# convert the current url #}
	{{ craft.pdfcrowd.convert }}

	{# hardcode the url #}
	{{ craft.pdfcrowd.convert('https://www.mywebsite.com/my/webpage') }}

	{# specify a filename #}
	{{ craft.pdfcrowd.convert({
		filename : 'my_pdf'
	}) }}

	{# Specify a URL and filename #}
	{{ craft.pdfcrowd.convert({
		url : 'https://www.mywebsite.com/my/webpage',
		filename : 'my_pdf'
	}) }}
