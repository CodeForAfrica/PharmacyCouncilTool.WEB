<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
                'page' => 'Dashboard',
                'pharmacies' => $this->getPharmacies(),
                'reports' => $this->getReports($user),
                'users' => $this->getUsers($user)
            );
            return view('admin.dashboard',compact('user','data'));
        }
    }

    public function getPharmacies()
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "pharmacies";

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->pharmacies)
            {
                return $response_json->pharmacies;
            }
            else{
                // No Pharmacies.
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

    public function getReports($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "reports";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->reports)
            {
                return $response_json->reports;
            }
            else{
                // No Reports.
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

    public function getUsers($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "users";
        $url .= "?api_token=";
        $url .= $user->api_token;

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->users)
            {
                return $response_json->users;
            }
            else{
                // No Reports.
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