<?php

$Accepted_Channels = [
	// Your Channel Has Been Auto Add !
	// * String == Load all Channels
	'mobonews',
	'ahooraniazi',
	'itsmohii',
	'shakouri_m',
	'binoshacast',
	'zoomit',
	'digikalamag',
	'digiato',
];

try
{
	$Video_Data_Array = [];
	$SiteMap_Data = null;

		foreach ($Accepted_Channels as $Channel_Item)
		{
			array_push($Video_Data_Array,json_decode(file_get_contents('https://aparat.com/'.'etc/api/videoByUser/username/' . $Channel_Item . '/perpage/2000'),true)['videobyuser']);
		}


	foreach ($Video_Data_Array as $Video_Data)
	{
		foreach ($Video_Data as $Item)
		{
			array_push($Links,'https://sae22.ir/' . 'v/' . $Item['uid']);
		}

		foreach ($Links as $Item_Links)
		{
			$SiteMap_Data .= '<url><loc>' . $Item_Links . '</loc><lastmod>' . date("Y-m-d",time()) . 'T' . date('h:i:s:l') . '</lastmod></url>';
		}

	}

	$My_File = fopen('sitemap.xml','w+') or die("Error");
	fwrite($My_File,'<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . $SiteMap_Data . '</urlset>');
	fclose($My_File);
	echo 'SiteMap Created Success';
}
catch (Exception $Ex)
{
	echo 'SiteMap Create Error';
	var_dump($Ex);
}