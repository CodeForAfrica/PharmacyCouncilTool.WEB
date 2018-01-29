<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Session;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        // Checking passed email and password.
        if($request->email && $request->password){
            $client = new \GuzzleHttp\Client(['http_errors' => true]);
            $url = env('APP_URL');
            $url .= "user/login";
            $url .= "?email=".$request->email;
            $url .= "&password=".$request->password;


            dd($url);

            try{
                $response = $client->request('GET', $url);
                $response_json = json_decode($response->getBody());

                if($response_json->token && $response_json->token != "")
                {
                    // Authenticating the user.
                    $url = env('APP_URL');
                    $url .= "user/auth";

                    $response_user = $client->get($url, [
                        'headers' => [
                            'Authorization' => 'Bearer ' . (string)$response_json->token
                        ]
                    ]);

                    $response_user_json = json_decode($response_user->getBody());

                    // Setting user session.
                    $user = $response_user_json->user;
                    Session::put('user',$user);

                    // Redirect to Dashboard.
                    return redirect('admin/dashboard');
                }
                else{
                    // User not found.
                    return redirect('admin/login')->with(['message' => 'Invalid email or password.','class' => 'danger']);
                }
            }
            catch (ClientErrorResponseException $e) {
                \Log::info("Client error :" . $e->getResponse()->getBody(true));
                return redirect('admin/login')->with(['message' => 'Something went wrong, try login again.','class' => 'warning']);
            }
            catch (ServerErrorResponseException $e) {
                \Log::info("Server error" . $e->getResponse()->getBody(true));
                return redirect('admin/login')->with(['message' => 'Something went wrong, try login again.','class' => 'warning']);
            }
            catch (BadResponseException $e) {
                \Log::info("BadResponse error" . $e->getResponse()->getBody(true));
                return redirect('admin/login')->with(['message' => 'Something went wrong, try login again.','class' => 'warning']);
            }
            catch (\Exception $e) {
                \Log::info("Err" . $e->getMessage());
                return redirect('admin/login')->with(['message' => 'Invalid email or password.','class' => 'danger']);
            }
        }
        else
        {
            return redirect('admin/login')->with(['message' => 'Enter your credentials to login.','class' => 'warning']);
        }
    }
}