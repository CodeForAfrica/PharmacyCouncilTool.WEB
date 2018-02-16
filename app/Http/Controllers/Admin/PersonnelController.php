<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonnelController extends Controller
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
            $personnels = null;

            if($request->type){
                $personnels = $this->getPersonnels($user, $request->type);
            }
            else{
                $personnels = $this->getPersonnels($user);
            }
            $data = array(
                'page' => 'Personnel',
                'personnels' => $personnels
            );

            return view('admin.personnels.main',compact('user','data'));
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
            $url .= "personnels";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->personnel)
                {
                    $data = array(
                        'page' => 'Personnel',
                        'personnel' => $response_json->personnel
                    );
                    return view('admin.personnels.view',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/personnel');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/personnel');
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
            $url .= "personnels";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->personnel)
                {
                    $data = array(
                        'page' => 'Personnel',
                        'personnel' => $response_json->personnel
                    );
                    return view('admin.personnels.edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/personnel');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/personnel');
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
            $url .= "personnels";
            $url .= "/";
            $url .= $request->id;
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
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->personnel)
                {
                    return redirect()->back()->with(['message' => 'Personnel details are updated.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/personnel');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/personnel');
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
            $url .= "personnels";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Personnel removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/personnel');
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
                    return redirect()->back()->with(['message' => 'Personnel added.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/personnel');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/personnel');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/personnel');
            }
        }
    }

    public function getPersonnels($user, $type = "")
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=5";

        if($type != ""){
            $url .= "&type=";
            $url .= $type;
        }

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