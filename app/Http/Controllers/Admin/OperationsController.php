<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OperationsController extends Controller
{
    public function addOwner(Request $request)
    {
        $errors = false;
        $success = false;
        $message = "";

        $user = session('user');
        
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "owners";
        $url .= "?api_token=";
        $url .= $user->api_token;

        $values = array(
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email,
            'status' => $request->status
        );

        try{
            $response = $client->request('POST', $url, ['json' => $values]);
            $response_json = json_decode($response->getBody());

            if($response_json->owner)
            {
                //return redirect()->back()->with(['message' => 'Owner added.','class' => 'success']);

                // Getting all owners
                $owners = $this->getOwners($user);
                $success = true;
                $message = '<option value="0">Choose Addo Owner</option>';
                if($owners){
                    foreach($owners as $owner){
                        if($response_json->owner->id == $owner->id) $selected = 'selected="selected"';
                        else $selected = "";
                        $message .= '<option value="'.$owner->id.'" '.$selected.'>'.ucfirst(strtolower($owner->firstname)).' 
                        '.ucfirst(strtolower($owner->middlename)).' '.ucfirst(strtolower($owner->surname)).'</option>';
                    }
                }
            }
            else{
                // No Owner.
                $success = false;
                $message = "Error";
            }
        }
        catch (ClientErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (ServerErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (BadResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ],200);
    }

    public function addPersonnel(Request $request)
    {
        $errors = false;
        $success = false;
        $message = "";

        $user = session('user');
        
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;

        // Finding keycode
        if($request->type == "Pharmacist") $keycode = "01";
        else if($request->type == "Temporary Pharmacist") $keycode = "02";
        else if($request->type == "Intern Pharmacist") $keycode = "03";
        else if($request->type == "Pharmaceutical Technician") $keycode = "04";
        else if($request->type == "Pharmaceutical Assistant") $keycode = "05";
        else if($request->type == "Medical Representative") $keycode = "07";
        else $keycode = "";

        $values = array(
            'type' => $request->type,
            'keycode' => $keycode,
            'firstname' => $request->firstname,
            'middlename' => $request->middlename,
            'surname' => $request->surname,
            'phone' => $request->phone,
            'email' => $request->email
        );

        try{
            $response = $client->request('POST', $url, ['json' => $values]);
            $response_json = json_decode($response->getBody());

            if($response_json->personnel)
            {
                //return redirect()->back()->with(['message' => 'Owner added.','class' => 'success']);

                // Getting all personnel
                $personnels = $this->getPersonnels($user);
                $success = true;
                $message = '<option value="0">Choose Personnel</option>';
                if($personnels){
                    foreach($personnels as $personnel){
                        if($response_json->personnel->id == $personnel->id) $selected = 'selected="selected"';
                        else $selected = "";
                        $message .= '<option value="'.$personnel->id.'" '.$selected.'>'.ucfirst(strtolower($personnel->firstname)).' 
                        '.ucfirst(strtolower($personnel->middlename)).' '.ucfirst(strtolower($personnel->surname)).' ('.$personnel->type.')</option>';
                    }
                }
            }
            else{
                // No Owner.
                $success = false;
                $message = "Error";
            }
        }
        catch (ClientErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (ServerErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (BadResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ],200);
    }

    public function getRegions(Request $request){
        $errors = false;
        $success = false;
        $message = "";

        $user = session('user');
        
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "regions";
        $url .= "?limit=all&order_by=name,asc";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->regions)
            {
                $success = true;
                $message = '';
                if($response_json->regions){
                    foreach($response_json->regions as $region){
                        $message .= '<option value="'.$region->id.'">'.$region->name.'</option>';
                    }
                }
            }
            else{
                // No Region.
                $success = false;
                $message = "Error";
            }
        }
        catch (ClientErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (ServerErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (BadResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ],200);
    }

    public function getDistricts(Request $request){
        $errors = false;
        $success = false;
        $message = "";

        $user = session('user');
        
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "districts";
        $url .= "?region_id=";
        $url .= $request->region_id;
        $url .= "&limit=all&order_by=name,asc";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->districts)
            {
                $success = true;
                $message = '';
                if($response_json->districts){
                    foreach($response_json->districts as $district){
                        $message .= '<option value="'.$district->id.'">'.$district->name.'</option>';
                    }
                }
            }
            else{
                // No District.
                $success = false;
                $message = "Error";
            }
        }
        catch (ClientErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (ServerErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (BadResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ],200);
    }

    public function getWards(Request $request){
        $errors = false;
        $success = false;
        $message = "";

        $user = session('user');
        
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "wards";
        $url .= "?district_id=";
        $url .= $request->district_id;
        $url .= "&limit=all&order_by=name,asc";  

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->wards)
            {
                $success = true;
                $message = '';
                if($response_json->wards){
                    foreach($response_json->wards as $ward){
                        $message .= '<option value="'.$ward->id.'">'.$ward->name.'</option>';
                    }
                }
            }
            else{
                // No Ward.
                $success = false;
                $message = "Error";
            }
        }
        catch (ClientErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (ServerErrorResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (BadResponseException $e) {
            $success = false;
            $message = $e->getResponse()->getBody(true);
        }
        catch (\Exception $e) {
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ],200);
    }

    public function getOwners($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "owners";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->owners)
            {
                return $response_json->owners;
            }
            else{
                // No Dispenser.
                return null;
            }
        }
        catch (ClientErrorResponseException $e) {
            \Log::info("Client error :" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (ServerErrorResponseException $e) {
            \Log::info("Server error" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (BadResponseException $e) {
            \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (\Exception $e) {
            \Log::info("Err" . $e->getMessage());
            return null;
        }
    }

    public function getPersonnels($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->personnels)
            {
                return $response_json->personnels;
            }
            else{
                // No Personnel.
                return null;
            }
        }
        catch (ClientErrorResponseException $e) {
            \Log::info("Client error :" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (ServerErrorResponseException $e) {
            \Log::info("Server error" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (BadResponseException $e) {
            \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
            return null;
        }
        catch (\Exception $e) {
            \Log::info("Err" . $e->getMessage());
            return null;
        }
    }
}