<?php

$q = isset($_GET['q']) ? $_GET['q'] : '';

$api = "https://api-adresse.data.gouv.fr/search/?q=" . $_GET['q'] . "&city=paris&type=street";

@$data = json_decode(file_get_contents($api),true);

$arr = array();

if (isset($data['features']))
{
    foreach ($data['features'] as $key => $value)
    {
        if (isset($value['properties']['context']))
        {
            $arr[] = $value['properties']['context'];
        }
    }

    echo json_encode(array_unique($arr));
}