<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DistrictsController extends Controller
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
            return view('admin.districts.main',compact('user','data'));
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
        $url .= "datatables/getdistricts";
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
}