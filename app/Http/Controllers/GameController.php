<?php

namespace App\Http\Controllers;
require $_SERVER["DOCUMENT_ROOT"]."/steamauth/SteamConfig.php";
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\PlayerGame;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = [];

        foreach(Game::all() as $game){
            array_push($games, $game);
        }
        return Response()->json($games);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Scan a user's Steam library and create any games that don't exist
     * $request should always be a user's steam ID
     */

     public function scan($id){
        //http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=XXXXXXXXXXXXXXXXX&steamid=$request&format=json
        $curl = curl_init(); //init curl

        // set our url with curl_setopt() (opt = option)
        curl_setopt($curl, CURLOPT_URL, "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=0AD859ED9D7D2B4014052CF1BE0CF284&steamid=$id&include_appinfo=true&format=json");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $data = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($data, true);
        
        $gamesBlob = $response["response"]["games"];

        foreach($gamesBlob as $game){
            echo "<br> Processing data for" . $game["name"];
            $gameID = $game["appid"];
            Game::firstOrCreate(["steamID" => $gameID], ["name" => $game["name"], "icon_url" => $game["img_icon_url"], "created_by" => "$id"]);
            PlayerGame::firstOrCreate(["gameID" => $gameID, "userID" => $id]);
        }
        //return $username;


        //var_dump($gamesBlob);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
