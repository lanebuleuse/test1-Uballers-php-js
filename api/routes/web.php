<?php
use Illuminate\Http\Request;
use App\Models\User;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router)
{
    return $router
        ->app
        ->version();
});
// api login form
// {"login": "mylogin", "password": "mypassword"}
$router->post('/api/login', function (Request $request) use ($router)
{
    // for return json
    // return insomnia : 200 (user connected)
    // https://www.php.net/manual/en/function.json-decode.php
    // Transform the datas json in to array to use in php
    $jsonData = json_decode($request->getContent() , true);

    // Retrouver l'utilisateur en base de donnée
    $users = User::where('login', $jsonData['login'])->take(1)
        ->get();
    // S'il existe pas retourner une erreur
    if (count($users) === 0)
    {
        return response()->json(['success' => false, 'message' => 'user doesnt exists'], 404);
    }

    $user = $users->first(); // for return the first user
    // S'il existe mais que le passe n'est pas bon alors retourner une erreur
    if ($jsonData['password'] === $user->password)
    {
        // In the case logged success
        // {"success": true, "token": "xxxx"} HTTP 200 OK
        return response()
            ->json(['success' => true, 'login' => $user->login], 200);

    }

    // https://lumen.laravel.com/docs/5.2/responses#json-responses
    // si le mot de passe transmis pas l'user ne correspond pas ce qui est en base de données
    return response()
        ->json(['success' => false, 'message' => 'bad password'], 400);

    // In the case the credential are bad
    // {“success": false} HTTP 400 Bad Request (les informations de l'utilisateur ne sont pas correct)
    
});
// api register form
// {
//	"firstname": "john",
//	"lastname": "gates",
//	"login": "john.gates@gmail.com",
//	"password": "123456",
//	"date_of_birth": "12/01/2012",
//	"gender": "man"
// }
$router->post('/api/register', function (Request $request) use ($router)
{
    // 1. Transformer la chaine json en tableau
    // https://www.php.net/manual/en/function.json-decode.php
    $jsonData = json_decode($request->getContent() , true);
    // https://laravel.com/docs/8.x/eloquent#inserts
    // 2. Mettre les infos du json dans un user nouvellement créer
    $user = new User;

    $user->firstname = $jsonData['firstname'];
    $user->lastname = $jsonData['lastname'];
    $user->login = $jsonData['login'];
    $user->password = $jsonData['password'];
    $user->date_of_birth = $jsonData['date_of_birth'];
    $user->gender = $jsonData['gender'];

    // 3. Persister l'user en base de donnée
    $user->save();

    // for return json
    // return insomnia : 201 (user is created)
    // https://lumen.laravel.com/docs/5.2/responses#json-responses
    // https://stackoverflow.com/questions/53152931/laravel-custom-http-status-code-not-working@
    // In the case registed success
    // {"success": true} HTTP 201 Created
    return response()
        ->json(['success' => true, ], 201);
    // In the case registed failled because bad validation form
    // {“sucesss": false, "errors": []} HTTP 400 Bad request (les informations du formulaires ne sont pas valides)
    
});

