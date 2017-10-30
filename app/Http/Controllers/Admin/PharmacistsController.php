<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PharmacistsController extends Controller
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
                'page' => 'Pharmacists',
                'pharmacists' => $this->getPharmacists($user)
            );

            return view('admin.pharmacists.main',compact('user','data'));
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
            $url .= "pharmacists";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacist)
                {
                    $data = array(
                        'page' => 'Pharmacists',
                        'pharmacist' => $response_json->pharmacist
                    );
                    return view('admin.pharmacists.view',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacists');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacists');
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
            $url .= "pharmacists";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacist)
                {
                    $data = array(
                        'page' => 'Pharmacists',
                        'pharmacist' => $response_json->pharmacist
                    );
                    return view('admin.pharmacists.edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacists');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacists');
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
            $url .= "pharmacists";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'surname' => $request->surname,
                'level' => $request->level,
                'phone' => $request->phone,
                'email' => $request->email
            );

            try{
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacist)
                {
                    return redirect()->back()->with(['message' => 'Pharamacist details are updated.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacists');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacists');
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
            $url .= "pharmacists";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Pharmacist removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacists');
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
            $url .= "pharmacists";
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'surname' => $request->surname,
                'level' => $request->level,
                'phone' => $request->phone,
                'email' => $request->email
            );

            try{
                $response = $client->request('POST', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->pharmacist)
                {
                    return redirect()->back()->with(['message' => 'Pharmacist added.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/pharmacists');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/pharmacists');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/pharmacists');
            }
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