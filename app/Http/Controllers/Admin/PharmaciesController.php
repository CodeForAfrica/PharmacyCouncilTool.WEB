<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PharmaciesController extends Controller
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
                'page' => 'Pharmacies',
                'pharmacies' => $this->getPharmacies($user),
                'owners' => $this->getOwners($user),
                'pharmacists' => $this->getPharmacists($user)
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
                        'pharmacists' => $this->getPharmacists($user)
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

            $values = array(
                'fin' => $request->fin,
                'registration_date' => $request->registration_date,
                'name' => $request->name,
                'category' => $request->category,
                'category_code' => $request->category_code,
                'country' => $request->country,
                'region' => $request->region,
                'region_code' => $request->region_code,
                'district' => $request->district,
                'district_code' => $request->district_code,
                'ward' => $request->ward,
                'ward_code' => $request->ward_code,
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
                return redirect('admin/premises');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/premises');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/premises');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/premises');
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

            $values = array(
                'fin' => $request->fin,
                'registration_date' => $request->registration_date,
                'name' => $request->name,
                'category' => $request->category,
                'category_code' => $request->category_code,
                'country' => $request->country,
                'region' => $request->region,
                'region_code' => $request->region_code,
                'district' => $request->district,
                'district_code' => $request->district_code,
                'ward' => $request->ward,
                'ward_code' => $request->ward_code,
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
                    return redirect('admin/premises');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/premises');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/premises');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/premises');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/premises');
            }
        }
    }

    public function getPharmacies($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "premises";
        $url .= "?api_token=";
        $url .= $user->api_token;

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

    public function getPharmacists($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "pharmacists";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->pharmacists)
            {
                return $response_json->pharmacists;
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
}