<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AddosController extends Controller
{
    public function index()
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');
            $data = array(
                'page' => 'Addos',
                'addos' => $this->getAddos($user),
                'owners' => $this->getOwners($user),
                'regions' => $this->getRegions($user)
            );

            return view('admin.addos.main',compact('user','data'));
        }
    }

    public function view($id)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "addos"; 
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->addo)
                {
                    $data = array(
                        'page' => 'Addos',
                        'addo' => $response_json->addo
                    );
                    return view('admin.addos.view',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/addos');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/addos');
            }
        }
    }

    public function edit($id)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "addos";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->addo)
                {
                    $data = array(
                        'page' => 'Addos',
                        'addo' => $response_json->addo,
                        'owners' => $this->getOwners($user),
                        'regions' => $this->getRegions($user),
                        'districts' => $this->getDistricts($user),
                        'wards' => $this->getWards($user)
                    );
                    return view('admin.addos.edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/addos');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/addos');
            }
        }
    }

    public function update(Request $request)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "addos";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            // Check if required fields are filled
            if($request->region_id == 0 || $request->district_id == 0 || $request->ward_id == 0 || $request->owner_id == 0){
                return redirect()->back()->with(['message' => 'Fill required fields.','class' => 'warning']);
            }
            else{
                $values = array(
                    'name' => $request->name,
                    'fin' => $request->fin,
                    'region_id' => $request->region_id,
                    'district_id' => $request->district_id,
                    'ward_id' => $request->ward_id,
                    'street' => $request->street,
                    'owners_ids' => $request->owners_ids
                );
    
                try{
                    $response = $client->request('PUT', $url, ['json' => $values]);
                    $response_json = json_decode($response->getBody());
    
                    if($response_json->addo)
                    {
                        return redirect()->back()->with(['message' => 'Addo details are updated.','class' => 'success']);
                    }
                    else{
                        // No Pharmacy.
                        return redirect('admin/addos');
                    }
                }
                catch (ClientErrorResponseException $e) {
                    \Log::info("Client error :" . $e->getResponse()->getBody(true));
                    return redirect('admin/addos');
                }
                catch (ServerErrorResponseException $e) {
                    \Log::info("Server error" . $e->getResponse()->getBody(true));
                    return redirect('admin/addos');
                }
                catch (BadResponseException $e) {
                    \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                    return redirect('admin/addos');
                }
                catch (\Exception $e) {
                    \Log::info("Err" . $e->getMessage());
                    return redirect('admin/addos');
                }
            }
        }
    }

    public function delete($id)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "addos";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Addo removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/addos');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/addos');
            }
        }
    }

    public function create(Request $request)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');

            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "addos";
            $url .= "?api_token=";
            $url .= $user->api_token;

            // Check if required fields are filled
            if($request->region_id == 0 || $request->district_id == 0 || $request->ward_id == 0 || $request->owners_ids == 0){
                return redirect()->back()->with(['message' => 'Fill required fields.','class' => 'warning']);
            }
            else{
                $values = array(
                    'name' => $request->name,
                    'fin' => $request->fin,
                    'region_id' => $request->region_id,
                    'district_id' => $request->district_id,
                    'ward_id' => $request->ward_id,
                    'street' => $request->street,
                    'owners_ids' => $request->owners_ids
                );
    
                try{
                    $response = $client->request('POST', $url, ['json' => $values]);
                    $response_json = json_decode($response->getBody());
    
                    if($response_json->addo)
                    {
                        return redirect()->back()->with(['message' => 'Addo added.','class' => 'success']);
                    }
                    else{
                        // No Pharmacy.
                        return redirect('admin/addos');
                    }
                }
                catch (ClientErrorResponseException $e) {
                    \Log::info("Client error :" . $e->getResponse()->getBody(true));
                    return redirect('admin/addos');
                }
                catch (ServerErrorResponseException $e) {
                    \Log::info("Server error" . $e->getResponse()->getBody(true));
                    return redirect('admin/addos');
                }
                catch (BadResponseException $e) {
                    \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                    return redirect('admin/addos');
                }
                catch (\Exception $e) {
                    \Log::info("Err" . $e->getMessage());
                    return redirect('admin/addos');
                }
            }
        }
    }

    public function import(Request $request){
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');

            // Reserve values in arrays.
            $ARR_Regions = $this->getRegions($user);
            $ARR_Districts = $this->getDistricts($user);
            $ARR_Wards = $this->getWards($user);
            $ARR_Owners = $this->getOwners($user);

            $file = $request->file('file');
            $timestamp = Carbon::now()->timestamp;

            // Uploading a file
            // Renaming
            $temp = explode(".", $file->getClientOriginalName());
            $filename = $temp[0];
            $new_filename = $filename."_".$timestamp.".".$file->getClientOriginalExtension();

            //Move Uploaded File
            $destinationPath = 'uploads/';
            $file->move($destinationPath,$new_filename);

             // Reading File
             if(($handle = fopen(public_path().'/uploads/'.$new_filename, 'r' )) !== FALSE){
                //fgetcsv($handle, 10000, ":");

                $query_row = 0;
                while(($data = fgetcsv($handle, 10000, ':')) !== FALSE) {
                   // Preparing values
                   $name = $data[1];
                   $fin = $data[2];

                   // Finding Region ID
                   $region_key = false;
                   $search = ['name' => strtolower($data[3])];
                   foreach($ARR_Regions as $k => $v){
                       if(strtolower($v->name) == $search['name']){
                           $region_key = $k;
                           break;
                        }
                    }

                    if($region_key){
                        $region_id = $ARR_Regions[$region_key]->id;
                    }
                    else $region_id = 9999;

                    // Finding District ID based on Region ID
                    $district_key = false;
                    if($region_key){
                        $search = ['region_id' => $region_id, 'name' => strtolower($data[4])];
                        foreach($ARR_Districts as $k => $v){
                            if($v->region_id == $search['region_id'] && strtolower($v->name) == $search['name']){
                                $district_key = $k;
                                break;
                            }
                        }
                    }

                    if($district_key){
                        $district_id = $ARR_Districts[$district_key]->id;
                    }
                    else $district_id = 9999;

                    // Finding Ward ID based on district ID
                    $ward_key = false;
                    if($district_key){
                        $search = ['district_id' => $district_id, 'name' => strtolower($data[5])];
                        foreach($ARR_Wards as $k => $v){
                            if($v->district_id == $search['district_id'] && strtolower($v->name) == $search['name']){
                                $ward_key = $k;
                                break;
                            }
                        }
                    }

                    if($ward_key){
                        $ward_id = $ARR_Wards[$ward_key]->id;
                    }
                    else $ward_id = 9999;

                    $street = $data[6];

                    // Finding Owner ID
                    $owner_firstname = $data[7];
                    $owner_middlename = $data[8];
                    $owner_surname = $data[9];
                    $owner_phone = $data[10];
                    $owners_ids_list = array();

                        // Check if owner already present.
                        $owner_key = false;
                        $search = ['firstname' => strtolower($owner_firstname), 'middlename' => strtolower($owner_middlename), 'surname' => strtolower($owner_surname)];
                        if($ARR_Owners){
                            foreach($ARR_Owners as $k => $v){
                                if(strtolower($v->firstname) == $search['firstname'] && strtolower($v->middlename) == $search['middlename'] && strtolower($v->surname) == $search['surname']){
                                    $owner_key = $k;
                                    break;
                                }
                            }
                        }

                        if($owner_key){
                            $owner_id = $ARR_Owners[$owner_key]->id;
                            $owners_ids_list[] = $owner_id;
                        }
                        else{
                            // Add Owner
                            $values = array(
                                'firstname' => $owner_firstname,
                                'middlename' => $owner_middlename,
                                'surname' => $owner_surname,
                                'phone' => $owner_phone,
                                'email' => "",
                                'occupation' => "",
                                'status' => ""
                             );
 
                            $owner = $this->addOwner($user, $values);

                            if(!empty($owner) && isset($owner->id)) $owners_ids_list[] = $owner->id;
                        }

                        $owners_ids = implode(":",$owners_ids_list);

                        $values = array(
                            'name' => $name,
                            'fin' => $fin,
                            'region_id' => $region_id,
                            'district_id' => $district_id,
                            'ward_id' => $ward_id,
                            'street' => $street,
                            'owners_ids' => $owners_ids
                         );

                         // Add Addo.
                        $addo = $this->addAddo($user, $values);

                    $query_row = $query_row + 1;
                    if($query_row >= 30) break; // <-- Submitting only 30 records for now.
                }// <- End of While loop
                fclose($handle);
            }

            return redirect('admin/addos')->with(['message' => 'Addos imported.','class' => 'success']);
        }
    }

    public function datatable(Request $request){
        $user = session('user');

        $limit = $request->length;
        $start = $request->start;
        $order = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');
        $status = $request->status;

        $values = array(
            'limit' => $limit,
            'start' => $start,
            'order' => $order,
            'dir' => $dir,
            'search' => $search,
            'status' => $status
        );

        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "datatables/getaddos";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('POST', $url, ['json' => $values]);
            $response_json = json_decode($response->getBody());
            
            echo $response->getBody();
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

    public function getAddos($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "addos";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->addos)
            {
                return $response_json->addos;
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

    public function getRegions($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "regions";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->regions)
            {
                return $response_json->regions;
            }
            else{
                // No Region.
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

    public function getDistricts($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "districts";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->districts)
            {
                return $response_json->districts;
            }
            else{
                // No Region.
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

    public function getWards($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "wards";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->wards)
            {
                return $response_json->wards;
            }
            else{
                // No Region.
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

    public function addOwner($user, $values)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "owners";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $promise = $client->requestAsync('POST', $url, ['json' => $values]);
            $response = $promise->wait();
            $response_json = json_decode($response->getBody());

            if($response_json->owner)
            {
                return $response_json->owner;
            }
            else{
                // No Owner.
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

    public function addAddo($user, $values)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "addos";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $promise = $client->requestAsync('POST', $url, ['json' => $values]);
            $response = $promise->wait();
            $response_json = json_decode($response->getBody());
            if($response_json->addo)
            {
                return $response_json->addo;
            }
            else{
                // No Addo.
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