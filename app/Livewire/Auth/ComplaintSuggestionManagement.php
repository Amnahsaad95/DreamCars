<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\complaintsSuggestions;

class ComplaintSuggestionManagement extends Component
{
    use WithPagination;
    
    public $activeTab = 'all';
    public $search = '';
    
    protected $queryString = [
        'activeTab' => ['except' => 'all'],
        'search' => ['except' => ''],
    ];
    
    public function changeTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }
    
    public function publishComplaint($complaintId)
    {
        complaintsSuggestions::find($complaintId)->update(['status' => 'accepted']);
		session()->flash('message', __('messages.action_message', ['action' => __('messages.published')]));
    }
	public function unpublishComplaint($complaintId)
    {
        complaintsSuggestions::find($complaintId)->update(['status' => 'accepted']);
		session()->flash('message', __('messages.action_message', ['action' => __('messages.unpublished')]));
    }
	
	
    
    public function rejectComplaint($complaintId)
    {
        complaintsSuggestions::find($complaintId)->update(['status' => 'rejected']);
		session()->flash('message', __('messages.action_message', ['action' => __('messages.rejected')]));
    }
    
    public function deleteComplaint($complaintId)
    {
        complaintsSuggestions::find($complaintId)->delete();
		session()->flash('message', __('messages.action_message', ['action' => __('messages.deleted')]));
    }
    
    public function render()
    {
        $query = complaintsSuggestions::query()
            ->when($this->search, function($query) {
                return $query->where('content', 'like', '%'.$this->search.'%')
                             ->orWhere('name', 'like', '%'.$this->search.'%');
            });
            
        $published = (clone $query)->where('is_public', 1)->where('status', 'accepted')->paginate(10, ['*'], 'publishedPage');
        $rejected = (clone $query)->where('status', 'rejected')->paginate(10, ['*'], 'rejectedPage');
        $pending = (clone $query)->where('status', 'pending')->paginate(10, ['*'], 'pendingPage');
		$unpublished = (clone $query)->where('is_public', 0)->where('status', 'accepted')->paginate(10, ['*'], 'unpublishedPage');
        
        return view('livewire.auth.complaint-suggestion-management', [
            'publishedComplaints' => $published,
            'rejectedComplaints' => $rejected,
            'pendingComplaints' => $pending,
			'unpublished'=>$unpublished,
			'all'=>$query->paginate(10, ['*'], 'all')
        ])->layout('components.layouts.admindashboard');
    }
}
