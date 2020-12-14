<?php

namespace App\Http\Livewire\Backend\ActivityStream;

use Livewire\Component;
use App\Post;
use App\PostLike;
use App\PostComment;
use Auth;

class ViewPost extends Component
{
    public $link;
    public $post;
    public $comment;
    public function render()
    {
        return view('livewire.backend.activity-stream.view-post');
    }

    public function mount($slug = ''){
        $this->link = request('slug', $slug);
        $this->getContent();
    }

    public function getContent(){
        $this->post = Post::where('tenant_id', Auth::user()->tenant_id)
                    ->where('post_url', $this->link)
                    ->first();
        if(!empty($this->post) ){
            return view('backend.activity-stream.view-post');
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Comment on post
    */
    public function comment($id){
        $this->validate([
            'id'=>'required',
            'comment'=>'required'
        ]);
        $com = new PostComment;
        $com->user_id = Auth::user()->id;
        $com->post_id = $id;
        $com->comment = $this->comment;
        $com->tenant_id = Auth::user()->tenant_id;
        $com->save();
        $this->comment = '';
        $this->getContent();
    }

    /*
    *Like post
    */
    public function addLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $like = new PostLike;
        $like->user_id = Auth::user()->id;
        $like->post_id = $id;
        $like->tenant_id = Auth::user()->tenant_id;
        $like->save();
    }
    /*
    *Unlike post
    */
    public function unLike($id){
        $this->validate([
            'id'=>'required'
        ]);
        $unlike = PostLike::where('post_id', $id)
                            ->where('user_id', Auth::user()->id)
                            ->where('tenant_id',Auth::user()->tenant_id)->first();
        $unlike->delete();
    }
}
