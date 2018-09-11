<?php
namespace Craft;

class PdfCrowdPlugin extends BasePlugin
{
    function getName()
    {
         return Craft::t('Pdfcrowd');
    }

    function getVersion()
    {
        return '1.0';
    }

    function getDeveloper()
    {
        return 'Mark Croxton';
    }

    function getDeveloperUrl()
    {
        return 'http://hallmark-design.co.uk';
    }
    function hasCpSection()
    {
        return false;
    }
}