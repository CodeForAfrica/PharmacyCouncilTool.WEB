<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class PharmaciesController extends Controller
{
    public function index(Request $request)
    {
        // Checking for session.
        if(!session()->has('user'))
        {
            return redirect('admin/login');
        }
        else{
            $user = session('user');
            $pharmacies = null;
            
            if($request->status){
                $pharmacies = $this->getPharmacies($user, $request->status);
            }
            else{
                $pharmacies = $this->getPharmacies($user);
            }

            $data = array(
                'page' => 'Pharmacies',
                'pharmacies' => $pharmacies,
                'owners' => $this->getOwners($user),
                'personnels' => $this->getPersonnels($user),
                'regions' => $this->getRegions($user)
            );

            return view('admin.pharmacies.main',compact('user','data'));
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
            $url .= "premises";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->premise)
                {
                    $data = array(
                        'page' => 'Pharmacies',
                        'pharmacy' => $response_json->premise
                    );

                    return view('admin.pharmacies.view',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacies');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacies');
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
            $url .= "premises";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->premise)
                {
                    $data = array(
                        'page' => 'Pharmacies',
                        'pharmacy' => $response_json->premise,
                        'owners' => $this->getOwners($user),
                        'personnels' => $this->getPersonnels($user),
                        'regions' => $this->getRegions($user),
                        'districts' => $this->getDistricts($user),
                        'wards' => $this->getWards($user)
                    );
                    return view('admin.pharmacies.edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacies');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                dd($e->getMessage());
                return redirect('admin/pharmacies');
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
            $url .= "premises";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            // Finding category code
            if($request->category == "Retail") $category_code = "01";
            else if($request->category == "Wholesale") $category_code = "02";
            else if($request->category == "Medical Device") $category_code = "03";
            else if($request->category == "ADDO") $category_code = "04";
            else if($request->category == "ARW") $category_code = "05";
            else if($request->category == "Warehouse") $category_code = "06";
            else $category_code = "";

            $values = array(
                'fin' => $request->fin,
                'registration_date' => $request->registration_date,
                'name' => $request->name,
                'category' => $request->category,
                'category_code' => $category_code,
                'country' => $request->country,
                'region_id' => $request->region_id,
                'district_id' => $request->district_id,
                'ward_id' => $request->ward_id,
                'village' => $request->village,
                'village_code' => $request->village_code,
                'physical' => $request->physical,
                'owner_id' => $request->owner_id,
                'postal_address' => $request->postal_address,
                'fax' => $request->fax,
                'pharmacist_id' => $request->pharmacist_id,
                'pharmaceutical_personnel_id' => $request->pharmaceutical_personnel_id,
                'submitted_dispenser_contract' => $request->submitted_dispenser_contract,
                'permit_profit_amount' => $request->permit_profit_amount,
                'receipt_no' => $request->receipt_no,
                'payment_date' => $request->payment_date,
                'remarks' => $request->remarks,
                'data_entry_date' => $request->data_entry_date,
                'premise_fees_due' => $request->premise_fees_due,
                'retention_due' => $request->retention_due,
                'renewal_status' => $request->renewal_status,
                'black_book_list' => $request->black_book_list,
                'extra_payment' => $request->extra_payment
            );

            try{
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacy)
                {
                    return redirect()->back()->with(['message' => 'Pharamacy details are updated.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacies');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacies');
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
            $url .= "premises";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Premise removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacies');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacies');
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
            $url .= "premises";
            $url .= "?api_token=";
            $url .= $user->api_token;

            // Check if required fields are filled
            if($request->region_id == 0 || $request->district_id == 0 || $request->ward_id == 0 || $request->owner_id == 0 || 
                $request->pharmacist_id == 0 || $request->pharmaceutical_personnel_id == 0){
                return redirect()->back()->with(['message' => 'Fill required fields.','class' => 'warning']);
            }
            else{
                // Finding category code
                if($request->category == "Retail") $category_code = "01";
                else if($request->category == "Wholesale") $category_code = "02";
                else if($request->category == "Medical Device") $category_code = "03";
                else if($request->category == "ADDO") $category_code = "04";
                else if($request->category == "ARW") $category_code = "05";
                else if($request->category == "Warehouse") $category_code = "06";
                else $category_code = "";

                $values = array(
                    'fin' => $request->fin,
                    'registration_date' => $request->registration_date,
                    'name' => $request->name,
                    'category' => $request->category,
                    'category_code' => $category_code,
                    'country' => $request->country,
                    'region_id' => $request->region_id,
                    'district_id' => $request->district_id,
                    'ward_id' => $request->ward_id,
                    'village' => $request->village,
                    'village_code' => $request->village_code,
                    'physical' => $request->physical,
                    'owner_id' => $request->owner_id,
                    'postal_address' => $request->postal_address,
                    'fax' => $request->fax,
                    'pharmacist_id' => $request->pharmacist_id,
                    'pharmaceutical_personnel_id' => $request->pharmaceutical_personnel_id,
                    'submitted_dispenser_contract' => $request->submitted_dispenser_contract,
                    'permit_profit_amount' => $request->permit_profit_amount,
                    'receipt_no' => $request->receipt_no,
                    'payment_date' => $request->payment_date,
                    'remarks' => $request->remarks,
                    'data_entry_date' => $request->data_entry_date,
                    'premise_fees_due' => $request->premise_fees_due,
                    'retention_due' => $request->retention_due,
                    'renewal_status' => $request->renewal_status,
                    'black_book_list' => $request->black_book_list,
                    'extra_payment' => $request->extra_payment
                );

                try{
                    $response = $client->request('POST', $url, ['json' => $values]);
                    $response_json = json_decode($response->getBody());

                    if($response_json->premise)
                    {
                        return redirect()->back()->with(['message' => 'Premises added.','class' => 'success']);
                    }
                    else{
                        // No Pharmacy.
                        return redirect('admin/pharmacies');
                    }
                }
                catch (ClientErrorResponseException $e) {
                    \Log::info("Client error :" . $e->getResponse()->getBody(true));
                    return redirect('admin/pharmacies');
                }
                catch (ServerErrorResponseException $e) {
                    \Log::info("Server error" . $e->getResponse()->getBody(true));
                    return redirect('admin/pharmacies');
                }
                catch (BadResponseException $e) {
                    \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                    return redirect('admin/pharmacies');
                }
                catch (\Exception $e) {
                    \Log::info("Err" . $e->getMessage());
                    return redirect('admin/pharmacies');
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
                fgetcsv($handle, 10000, ":");
                $n = 1;
                while(($data = fgetcsv($handle, 10000, ':')) !== FALSE) {
                   // Preparing values
                   $fin = $data[1];
                   $registration_date = $data[2];
                   $name = $data[3];
                   $category = $data[4];

                   // Finding category name and code
                   if($category == "R"){
                       $category_name = "Retail";
                       $category_code = "01";
                   }
                   else if($category == "W"){
                       $category_name = "Wholesale";
                       $category_code = "02";
                   }
                   else if($category == "M"){
                       $category_name = "Medical Device";
                       $category_code = "03";
                   }
                   else if($category == "ADDO"){
                       $category_name = "ADDO";
                       $category_code = "04";
                   }
                   else if($category == "ARW"){
                       $category_name = "ARW";
                       $category_code = "05";
                   }
                   else if($category == "WH"){
                       $category_name = "Warehouse";
                       $category_code = "06";
                   }
                   else if($category == "R+W"){
                       $category_name = "Retail and Wholesale";
                       $category_code = "00";
                   }
                   else{
                       $category_name = "UNKNOWN";
                       $category_code = "00";
                   }

                   $country = $data[6];

                   // Finding Region ID
                   $region = $this->getRegion($user, $data[7]);
                   if(!empty($region) && isset($region->id)) $region_id = $region->id;
                   else $region_id = 9999;

                   // Finding District ID
                   $district = $this->getDistrict($user, $data[9]);
                   if(!empty($district) && isset($district->id)) $district_id = $district->id;
                   else $district_id = 9999;
                   
                   // Finding Ward ID
                   $ward = $this->getWard($user, $data[11]);
                   if(!empty($ward) && isset($ward->id)) $ward_id = $ward->id;
                   else $ward_id = 9999;

                   $village = $data[13];
                   $village_code = $data[14];
                   $physical = $data[15];

                   // Finding Owners IDs
                   $owners_str = $data[16];
                   $owners_arr = preg_split("/[,&]+/", $owners_str);
                   $owners_ids_list = array();
                   
                   for($x = 0; $x < count($owners_arr); $x++){
                       $temp = explode(" ", $owners_arr[$x]);
                       if(isset($temp[0])) $owner_firstname = $temp[0]; else $owner_firstname = "";
                       if(isset($temp[1])) $owner_middlename = $temp[1]; else $owner_middlename = "";
                       if(isset($temp[2])) $owner_surname = $temp[2]; else $owner_surname = "";

                       // Check if owner already present.
                       $owner = $this->getOwner($user, $owner_firstname, $owner_middlename, $owner_surname);
                       if(!empty($owner) && isset($owner->id)) $owners_ids_list[] = $owner->id;
                       else{
                           // Add Owner
                           $values = array(
                               'firstname' => $owner_firstname,
                               'middlename' => $owner_middlename,
                               'surname' => $owner_surname,
                               'phone' => $data[17],
                               'email' => $data[18],
                               'status' => $data[33]
                            );

                            $owner = $this->addOwner($user, $values);
                            if(!empty($owner) && isset($owner->id)) $owners_ids_list[] = $owner->id;
                       }
                   }

                   $owners_ids = implode(":",$owners_ids_list);

                   $postal_address = $data[19];
                   $fax = $data[20];

                   // Finding Pharmacist ID
                   $pharmacist_str = $data[21];
                   $temp = explode(" ", $pharmacist_str);
                   if(isset($temp[0])) $pharmacist_firstname = $temp[0]; else $pharmacist_firstname = "";
                   if(isset($temp[1])) $pharmacist_middlename = $temp[1]; else $pharmacist_middlename = "";
                   if(isset($temp[2])) $pharmacist_surname = $temp[2]; else $pharmacist_surname = "";

                   $pharmacist_id = 9999;

                   // Check if pharmacist already present.
                   $type = "Pharmacist";
                   $pharmacist = $this->getPersonnel($user, $type, $pharmacist_firstname, $pharmacist_middlename, $pharmacist_surname);
                   if(!empty($pharmacist) && isset($pharmacist->id)) $pharmacist_id = $pharmacist->id;
                   else{
                        // Add Pharmacist
                        $values = array(
                            'type' => $type,
                            'keycode' => "01",
                            'firstname' => $pharmacist_firstname,
                            'middlename' => $pharmacist_middlename,
                            'surname' => $pharmacist_surname,
                            'phone' => $data[22]
                        );

                        $pharmacist = $this->addPersonnel($user, $values);
                        if(!empty($pharmacist) && isset($pharmacist->id)) $pharmacist_id = $pharmacist->id;
                    }

                   // Finding Pharmaceutical Personnel ID
                   $pharmaceutical_personnel_str = $data[23];
                   $temp = explode(" ", $pharmaceutical_personnel_str);
                   if(isset($temp[0])) $pp_firstname = $temp[0]; else $pp_firstname = "";
                   if(isset($temp[1])) $pp_middlename = $temp[1]; else $pp_middlename = "";
                   if(isset($temp[2])) $pp_surname = $temp[2]; else $pp_surname = "";

                   $pharmaceutical_personnel_id = 9999;

                   // Check if pharmaceutical personnel already present.
                   $type = "";
                   $pp = $this->getPersonnel($user, $type, $pp_firstname, $pp_middlename, $pp_surname);
                   if(!empty($pp) && isset($pp->id)) $pharmaceutical_personnel_id = $pp->id;
                   else{
                        // Finding Type
                        if(strpos($pharmaceutical_personnel_str, "PT")) {$type = "Pharmaceutical Technician"; $keycode = "04";}
                        else if(strpos($pharmaceutical_personnel_str, "PT")) {$type = "Pharmaceutical Assistant"; $keycode = "05";}
                        else {$type = "UNKNOWN"; $keycode = "00";}

                        // Add Pharmacist
                        $values = array(
                            'type' => $type,
                            'keycode' => $keycode,
                            'firstname' => $pp_firstname,
                            'middlename' => $pp_middlename,
                            'surname' => $pp_surname
                        );

                        $pp = $this->addPersonnel($user, $values);
                        if(!empty($pp) && isset($pp->id)) $pharmaceutical_personnel_id = $pp->id;
                    }

                    $submitted_dispenser_contract = $data[24];
                    $permit_profit_amount = $data[25];
                    $receipt_no = $data[26];
                    $payment_date = $data[27];
                    $remarks = $data[28];
                    $data_entry_date = $data[29];
                    $premise_fees_due = $data[30];
                    $retention_due = $data[31];
                    $renewal_status = $data[32];
                    $black_book_list = $data[34];
                    $extra_payment = $data[35];

                    $values = array(
                       'fin' => $data[1],
                       'registration_date' => $registration_date,
                       'name' => $name,
                       'category' => $category_name,
                       'category_code' => $category_code,
                       'country' => $country,
                       'region_id' => $region_id,
                       'district_id' => $district_id,
                       'ward_id' => $ward_id,
                       'village' => $village,
                       'village_code' => $village_code,
                       'physical' => $physical,
                       'owners_ids' => $owners_ids,
                       'postal_address' => $postal_address,
                       'fax' => $fax,
                       'pharmacist_id' => $pharmacist_id,
                       'pharmaceutical_personnel_id' => $pharmaceutical_personnel_id,
                       'submitted_dispenser_contract' => $submitted_dispenser_contract,
                       'permit_profit_amount' => $permit_profit_amount,
                       'receipt_no' => $receipt_no,
                       'payment_date' => $payment_date,
                       'remarks' => $request->remarks,
                       'data_entry_date' => $data_entry_date,
                       'premise_fees_due' => $premise_fees_due,
                       'retention_due' => $retention_due,
                       'renewal_status' => $renewal_status,
                       'black_book_list' => $black_book_list,
                       'extra_payment' => $extra_payment
                    );

                    // Add Pharmacy.
                    $pharmacy = $this->addPharmacy($user, $values);

                    $n++;
                    if($n >= 30); break;

                } // <- End of While loop
                fclose($handle);
            }

            return redirect('admin/pharmacies')->with(['message' => 'Pharmacies imported.','class' => 'success']);
        }
    }

    public function getPharmacies($user, $status = "")
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "premises";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        if($status != ""){
            $url .= "&renewal_status=";
            $url .= $status;
        }

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->premises)
            {
                return $response_json->premises;
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

    public function getOwner($user, $firstname = "", $middlename = "", $surname = "")
    {
        // Checking variables
        if($firstname == "") $firstname = "[null]";
        if($middlename == "") $middlename = "[null]";
        if($surname == "") $surname = "[null]";

        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "owners";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=1";
        $url .= "&firstname=";
        $url .= $firstname;
        $url .= "&middlename=";
        $url .= $middlename;
        $url .= "&surname=";
        $url .= $surname;

        try{
            $response = $client->request('GET', $url);
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

    public function getPersonnels($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->personnels)
            {
                return $response_json->personnels;
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

    public function getPersonnel($user,  $type = "", $firstname = "", $middlename = "", $surname = "")
    {
        // Checking variables
        if($firstname == "") $firstname = "[null]";
        if($middlename == "") $middlename = "[null]";
        if($surname == "") $surname = "[null]";

        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=1";
        $url .= "&firstname=";
        $url .= $firstname;
        $url .= "&middlename=";
        $url .= $middlename;
        $url .= "&surname=";
        $url .= $surname;

        if($type != "")
        {
            $url .= "&type=";
            $url .= $type;
        }

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->personnel)
            {
                return $response_json->personnel;
            }
            else{
                // No Personel.
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

    public function getRegion($user,$name)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "regions";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=1";
        $url .= "&name=".$name."";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->region)
            {
                return $response_json->region;
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

    public function getDistrict($user, $name)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "districts";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=1";
        $url .= "&name=".$name."";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->district)
            {
                return $response_json->district;
            }
            else{
                // No Distirct.
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

    public function getWard($user, $name)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "wards";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=1";
        $url .= "&name=".$name."";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->ward)
            {
                return $response_json->ward;
            }
            else{
                // No Ward.
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
            $response = $client->request('POST', $url, ['json' => $values]);

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

    public function addPersonnel($user, $values)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('POST', $url, ['json' => $values]);
            $response_json = json_decode($response->getBody());

            if($response_json->personnel)
            {
                return $response_json->personnel;
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

    public function addPharmacy($user, $values)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "premises";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('POST', $url, ['json' => $values]);
            $response_json = json_decode($response->getBody());

            if($response_json->premise)
            {
                return $response_json->premise;
            }
            else{
                // No Pharmacy.
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