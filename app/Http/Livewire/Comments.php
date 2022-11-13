<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Comment;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Comments extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $photo;
    public $iteration;

    // public $comments;

    public $newComment;

    // กำหนด Rule สำหรับ Validate
    protected $rules = [
        'newComment' => 'required|min:5|max:128',
        'photo' => 'image|max:2048'
    ];

    // กำหนดข้อความ Validate
    protected $messages = [
       'newComment.required' => ':attribute ห้ามปล่อยว่าง',
       'newComment.min' => ':attribute ต้องมากกว่า :min ตัวอักษร',
       'newComment.max' => ':attribute ต้องน้อยกว่า :max ตัวอักษร',
       'photo.image' => ':attribute ต้องเป็นรูปภาพเท่านั้น',
       'photo.max' => ':attribute ขนาดต้องไม่เกิน :max bytes'
    ];

    // Method for initailizing
    public function mount(){
        // $initialComments = Comment::latest()->get();
        // $this->comments = $initialComments;
    }

        // Realtime Validation
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function addComment(){

        $this->validate();

        if($this->newComment == ""){
            return;
        }

        $createdComment = Comment::create(
            [
                'body' => $this->newComment,
                'user_id' => 1
            ]
        );

        // เช็คว่ามีการเลือกไฟล์ภาพเข้ามาหรือไม่
        if($this->photo){
            $this->photo->store('images/comments','public');
        }

        // $this->comments->prepend($createdComment);

        // Clear input field
        $this->newComment = "";
        $this->photo = null;
        $this->iteration++;

        // แสดงข้อความ flash message
        session()->flash('message_add', 'เพิ่มคอมเม้นท์แล้ว');
    }

    // ฟังก์ชันในการลบข้อมูล
    public function remove($commentId){
        // dd($commentId);
        $comment = Comment::find($commentId);
        $comment->delete();
        // $this->comments = $this->comments->except($commentId);
        session()->flash('message_delete', 'ลบคอมเม้นท์แล้ว');
    }

    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::latest()->paginate(5)
        ]);
    }
}
