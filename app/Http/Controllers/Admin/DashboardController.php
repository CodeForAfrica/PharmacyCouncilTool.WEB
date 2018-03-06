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
                'page' => 'Dashboard' /*,
                'dispensers' => $this->getDispensers($user) ?: array(),
                'addos' => $this->getAddos($user) ?: array(),
                'personnels' => $this->getPersonnels($user) ?: array(),
                'personnels_pharmacists' => $this->getPersonnels($user, "Pharmacist") ?: array(),
                'personnels_pharmaceutical_technicians' => $this->getPersonnels($user, "Pharmaceutical Technician") ?: array(),
                'personnels_medical_representatives' => $this->getPersonnels($user, "Medical Representative") ?: array(),
                'pharmacies' => $this->getPharmacies($user) ?: array(),
                'pharmacies_renewed' => $this->getPharmacies($user, "Renewed") ?: array(),
                'pharmacies_pending' => $this->getPharmacies($user, "Pending") ?: array(),
                'pharmacies_waiting_permit' => $this->getPharmacies($user, "Waiting Permit") ?: array(),
                'pharmacies_not_renewed' => $this->getPharmacies($user, "Not Renewed") ?: array(),
                'pharmacies_closed' => $this->getPharmacies($user, "Closed") ?: array(),
                'pharmacies_temporary_closed' => $this->getPharmacies($user, "Temporary Closed") ?: array(),
                'owners' => $this->getOwners($user) ?: array(),
                'owners_professional' => $this->getOwners($user, "Proffessional") ?: array(),
                'owners_not_professional' => $this->getOwners($user, "Not Proffessional") ?: array(),
                'reports' => $this->getReports($user) ?: array(),
                'reports_males' => $this->getReports($user, "Male") ?: array(),
                'reports_females' => $this->getReports($user, "Female") ?: array(),
                'attendances' => $this->getAttendances($user) ?: array(),
                'users' => $this->getUsers($user) ?: array()*/
            );

            return view('admin.dashboard',compact('user','data'));
        }
    }

    public function getDispensersData(){
        $user = session('user');

        // Fetching data
        $dispensers = $this->getDispensers($user);

        return response()->json([
            'total_dispensers' => count($dispensers)
        ],200);
    }

    public function getAddosData(){
        $user = session('user');

        // Fetching data
        $addos = $this->getAddos($user);

        return response()->json([
            'total_addos' => count($addos)
        ],200);
    }

    public function getPersonnelsData(){
        $user = session('user');

        // Fetching data
        $personnels = $this->getPersonnels($user);
            $total_personnels_pharmacists = 0;
            $total_personnels_pharmaceutical_technicians = 0;
            $total_personnels_medical_representatives = 0;

            if(count($personnels) > 0){
                foreach($personnels as $personnel){
                    if($personnel->type == "Pharmacist") $total_personnels_pharmacists += 1;
                    if($personnel->type == "Pharmaceutical Technician") $total_personnels_pharmaceutical_technicians += 1;
                    if($personnel->type == "Medical Representative") $total_personnels_medical_representatives += 1;
                }
            }

        return response()->json([
            'total_personnels' => count($personnels),
            'total_personnels_pharmacists' => $total_personnels_pharmacists,
            'total_personnels_pharmaceutical_technicians' => $total_personnels_pharmaceutical_technicians,
            'total_personnels_medical_representatives' => $total_personnels_medical_representatives
        ],200);
    }

    public function getPharmaciesData(){
        $user = session('user');

        //dd($user);

        // Fetching data
        $pharmacies = $this->getPharmacies($user);
            $total_pharmacies_renewed = 0;
            $total_pharmacies_not_renewed = 0;
            $total_pharmacies_pending = 0;
            $total_pharmacies_waiting_permit = 0;
            $total_pharmacies_closed = 0;
            $total_pharmacies_temporary_closed = 0;

            if(count($pharmacies) > 0){
                foreach($pharmacies as $pharmacy){
                    if($pharmacy->renewal_status == "Renewed") $total_pharmacies_renewed += 1;
                    if($pharmacy->renewal_status == "Not Renewed") $total_pharmacies_not_renewed += 1;
                    if($pharmacy->renewal_status == "Pending") $total_pharmacies_pending += 1;
                    if($pharmacy->renewal_status == "Waiting Permit") $total_pharmacies_waiting_permit += 1;
                    if($pharmacy->renewal_status == "Closed") $total_pharmacies_closed += 1;
                    if($pharmacy->renewal_status == "Temporary Closed") $total_pharmacies_temporary_closed += 1;
                }
            }

        return response()->json([
            'total_pharmacies' => count($pharmacies),
            'total_pharmacies_renewed' => $total_pharmacies_renewed,
            'total_pharmacies_not_renewed' => $total_pharmacies_not_renewed,
            'total_pharmacies_pending' => $total_pharmacies_pending,
            'total_pharmacies_waiting_permit' => $total_pharmacies_waiting_permit,
            'total_pharmacies_closed' => $total_pharmacies_closed,
            'total_pharmacies_temporary_closed' => $total_pharmacies_temporary_closed
        ],200);
    }

    public function getOwnersData(){
        $user = session('user');

        // Fetching data
        $owners = $this->getOwners($user);
            $total_owners_professionals = 0;
            $total_owners_not_professionals = 0;

            if(count($owners) > 0){
                foreach($owners as $owner){
                    if($owner->status == "Professional" || $owner->status == "Proffessional") $total_owners_professionals += 1;
                    if($owner->status == "Not Professional" || $owner->status == "Not Proffessional") $total_owners_not_professionals += 1;
                }
            }

        return response()->json([
            'total_owners' => count($owners),
            'total_owners_professionals' => $total_owners_professionals,
            'total_owners_not_professionals' => $total_owners_not_professionals
        ],200);
    }

    public function getReportsData(){
        $user = session('user');

        // Fetching data
        $reports = $this->getReports($user);
            $total_reports_males = 0;
            $total_reports_females = 0;

            if(count($reports) > 0){
                foreach($reports as $report){
                    if($report->gender == "Male") $total_reports_males += 1;
                    if($report->gender == "Female") $total_reports_females += 1;
                }
            }

        return response()->json([
            'total_reports' => count($reports),
            'total_reports_males' => $total_reports_males,
            'total_reports_females' => $total_reports_females
        ],200);
    }

    public function getAttendancesData(){
        $user = session('user');

        // Fetching data
        $attendances = $this->getAttendances($user);

        return response()->json([
            'total_attendances' => count($attendances)
        ],200);
    }

    public function getUsersData(){
        $user = session('user');

        // Fetching data
        $users = $this->getUsers($user);

        return response()->json([
            'total_users' => count($users)
        ],200);
    }


    public function getPharmacies($user, $status = "")
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "onlypremises";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        if($status != ""){
            $url .= "&renewal_status=";
            $url .= $status;
        }

        try{
            $response = $client->request('GET', $url);
            $response_json = json_decode($response->getBody());

            if($response_json->premises)
            {
                return $response_json->premises;
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

    public function getReports($user, $gender = "")
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "reports";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        if($gender != ""){
            $url .= "&gender=";
            $url .= $gender;
        }

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
        $url .= "&limit=all";

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

    public function getDispensers($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "dispensers";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

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

    public function getAddos($user)
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "addos";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

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

    public function getPersonnels($user, $type="")
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "personnels";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

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
                // No Personnels.
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

    public function getOwners($user, $status = "")
    {
        $client = new \GuzzleHttp\Client(['http_errors' => true]);
        $url = env('APP_URL');
        $url .= "owners";
        $url .= "?api_token=";
        $url .= $user->api_token;
        $url .= "&limit=all";

        if($status != ""){
            $url .= "&status=";
            $url .= $status;
        }

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