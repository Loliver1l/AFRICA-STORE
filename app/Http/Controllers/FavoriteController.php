<?php
namespace App\Http\Controllers;
use App\Models\Favorite;
class FavoriteController extends Controller
{
    public function index() { return view('account.favorites',['favorites'=>Favorite::where('user_id',auth()->id())->with('product')->get()]); }
}
