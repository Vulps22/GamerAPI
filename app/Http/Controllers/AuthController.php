<?php

namespace App\Http\Controllers;
require $_SERVER["DOCUMENT_ROOT"]."/steamauth/SteamConfig.php";
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function validateLogin(){
        if(isset($_SESSION['steamid'])){
            $id = $_SESSION['steamid'];
            return response()->json("Logged in as: " + $id);
        }else{
            return response()->json("Not Logged In: No user ID found");
        }
    }

    public function login(){
        $opID = new \LightOpenID('http://gamer.makeitfortheweb.com');
        if( ! $opID->mode)
        {
            $opID->identity = 'https://steamcommunity.com/openid';
            return redirect($opID->authURL());
        }
    
        elseif($opID->mode == 'cancel')
        {
            return "User has canceled the authentication";
        }
    
        else
        {
            # validation here
            if($opID->validate())
            {
		$authLink = $opID->identity;
        
       		$brokenAuth = explode("/", $authLink);
      		$AuthID = $brokenAuth[5];
        	$user = User::firstOrCreate(["steamID" => $AuthID],["username" => $this->getUsername($AuthID)]);

       		return response()->json($user);
            }
            else
            {
                return 'Not logged';
            }
        }
    }

    private function getUsername($id){
        //https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=0AD859ED9D7D2B4014052CF1BE0CF284&steamids=$id

        $curl = curl_init(); //init curl

        // set our url with curl_setopt() (opt = option)
        curl_setopt($curl, CURLOPT_URL, "https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=0AD859ED9D7D2B4014052CF1BE0CF284&steamids=$id");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($data, true);
        return $response["response"]["players"][0]["personaname"];
        //return $username;
    }
}