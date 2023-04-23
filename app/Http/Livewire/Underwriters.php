<?php

namespace App\Http\Livewire;

use App\Models\Underwriter;
use Livewire\Component;

class Underwriters extends Component {

    public $name, $underwriterId, $updateUnderwriter = false, $addUnderwriter = false,
           $viewUnderwriter = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteUnderwriterListner' => 'deleteUnderwriter'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'name' => 'required'
    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields() {
        $this->name = ''; 
    }

    /**
     * render the underwriter data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render() {
        
        return view('livewire.underwriters.underwriters', [
            'underwriters' => Underwriter::latest()->paginate(10)
        ]);
    }

    /**
     * Open Add Underwriter form
     * @return void
     */
    public function addUnderwriter() {
        $this->resetFields();
        $this->addUnderwriter = true;
        $this->updateUnderwriter = false;
    }
    /**
     * store the user inputted underwriter data in the underwriters table
     * @return void
     */
    public function storeUnderwriter() {
        $this->validate();
        try {
            Underwriter::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Underwriter Created Successfully!!');
            $this->resetFields();
            $this->addUnderwriter = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
            throw new \Exception($ex);
        }
    }

    /**
     * show existing underwriter data in edit underwriter form
     * @param mixed $id
     * @return void
     */
    public function editUnderwriter($id) {
        try {
            $underwriter = Underwriter::findOrFail($id);
            if (!$underwriter) {
                session()->flash('error', 'Underwriter not found');
            } else {
                $this->name = $underwriter->name;
                $this->underwriterId = $underwriter->id;
                $this->updateUnderwriter = true;
                $this->addUnderwriter = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * update the underwriter data
     * @return void
     */
    public function updateUnderwriter() {
        $this->validate();
        try {
            Underwriter::whereId($this->underwriterId)->update([
                'name' => $this->name
            ]);
            session()->flash('success', 'Underwriter Updated Successfully!!');
            $this->resetFields();
            $this->updateUnderwriter = false;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    /**
     * Cancel Add/Edit form and redirect to underwriter listing page
     * @return void
     */
    public function cancelUnderwriter() {
        $this->addUnderwriter = false;
        $this->updateUnderwriter = false;
        $this->resetFields();
    }

    /**
     * delete specific underwriter data from the underwriters table
     * @param mixed $id
     * @return void
     */
    public function deleteUnderwriter($id) {

        try {
            Underwriter::find($id)->delete();
            session()->flash('success', "Underwriter Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
