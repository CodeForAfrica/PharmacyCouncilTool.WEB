<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendancesController extends Controller
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
                'page' => 'More'
            );
            return view('admin.attendances.main',compact('user','data'));
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
            $url .= "reports";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->report)
                {
                    $data = array(
                        'page' => 'Reports',
                        'report' => $response_json->report
                    );
                    return view('admin.report_view',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/reports');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/reports');
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
            $url .= "reports";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->report)
                {
                    $data = array(
                        'page' => 'Reports',
                        'report' => $response_json->report
                    );
                    return view('admin.report_edit',compact('user','data'));
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/reports');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/reports');
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
            $url .= "reports";
            $url .= "/";
            $url .= $request->id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            $values = array(
                'gender' => $request->gender,
                'location' => $request->location,
                'message' => $request->message
            );

            try{
                $response = $client->request('PUT', $url, ['json' => $values]);
                $response_json = json_decode($response->getBody());

                if($response_json->report)
                {
                    return redirect()->back()->with(['message' => 'Report details are updated.','class' => 'success']);
                }
                else{
                    // No Pharmacy.
                    return redirect('admin/reports');
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/reports');
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
            $url .= "reports";
            $url .= "/";
            $url .= $id;
            $url .= "?api_token=";
            $url .= $user->api_token;

            try{
                $response = $client->request('DELETE', $url);
                $response_json = json_decode($response->getBody());

                return redirect()->back()->with(['message' => 'Report removed.','class' => 'success']);
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/reports');
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/reports');
            }
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
        $url .= "datatables/getattendances";
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

    public function getAttendances($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "attendances";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->attendances)
            {
                return $response_json->attendances;
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