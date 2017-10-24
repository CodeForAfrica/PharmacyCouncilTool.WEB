<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
                'owners' => $this->getOwners($user)
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
            $url .= "pharmacies";
            $url .= "/";
            $url .= $id;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacy)
                {
                    $data = array(
                        'page' => 'Pharmacies',
                        'pharmacy' => $response_json->pharmacy
                    );
                    return view('admin.pharmacy_view',compact('user','data'));
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
            $url .= "pharmacies";
            $url .= "/";
            $url .= $id;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacy)
                {
                    $data = array(
                        'page' => 'Pharmacies',
                        'pharmacy' => $response_json->pharmacy
                    );
                    return view('admin.pharmacy_edit',compact('user','data'));
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
            $url .= "pharmacies";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'registration_number' => $request->registration_number,
                'name' => $request->name,
                'pharmacist' => $request->pharmacist,
                'address' => $request->address,
                'location' => $request->location,
                'ward' => $request->ward,
                'district' => $request->district,
                'region' => $request->region,
                'date_registered' => $request->date_registered
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

            $values = array(
                'name' => $request->name,
                'accreditation_no' => $request->accreditation_no,
                'region' => $request->region,
                'district' => $request->district,
                'ward' => $request->ward,
                'street' => $request->street,
                'owner_id' => $request->owner_id
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

    public function getAddos($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "addos";
        $url .= "?api_token=";
        $url .= $user->api_token;

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
}