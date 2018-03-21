<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class DispensersController extends Controller
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
                'page' => 'Dispensers'
            );

            return view('admin.dispensers.main',compact('user','data'));
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
            $url .= "dispensers";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->dispenser)
                {
                    $data = array(
                        'page' => 'Dispensers',
                        'dispenser' => $response_json->dispenser
                    );
                    return view('admin.dispensers.view',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/dispensers');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/dispensers');
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
            $url .= "dispensers";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->dispenser)
                {
                    $data = array(
                        'page' => 'Dispensers',
                        'dispenser' => $response_json->dispenser
                    );
                    return view('admin.dispensers.edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/dispensers');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/dispensers');
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
            $url .= "dispensers";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'pin' => $request->pin,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'surname' => $request->surname,
                'registration_date' => $request->registration_date,
                'birth_date' => $request->birth_date,
                'sex' => $request->sex,
                'phone' => $request->phone,
                'email' => $request->email,
                'postal_address' => $request->postal_address,
                'nationality' => $request->nationality,
                'certificate_no' => $request->certificate_no,
                'training_place' => $request->training_place
            );

            try{
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->dispenser)
                {
                    return redirect()->back()->with(['message' => 'Dispenser details are updated.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/dispensers');
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
            $url .= "dispensers";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Dispenser removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/dispensers');
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
            $url .= "dispensers";
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'pin' => $request->pin,
                'firstname' => $request->firstname,
                'middlename' => $request->middlename,
                'surname' => $request->surname,
                'registration_date' => $request->registration_date,
                'birth_date' => $request->birth_date,
                'sex' => $request->sex,
                'phone' => $request->phone,
                'email' => $request->email,
                'postal_address' => $request->postal_address,
                'nationality' => $request->nationality,
                'certificate_no' => $request->certificate_no,
                'training_place' => $request->training_place
            );

            try{
                $response = $client->request('POST', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->dispenser)
                {
                    return redirect()->back()->with(['message' => 'Dispenser added.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/dispensers');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispeners');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/dispensers');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/dispensers');
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
                //fgetcsv($handle, 10000, ":");

                $query_row = 0;
                while(($data = fgetcsv($handle, 10000, ':')) !== FALSE) {
                    // Preparing values
                   $pin = $data[1];
                   $firstname = $data[2];
                   $middlename = $data[3];
                   $surname = $data[4];
                   $registration_date = $data[5];
                   $birth_date = $data[6];
                   $sex = $data[7];
                   $phone = $data[8];
                   $email = $data[9];
                   $postal_address = $data[10];
                   $nationality = $data[11];
                   $certificate_no = $data[12];
                   $training_place = $data[13];

                   $values = array(
                    'pin' => $pin,
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'surname' => $surname,
                    'registration_date' => $registration_date,
                    'birth_date' => $birth_date,
                    'sex' => $sex,
                    'phone' => $phone,
                    'email' => $email,
                    'postal_address' => $postal_address,
                    'nationality' => $nationality,
                    'certificate_no' => $certificate_no,
                    'training_place' => $training_place
                );

                // Add Dispenser.
                $dispenser = $this->addDispenser($user, $values);

                $query_row = $query_row + 1;
                if($query_row >= 30) break; // <-- Submitting only 30 records for now.
                }// <- End of While loop
                fclose($handle);
            }

            return redirect('admin/dispensers')->with(['message' => 'Dispensers imported.','class' => 'success']);
        }
    }

    public function datatable(Request $request){
        $user = session('user');

        $limit = $request->length;
        $start = $request->start;
        $order = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value');

        $values = array(
            'limit' => $limit,
            'start' => $start,
            'order' => $order,
            'dir' => $dir,
            'search' => $search
        );

        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "datatables/getdispensers";
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

    public function getDispensers($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "dispensers";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=5";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->dispensers)
            {
                return $response_json->dispensers;
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

    public function addDispenser($user, $values)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "dispensers";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $promise = $client->requestAsync('POST', $url, ['json' => $values]);
            $response = $promise->wait();
            $response_json = json_decode($response->getBody());
            if($response_json->dispenser)
            {
                return $response_json->dispenser;
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