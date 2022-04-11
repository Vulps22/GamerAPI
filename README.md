# LFG-API

LFG-API is an early work-in-progress API using Laravel. The purpose of the finished product will be to allow users to login through steam and make requests for people to play specific games with.

LFG will scan a user's games whenever they log in and associate their steamID with each game they own on our database. 

LFG will create a record of each game it doesn't already know about by storing it's Steam ID, Title and image URL from Steam. Aditionally the API will keep a record of who introduced the game to the database and LFG will let users see how many games they have "discovered"  (introduced to the platform)

Users will be able to see a list of games they own, select that game and browse a list of "LFGs" (posts)

Users will be able to post new LFGs and will be able to respond to other LFGs through a Private Messaging System. ---- This system may also allow users to communicate as a group, automatically creating a group for each LFG

Currently, the following API URL's are available.

Begin the login process - gamer.makeitfortheweb.com/user/login

Scan a user's steam library - gamer.makeitfortheweb.com/user/scan/{steamID}

list all the games LFG has learned - gamer.makeitfortheweb.com/games


(Any routes listed in routes/web.php, that are not listed here, are not fully functional, or not available on gamer.makeitfortheweb.com yet, and should not be used.)

##PRIVACY NOTE

No personally identifying information is stored on LFG's database. LFG will only store your SteamID and username when you initially log in.
LFG will store a list of all the games you own and associate them with your steamID on our database
LFG will store any text you send to the API as an LFG, or Private Message

Currently this is all stored as plain text.

You may ask for this information to be removed from LFG's database by emailing ajmcallister5@gmail.com with your steamID. I will then seek to remove this information within 48 hours and inform you when this is done.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
