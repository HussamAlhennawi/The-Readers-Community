<?php

namespace App\Http\Controllers;

use App\Post;
use App\reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return void
     */
    public function store(Request $request)
    {


        $user_id = Auth::user()->id;
        $attributes = [
            'reaction' => 'REACTION\'S TYPE',
        ];

        $error_messages = [
            'reaction.in' => 'THE :attribute IS INVALID',
        ];

        $request->validate([
            'reaction' => 'in:reactions,id',
        ], $error_messages, $attributes);

//        $post = Post::find($post->id);

        $user_is_reacted_to_this_post = DB::table('post_reactions')
            ->where('post_id', '=', $request['post_id'])
            ->where('user_id', '=', $user_id)
            ->first();














        $post = Post::find($request['post_id']);

        if (empty($user_is_reacted_to_this_post)){
            $post->post_reaction_by_user()->toggle([$user_id => ['reaction_id' => $request['reaction_id']]]);
        }
        elseif($user_is_reacted_to_this_post->reaction_id == $request['reaction_id'])
        {
            $post->post_reaction_by_user()->toggle([$user_id => ['reaction_id' => $request['reaction_id']]]);
        }
        else
        {
                $post->post_reaction_by_user()->toggle([$user_id => ['reaction_id' => $request['reaction_id']]]);
                $post->post_reaction_by_user()->toggle([$user_id => ['reaction_id' => $request['reaction_id']]]);
        }

        // get the reactions name in the system
        $reactions = Reaction::all();
        // get number or each reaction type for each post in this group
        $posts_reactions = DB::table('post_reactions')
            ->where('post_id', $request['post_id'])
            ->select('post_id', 'reaction_id',  DB::raw('COUNT(reaction_id) as total_reactions'))
            ->groupby(['post_id', 'reaction_id'])->get();

        // get user reactions on posts in this group
        $user_reactions = DB::table('post_reactions')
            ->where('post_id', $request['post_id'])
            ->where('user_id', '=', Auth::user()->id)
            ->select('post_id', 'reaction_id')
            ->get();

        // for ajax
        $msg='';
        $msg .= '<div class="new-reac" style="margin-left: 35%">' ;
        foreach($reactions as $reaction) {
            $rr = [];
            $r = false;
            foreach ($posts_reactions as $post_reactions)
                if ($post->id == $post_reactions->post_id)
                    if ($reaction->id == $post_reactions->reaction_id)
                        $rr[$reaction->id] = $post_reactions->total_reactions;
            foreach ($user_reactions as $user_reaction)
                if ($post->id == $user_reaction->post_id)
                    if ($reaction->id == $user_reaction->reaction_id)
                        $r = true;


            $msg .= '                <button ';
            if ($r)
                $msg .= 'style="background-color: #0f3967" ' ;
            $msg .= 'class="btn btn-default btn-sm add-reaction" name="reaction_id" ' .
                '                        value="{{$reaction->id}}" post_id="{{$post->id}}" ' .
                '                        type="submit">';
            if(!empty($rr))
                $msg.= $rr[$reaction->id];
            $msg .= $reaction->name.' </button>' ;
        }
        $msg .= '        </div>';

//        echo $msg;
//        die();
        return json_encode(['msg'=>$msg]);

//        return redirect()->route('group.posts',$group);

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function show(reaction $reaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function edit(reaction $reaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reaction $reaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reaction  $reaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(reaction $reaction)
    {
        //
    }
}
