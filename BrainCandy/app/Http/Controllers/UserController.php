<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\User;
use App\Interest;

class UserController extends Controller
{

    public function __construct()
    {
    //   $this->middleware('admin');
    }



    public function show($id)
    {
        if(!ctype_digit($id)){ // string consists of all digs, thus is an int
            abort(404);
        }

        // $user = User::findOrFail($id);
        // $current_subscribed_books = [];
        //   //want to change here: only show list of books that are currently subscribed so not subscribed table
        // foreach($user->subscriptions as $subscription) {
        //     $book = Book::where('id', $subscription->book_id)->get()->first();
        //     if($user->isCurrentSubscriber($book->id)) {
        //         array_push($current_subscribed_books, $book);
        //     }
        // }
        // return view('users.show', compact('user', 'current_subscribed_books'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param string id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$user = User::findOrFail($id);
        $currentInterests = $user->interestsString();
        // dd($user);
    	return view('users.edit', compact('user', 'currentInterests'));

    }

    /**
     * Update the specified resource in storage
     */
    public function update(UserRequest $request, $id){
        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);

        $interestsString = $request->input('interests');
        $new_interests = explode(', ', $interestsString);
        foreach($new_interests as $i){
            if(!Interest::exists($id,$i)){
                //make new row in interest table
                Interest::create([
                    'user_id'=>$id,
                    'interest'=>$i
                ]);
            }
        }
        //TODO remove interests that were deleted
        $oldInterests = explode(', ', $user->interestsString());
        foreach($oldInterests as $i){
            if (!in_array($i, $new_interests)) {
                //this old interest is no longer in the new_interests
                //delete interest
                Interest::where('user_id','=', $id)->where('interest','=',$i)->delete();
            }
        }
        return redirect('home')->with('success', 'Flavor Profile Updated.');   ;
    }

}
