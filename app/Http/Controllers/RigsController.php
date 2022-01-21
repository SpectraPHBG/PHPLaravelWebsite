<?php


namespace App\Http\Controllers;


use App\Models\Cooler;
use App\Models\CPU;
use App\Models\Drive;
use App\Models\Export_Rig;
use App\Models\GPU;
use App\Models\Motherboard;
use App\Models\PCCase;
use App\Models\PSU;
use App\Models\RAM;
use App\Models\RIG;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RigsController
{
    private $cpus;
    private $gpus;
    private $motherboards;
    private $drives;
    private $coolers;
    private $rams;
    private $psus;
    private $cases;

    public function __construct()
    {
        $this->cpus = CPU::all();
        $this->gpus = GPU::all();
        $this->motherboards = Motherboard::all();
        $this->drives = Drive::all();
        $this->coolers = Cooler::all();
        $this->rams = RAM::all();
        $this->psus = PSU::all();
        $this->cases = PCCase::all();
    }

    public function index()
    {
        $rigs = Export_Rig::orderBy('rigname')->get();

        return view('rigs', ['rigs' => $rigs, 'filter' => ' ']);
    }

    public function filtered($sortingParam = null)
    {
        $filter = request('sortFilter');
        if (!is_null($filter)) {
            if (strcmp($filter, 'Name Z-A') == 0) {
                $rigs = Export_Rig::orderBy('rigname', 'desc')->get();
            } else if (strcmp($filter, 'Cheapest First') == 0) {
                $rigs = Export_Rig::orderBy('price')->get();
            } else if (strcmp($filter, 'Most Expensive First') == 0) {
                $rigs = Export_Rig::orderBy('price', 'desc')->get();
            } else if (strcmp($filter, 'Latest Configurations') == 0) {
                $filter = 'Latest';
                $rigs = Export_Rig::latest()->get();
            } else {
                $rigs = Export_Rig::orderBy('rigname')->get();
            }
        } else {
            $rigs = Export_Rig::orderBy('rigname')->get();
        }
        return view('rigs', ['rigs' => $rigs, 'filter' => $filter]);
    }

    public function show($id)
    {
        $rig = Export_Rig::find($id);
        if (is_null($rig)) {
            return Redirect::back();
        }
        $rig_desc = $rig->description;
        if (is_null($rig_desc)) {
            $rig_desc = "There is no description for this product!";
        }
        return view('rig-id', ['rig'=>$rig,'desc'=>$rig_desc]);
    }


    public function store()
    {
        $current_user = Auth::user();
        $price = request('price');
        $name = request('rigName');
        $cpu_id = request('cpu');
        $gpu_id = request('gpu');
        $gpu2_id = request('gpu2');
        $motherboard_id = request('motherboard');
        $drive_id = request('drive');
        $drive2_id = request('drive2');
        $cooler_id = request('cooler');
        $ram_id = request('ram');
        $psu_id = request('psu');
        $case_id = request('case');
        $desc = request('description');
        if (is_null($name) || is_null($price) || is_null($cpu_id) || is_null($gpu_id) || is_null($motherboard_id) || is_null($drive_id) || is_null($cooler_id) || is_null($ram_id) || is_null($psu_id) || is_null($case_id)) {
            $errorMessage = 'Unable to create rig!';
            return view('create-rig', ['cpus' => $this->cpus, 'gpus' => $this->gpus, 'motherboards' => $this->motherboards, 'drives' => $this->drives, 'coolers' => $this->coolers, 'rams' => $this->rams, 'psus' => $this->psus, 'cases' => $this->cases, 'error' => $errorMessage]);
        }

        if (Rig::where('name', $name)->exists()) {
            $errorMessage = 'This rig already exists!';
            return view('create-rig', ['cpus' => $this->cpus, 'gpus' => $this->gpus, 'motherboards' => $this->motherboards, 'drives' => $this->drives, 'coolers' => $this->coolers, 'rams' => $this->rams, 'psus' => $this->psus, 'cases' => $this->cases, 'error' => $errorMessage]);
        }

        if (strlen($name) >= 31) {
            $errorMessage = 'Rig Name is too long!';
            return view('create-rig', ['cpus' => $this->cpus, 'gpus' => $this->gpus, 'motherboards' => $this->motherboards, 'drives' => $this->drives, 'coolers' => $this->coolers, 'rams' => $this->rams, 'psus' => $this->psus, 'cases' => $this->cases, 'error' => $errorMessage]);
        }

        $rig = new RIG();

        $rig->name = $name;
        $rig->user_id = $current_user->id;
        $rig->price = $price;
        $rig->cpu_id = $cpu_id;
        $rig->gpu_id = $gpu_id;
        $rig->gpu2_id = $gpu2_id;
        $rig->motherboard_id = $motherboard_id;
        $rig->drive_id = $drive_id;
        $rig->drive2_id = $drive2_id;
        $rig->cooler_id = $cooler_id;
        $rig->ram_id = $ram_id;
        $rig->psu_id = $psu_id;
        $rig->case_id = $case_id;
        $rig->description = $desc;
        $rig->save();
        return redirect()->route('rigs.show',['id'=>$rig->id]);
    }

    public function update()
    {
        $id = request('id');
        $name = request('rigName');
        $price = request('price');
        $cpu_id = request('cpu');
        $gpu_id = request('gpu');
        $gpu2_id = request('gpu2');
        $motherboard_id = request('motherboard');
        $drive_id = request('drive');
        $drive2_id = request('drive2');
        $cooler_id = request('cooler');
        $ram_id = request('ram');
        $psu_id = request('psu');
        $case_id = request('case');
        $desc = request('description');
        if (is_null($id)
            || is_null($name)
            || is_null($price)
            || is_null($cpu_id)
            || is_null($gpu_id)
            || is_null($motherboard_id)
            || is_null($drive_id)
            || is_null($cooler_id)
            || is_null($ram_id)
            || is_null($psu_id)
            || is_null($case_id)) {
            $errorMessage = 'Unable to update rig!';
            return redirect()->route('rigs.edit',['id'=>$id,'error'=>$errorMessage]);
        }
        //if rig with that name exists in database
        if (Rig::where('name', $name)->exists()) {
            //check if that name belongs to the current rig
            if (RIG::find($id)->name != $name) {
                $errorMessage = 'This rig already exists!';
                return redirect()->route('rigs.edit',['id'=>$id,'error'=>$errorMessage]);
            }
        }

        if (strlen($name) >= 31) {
            $errorMessage = 'Rig Name is too long!';
            return redirect()->route('rigs.edit',['id'=>$id,'error'=>$errorMessage]);
        }

        RIG::where('id', $id)->update([
            'name' => $name,
            'price' => $price,
            'cpu_id' => $cpu_id,
            'gpu_id' => $gpu_id,
            'gpu2_id' => $gpu2_id,
            'motherboard_id' => $motherboard_id,
            'ram_id' => $ram_id,
            'cooler_id' => $cooler_id,
            'drive_id' => $drive_id,
            'drive2_id' => $drive2_id,
            'case_id' => $case_id,
            'psu_id' => $psu_id,
            'description' => $desc]);

        return redirect()->route('rigs.show',['id'=>$id]);
    }

    public function create($errorMessage = null)
    {
        return view('create-rig', ['cpus' => $this->cpus, 'gpus' => $this->gpus, 'motherboards' => $this->motherboards, 'drives' => $this->drives, 'coolers' => $this->coolers, 'rams' => $this->rams, 'psus' => $this->psus, 'cases' => $this->cases, 'error' => $errorMessage]);
    }

    public function edit($id,$errorMessage = null)
    {
        $current_user = Auth::user();
        $rig = RIG::find($id);
        if(is_null($rig)){
            return Redirect::back();
        }
        if ($rig->user_id != $current_user->id) {
            return Redirect::back()->with('alert','Trying to change another person\'s rig you cheeky mofo');
        }
        $rig_cpu = CPU::find($rig->cpu_id);
        $rig_gpu = GPU::find($rig->gpu_id);
        $rig_gpu2 = GPU::find($rig->gpu2_id);
        $rig_motherboard = Motherboard::find($rig->motherboard_id);
        $rig_ram = RAM::find($rig->ram_id);
        $rig_cooler = Cooler::find($rig->cooler_id);
        $rig_drive = Drive::find($rig->drive_id);
        $rig_drive2 = Drive::find($rig->drive2_id);
        $rig_case = PCCase::find($rig->case_id);
        $rig_psu = PSU::find($rig->psu_id);
        return view('edit-rig', [
            'rig' => $rig,
            'rig_cpu' => $rig_cpu,
            'rig_gpu' => $rig_gpu,
            'rig_gpu2' => $rig_gpu2,
            'rig_motherboard' => $rig_motherboard,
            'rig_ram' => $rig_ram,
            'rig_cooler' => $rig_cooler,
            'rig_drive' => $rig_drive,
            'rig_drive2' => $rig_drive2,
            'rig_case' => $rig_case,
            'rig_psu' => $rig_psu,
            'cpus' => $this->cpus,
            'gpus' => $this->gpus,
            'motherboards' => $this->motherboards,
            'drives' => $this->drives,
            'coolers' => $this->coolers,
            'rams' => $this->rams,
            'psus' => $this->psus,
            'cases' => $this->cases,
            'error' => $errorMessage]);
    }
    public function destroyRig()
    {
        $current_user = Auth::user();
        $id = request('deletedRig');
        $rig = RIG::find($id);
        if ($rig->user_id == $current_user->id) {
            $rig->delete();
        }

        return Redirect::back();
    }
}
