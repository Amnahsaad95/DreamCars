<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Car;
use App\Models\User;

class UsersManagement extends Component
{
	use WithPagination;
    use WithFileUploads;
	public $viewUser;
    public $carId;
    public $isViewModalOpen = false;
    public $search = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';


     public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }


    public function openViewModal($id)
    {
		
        $this->viewUser = User::findOrFail($id);
        $this->isViewModalOpen = true;
    }
	
	public function delete($id)
    {
        User::find($id)->delete();
    }

    public function closeModal()
    {
        $this->isViewModalOpen = false;
    }
	public function render()
    {
		$users = User::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.auth.users-management',[
            'users' => $users,
        ])->layout('components.layouts.admindashboard');;
    }
}
