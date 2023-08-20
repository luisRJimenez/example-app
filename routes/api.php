<?php
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request): Response {
  $credentials = $request->validate([
      'email'    => ['required', 'email'],
      'password' => ['required'],
  ]);
  if (Auth::attempt($credentials)) {
    $user = Auth::user();
    $token = $user->createToken('token')->plainTextToken;
    
    $cookie = cookie('cookie_token', $token, 60 *24);
    return Response(['token'=>$token], 200)->withoutCookie($cookie);
  }
  else
  {
    return response(['authenticated' => Auth::attempt($credentials)]);
  }
  //return response()->json(['authenticated' => Auth::attempt($credentials)]);
});


Route::middleware('auth:sanctum')->group(function () {
  
    Route::get('/logged-in', function (Request $request): Response {
      
      if (Auth::check()){
        $user = Auth::user();
        return Response(['data'=>$user], 200);
      }
      return response()->json(['data' => 'Unauthorized'
        // 'user' => $request->user()->only('id', 'email', 'first_name', 'last_name', 'image'),
      ], 401);
    });
  
    Route::match(['get', 'post'], '/logout', function (Request $request) {
  

      Auth::guard('web')->logout();
      $cookie = Cookie::forget('cookie_token');
      //$request->session()->invalidate();
      $user = Auth::user();
      $user->currentAccessToken()->delete();
      //$request->session()->regenerateToken();
      return Response(['data'=> 'User logout succesfully'], 200)->withCookie($cookie);
      //return response(['message'=>"cierre de session"], 200)->withCookie($cookie);
    });
  });