<?php

namespace App\Http\Controllers;

use App\Mail\MailReport;
use App\Http\Services\ApiCBI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class BirdController extends Controller
{

  public $data;

  public function __construct(ApiCBI $data)
  {
    $this->data = $data;
  }

  // Info about the report
  public function infoVue()
  {
    // Return data with success
    return response()->json($this->data->TableInfos(), 200);
  }

  // Get data for Vue dashboard user
  public function dataVue()
  {
    //Get api data and store in data array
    $data = [];
    $mainData = $this->data->TypedDataSet();
    $birdData = $this->data->Broedvogels();
    $properties = $this->data->DataProperties();
    $data['properties'] = $properties;

    // Loop through $mainData to set
    foreach ($mainData as $value) {

      // search array for bird object to get bird name
      $broedvogels = $this->data->searchArray($birdData, $value->Broedvogels);
      if ($value->ID > 0) {
        $data['value'][] = [
          'ID' => $value->ID,
          'Trendklasse1990TotHeden_1' => $value->Trendklasse1990TotHeden_1,
          'TrendklasseLaatste12Jaar_2' => $value->TrendklasseLaatste12Jaar_2,
          'Broedvogels' => $broedvogels->Title
        ];
      }
    }
    // Return data with success
    return response()->json($data, 200);
  }

  // Send email report
  public function mailBirdRreport(Request $request)
  {
    // Validation
    $val = Validator::make($request->all(), [
      'email' => 'required|email',
    ]);

    // Return error
    if ($val->fails()) {
      return response()->json([
        'status' => 'error',
        'errors' => $val->errors()
      ], 422);
    }
    // compille data for email
    $mail = $request->email;
    $data = [];
    $vogel = $this->data->singleFilter('/Broedvogels', 'Title', 'eq', $request->item["Broedvogels"]);
    $data['vogel'] = $vogel[0];
    $data['user'] = $request->user;
    $data['item'] = $request->item;

    //Send email
    Mail::to('j-dj@live.nl')->send(new MailReport($data));

    // Return success
    return response()->json(['status' => 'success'], 200);
  }
}
