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
                    'accreditation_no' => $request->accreditation_no,
                    'region_id' => $request->region_id,
                    'district_id' => $request->district_id,
                    'ward_id' => $request->ward_id,
                    'street' => $request->street,
                    'owner_id' => $request->owner_id
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
            if($request->region_id == 0 || $request->district_id == 0 || $request->ward_id == 0 || $request->owner_id == 0){
                return redirect()->back()->with(['message' => 'Fill required fields.','class' => 'warning']);
            }
            else{
                $values = array(
                    'name' => $request->name,
                    'accreditation_no' => $request->accreditation_no,
                    'region_id' => $request->region_id,
                    'district_id' => $request->district_id,
                    'ward_id' => $request->ward_id,
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
    }

    public function getAddos($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "addos";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=5";

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
        $url .= "&limit=5";

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
        $url .= "&limit=5";

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
        $url .= "&limit=5";

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
        $url .= "&limit=5";

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
}