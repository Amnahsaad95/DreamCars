<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Ads;

class AdsManagement extends Component
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
    
    public function publishAds($adsId)
    {
        Ads::find($adsId)->update(['status' => 'published']);
        session()->flash('message', 'Ads published successfully!');
    }
	public function unpublishAds($adsId)
    {
        Ads::find($adsId)->update(['status' => 'unpublished']);
        session()->flash('message', 'Ads Unpublished successfully!');
    }
	
	
    
    public function rejectAds($adsId)
    {
        Ads::find($adsId)->update(['status' => 'rejected']);
        session()->flash('message', 'Ads rejected successfully!');
    }
    
    public function deleteAds($adsId)
    {
        Ads::find($adsId)->delete();
        session()->flash('message', 'Ads deleted successfully!');
    }
    
	
	
    public function render()
    {
		$query = Ads::query()
            ->when($this->search, function($query) {
                return $query->where('FullName', 'like', '%'.$this->search.'%')
                             ->orWhere('location', 'like', '%'.$this->search.'%');
            });
            
        $published = (clone $query)->where('status', 'published')->paginate(10, ['*'], 'publishedPage');
        $rejected = (clone $query)->where('status', 'rejected')->paginate(10, ['*'], 'rejectedPage');
        $pending = (clone $query)->where('status', 'pending')->paginate(10, ['*'], 'pendingPage');
		$unpublished = (clone $query)->where('status', 'unpublished')->paginate(10, ['*'], 'unpublishedPage');
        
        return view('livewire.auth.ads-management', [
            'publishedAds' => $published,
            'rejectedAds' => $rejected,
            'pendingAds' => $pending,
			'unpublishedAds'=>$unpublished,
			'all'=>$query->paginate(10, ['*'], 'all')
        ])->layout('components.layouts.admindashboard');
    }
}
