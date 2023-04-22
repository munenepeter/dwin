<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Underwriter;
use App\Models\Client;
use App\Models\Insurance;
use Livewire\Component;

class Clients extends Component {
    public  $underwriters, $insurance_types, $full_names, $policy_number, $risk_id, $sum_insured,
        $political_risk, $excess_protector, $basic_premium, $annual_expiry_date,
        $underwriter, $insurance, $clientId, $newReport = false, $updateClient = false, $addClient = false, $viewClient = false;
    /**
     * delete action listener
     */
    protected $listeners = [
        'viewClientListener' => 'viewClient',
        'updateClientListener' => 'editClient',
        'deleteClientListener' => 'deleteClient'
    ];

    /**
     * List of add/edit form rules
     */
    protected $rules = [
        'full_names' => 'required',
        'policy_number' => 'required|numeric',
        'risk_id' => 'required|numeric',
        'sum_insured' => 'required|numeric',
        'political_risk' => 'required|numeric',
        'excess_protector' => 'required|numeric',
        'basic_premium' => 'required|numeric',
        'annual_expiry_date' => 'required',
        'underwriter' => 'required',
        'insurance' => 'required'
    ];

    /**
     * Reseting all inputted fields
     * @return void
     */
    public function resetFields() {

        $this->full_names = '';
        $this->policy_number = '';
        $this->risk_id = '';
        $this->sum_insured = '';
        $this->political_risk = '';
        $this->excess_protector = '';
        $this->basic_premium = '';
        $this->annual_expiry_date = '';
        $this->underwriter = '';
        $this->insurance = '';
    }

    /**
     * render the client data
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function render() {
        $this->insurance_types = Insurance::all();;
        $this->underwriters = Underwriter::all();
        return view('livewire.clients.clients', [
            'clients' => Client::latest()->paginate(10),
        ]);
    }
 /**
     * Open Add Client form
     * @return void
     */
    public function newReport() {
        $this->resetFields();
        $this->newReport = true;
        $this->addClient = false;
        $this->updateClient = false;
    }
    /**
     * Open Add Client form
     * @return void
     */
    public function addClient() {
        $this->resetFields();
        $this->addClient = true;
        $this->updateClient = false;
    }
    /**
     * store the user inputted client data in the clients table
     * @return void
     */
    public function storeClient() {
        $this->validate();
        try {
            Client::create([
                'full_names' => $this->full_names,
                'policy_number' => $this->policy_number,
                'risk_id' => $this->risk_id,
                'sum_insured' => $this->sum_insured,
                'political_risk' => $this->political_risk,
                'excess_protector' => $this->excess_protector,
                'basic_premium' => $this->basic_premium,
                'annual_total_premium' => $this->basic_premium + $this->excess_protector + $this->political_risk,
                'annual_expiry_date' => $this->annual_expiry_date,
                'annual_renewal_date' =>  date("Y-m-d", strtotime('+1 year', strtotime($this->annual_expiry_date))),
                'underwriter_id' => $this->underwriter,
                'insurance_id' => $this->insurance
            ]);
            session()->flash('success', 'Client Created Successfully!!');
            $this->resetFields();
            $this->addClient = false;
        } catch (\Exception $ex) {
            session()->flash('error', 'Something not right!!');
            throw new \Exception($ex);
        }
    }

    /**
     * show existing client data in edit client form
     * @param mixed $id
     * @return void
     */
    public function editClient($id) {
        try {
            $client = Client::findOrFail($id);
            if (!$client) {
                session()->flash('error', 'Client not found');
            } else {
                // $this->name = $client->full_names;
                // $this->email = $client->email;
                // $this->phone = $client->phone;
                // $this->notes = $client->notes;
                // $this->clientId = $client->id;
                // $this->updateClient = true;
                // $this->addClient = false;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something not right!!');
        }
    }

    /**
     * update the client data
     * @return void
     */
    public function updateClient() {
        $this->validate();
        try {
            Client::whereId($this->clientId)->update([
                'full_names' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'plan_start_at' => $this->plan_start_at,
                'plan_end_at' => date("Y-m-d", strtotime('+1 month', strtotime($this->plan_start_at))),
                'plan_id' => $this->plan,
                'notes' => $this->notes
            ]);
            session()->flash('success', 'Client Updated Successfully!!');
            $this->resetFields();
            $this->updateClient = false;
        } catch (\Exception $ex) {
            session()->flash('success', 'Something not right!!');
        }
    }

    /**
     * Cancel Add/Edit form and redirect to client listing page
     * @return void
     */
    public function cancelClient() {
        $this->addClient = false;
        $this->updateClient = false;
        $this->resetFields();
    }

    /**
     * show existing client data in edit client form
     * @param mixed $id
     * @return void
     */
    public function viewClient($id) {
        try {
            $client = Client::findOrFail($id);
            if (!$client) {
                session()->flash('error', 'Client not found');
            } else {
            
                $this->updateClient = false;
                $this->addClient = false;
                $this->viewClient = true;
            }
        } catch (\Exception $ex) {
            session()->flash('error', 'Something not right!!');
        }
    }

    /**
     * delete specific client data from the clients table
     * @param mixed $id
     * @return void
     */
    public function deleteClient($id) {
  
        try {
            Client::destroy($id);
            session()->flash('success', "Client Deleted Successfully!!");
        } catch (\Exception $e) {
            session()->flash('error', "Something not right!!");
        }
    }

    // public function markPaid($id) {
    //     $client = Client::findOrFail($id);
    //     $last_start_at = new Carbon($client->plan_end_at);
    //     $last_start_at1 = new Carbon($client->plan_end_at);
    //     try {
    //         Client::whereId($id)->update([
    //             'plan_end_at' => $last_start_at->addMonth(),
    //             'status' => 'paid',
    //         ]);
    //         // Payment::create([
    //         //     'period' => $last_start_at1->subMonth()->format('jS M Y') . ' - ' . date('jS M Y', strtotime($client->plan_end_at)),
    //         //     'amount' => $client->plan->amount,
    //         //     'client_id' => $client->id,
    //         // ]);
    //         session()->flash('success', "Client Updated Successfully!!");
    //     } catch (\Exception $e) {
    //         throw new \Exception($e);
    //         session()->flash('error', "Something not right!!");
    //     }
    // }
}
