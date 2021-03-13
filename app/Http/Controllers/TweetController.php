<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    public function index(){
        return Tweet::with('user')->orderByDesc('created_at')->get();
    }
    public function store(Request $request) {
        $attributes = $request->validate(['body'=>'required|max:255']);
        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']
        ]);
    }
    public function destroy($id){
        $tweet = Tweet::findOrFail($id);
        $tweet->delete();
    }
    public function update(Request $request)
    {
        $task = Tweet::findOrFail($request['id']);

        $this->validate($request, [
            'body' => 'required|min:1|max:255',
        ]);

        $input = $request->all();
        $task->fill($input)->save();
    }

}
