<?php

namespace App\Http\Services;

use GuzzleHttp\Client;

/*
Documentation for API can be found here:
https://www.cbs.nl/-/media/_pdf/2017/13/handleiding-cbs-open-data-services.pdfeVkRWHav56
*/


class ApiCBI
{
  public $apiBase;
  public $client;

  public function __construct(Client $client)
  {
    $this->apiBase = 'https://opendata.cbs.nl/ODataApi/odata/84563NED';
    $this->client = $client;
  }

  // Get data value from https://opendata.cbs.nl/ODataApi/odata/84563NED/Broedvogels
  public function Broedvogels()
  {
    $req = $this->client->request('GET', $this->apiBase . '/Broedvogels');
    $res = json_decode($req->getBody());
    return $res->value;
  }

  // Get data value from https://opendata.cbs.nl/ODataApi/odata/84563NED/CategoryGroups
  public function CategoryGroups()
  {
    $req = $this->client->request('GET', $this->apiBase . '/CategoryGroups');
    $res = json_decode($req->getBody());
    return $res->value;
  }

  // Get data value from https://opendata.cbs.nl/ODataApi/odata/84563NED/CategoryGroups
  public function DataProperties()
  {
    $req = $this->client->request('GET', $this->apiBase . '/DataProperties');
    $res = json_decode($req->getBody());
    return $res->value;
  }

  // Get data value from https://opendata.cbs.nl/ODataApi/odata/84563NED/CategoryGroups
  public function TableInfos()
  {
    $req = $this->client->request('GET', $this->apiBase . '/TableInfos');
    $res = json_decode($req->getBody());
    return $res->value[0];
  }

  // Get data value from https://opendata.cbs.nl/ODataApi/odata/84563NED/CategoryGroups
  public function TypedDataSet()
  {
    $req = $this->client->request('GET', $this->apiBase . '/TypedDataSet');
    $res = json_decode($req->getBody());
    return $res->value;
  }

  /*
    Get a filtered result by key value pair

    $data values:
    null
    /TableInfos
    /UntypedDataSet
    /TypedDataSet
    /DataProperties
    /CategoryGroups
    /Broedvogels

    $operator values:
    eq Equal
    ne Not equal
    gt Greater than
    ge Greater than or equal
    lt Less than
    le Less than or equal
    and Logical and
    or Logical or
    not Logical negation
  */
  public function singleFilter($data = null, $key, $operator, $value)
  {
    $req = $this->client->request('GET', $this->apiBase . $data . '?$filter=' . $key . ' ' . $operator . " '" . $value . "'");
    $res = json_decode($req->getBody());
    return $res->value;
  }

  /*
  Function for searching an array for an object
  */
  public function searchArray($arr, $value)
  {
    $getObject = array_filter(
      $arr,
      function ($e) use ($value) {
        return $e->Key == $value;
      }
    );
    return reset($getObject);
  }
}
