<?php

namespace App\Http\Livewire;

use App\Models\Insurance;
use Livewire\Component;

class Insurances extends Component {

    public $name, $insuranceId, $updateInsurance = false, $addInsurance = false,
        $viewInsurance = false;

    /**
     * delete action listener
     */
    protected $listeners = [
        'deleteInsuranceListner' => 'deleteInsurance'
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
     * render the insurance data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render() {

        return view('livewire.insurances.insurances', [
            'insurances' => Insurance::latest()->paginate(10)
        ]);
    }

    /**
     * Open Add Insurance form
     * @return void
     */
    public function addInsurance() {
        $this->resetFields();
        $this->addInsurance = true;
        $this->updateInsurance = false;
    }
    /**
     * store the user inputted insurance data in the insurances table
     * @return void
     */
    public function storeInsurance() {
        $this->validate();
        try {
            Insurance::create([
                'name' => $this->name,
            ]);
            session()->flash('success', 'Insurance Created Successfully!!');
            $this->resetFields();
            $this->addInsurance = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
            throw new \Exception($ex);
        }
    }

    /**
     * show existing insurance data in edit insurance form
     * @param mixed $id
     * @return void
     */
    public function editInsurance($id) {
        try {
            $insurance = Insurance::findOrFail($id);
            if (!$insurance) {
                session()->flash('error', 'Insurance not found');
            } else {
                $this->name = $insurance->name;
                $this->insuranceId = $insurance->id;
                $this->updateInsurance = true;
                $this->addInsurance = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something goes wrong!!');
        }
    }

    /**
     * update the insurance data
     * @return void
     */
    public function updateInsurance() {
        $this->validate();
        try {
            Insurance::whereId($this->insuranceId)->update([
                'name' => $this->name
            ]);
            session()->flash('success', 'Insurance Updated Successfully!!');
            $this->resetFields();
            $this->updateInsurance = false;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something goes wrong!!');
        }
    }

    /**
     * Cancel Add/Edit form and redirect to insurance listing page
     * @return void
     */
    public function cancelInsurance() {
        $this->addInsurance = false;
        $this->updateInsurance = false;
        $this->resetFields();
    }

    /**
     * delete specific insurance data from the insurances table
     * @param mixed $id
     * @return void
     */
    public function deleteInsurance($id) {

        try {
            Insurance::find($id)->delete();
            session()->flash('success', "Insurance Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something goes wrong!!");
        }
    }
}
