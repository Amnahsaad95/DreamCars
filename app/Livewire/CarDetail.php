<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\User;
use Livewire\WithPagination;

use App\Models\complaintsSuggestions;

class CarDetail extends Component
{
	use WithPagination;
	
	public $car;
    public $mainImage;
    public $phone;
    public $isSold;
   // public $comments;
    public $newComment = '';
	public $name = '';
	public $commentPhone = '';
    public $rating = 0;
    public $hoverRating = 0;

    public function mount($id)
    {
        $this->car = Car::findOrFail($id);
		$this->phone = $this->car->user->phone;
		$this->isSold = $this->car->isSold;
        $this->mainImage = explode(',', $this->car->car_Image)[0] ;
    }

    public function changeMainImage($imagePath)
    {
        $this->mainImage = $imagePath;
    }

    public function addComment()
    {
        $this->validate([
            'name' => 'required|min:5',
			'commentPhone' => 'required',
            'newComment' => 'required|string|min:10|max:500',
        ]);
		
		complaintsSuggestions::create([
            'name' => $this->name,
            'phone_email' => $this->commentPhone,
            'content' => $this->newComment,
            'is_public' => 1,
            'type' => 'suggestion' ,
            'user_Id' => $this->car->user->user_Id ,
            'car_Id' => $this->car->car_Id ,
        ]);

        session()->flash('message', __('messages.review_submitted'));
		$this->reset('name','commentPhone','newComment');
    }

    public function addComplaint($carId)
    {
        return redirect()->route('ComplaintSuggestionForm',[
						'locale' => app()->getLocale(),
						'carId'=>$carId]);
    }
	
	public function callSeller()
    {
        if (!$this->isSold && $this->phone) {
            // Code to trigger the phone call
            $phoneNumber = $this->phone;
            return redirect()->to("tel:$phoneNumber");
        }
    }
	
	public function render()
    {
		$comment = complaintsSuggestions::query()
										->where('type', 'suggestion')
										->where('car_Id', $this->car->car_Id)
										->paginate(10);
		//dd($comment->count());
        return view('livewire.car-detail',['comments'=> $comment]);
    }
}
