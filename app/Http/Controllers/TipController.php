<?php

namespace App\Http\Controllers;

use App\Http\Resources\TipResurs;
use App\Models\Tip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipController extends BaseController
{
    public function index()
    {
        $sve = Tip::all();
        return $this->potvrda(TipResurs::collection($sve), 'Vraceni su svi tipovi iz baze.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nazivTipa' => 'required',
        ]);
        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $tip = Tip::create($input);

        return $this->potvrda(new TipResurs($tip), 'Novi tip je dodat u bazu.');
    }


    public function show($id)
    {
        $tip = Tip::find($id);
        if (is_null($tip)) {
            return $this->greska('Tip sa zadatim ID-em ne postoji u bazi.');
        }
        return $this->potvrda(new TipResurs($tip), 'Tip sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $tip = Tip::find($id);
        if (is_null($tip)) {
            return $this->greska('Tip sa zadatim id-em ne postoji u bazi.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nazivTipa' => 'required',
        ]);

        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $tip->nazivTipa = $input['nazivTipa'];
        $tip->save();

        return $this->potvrda(new TipResurs($tip), 'Izabrani tip je izmenjen.');
    }

    public function destroy($id)
    {
        $tip = Tip::find($id);
        if (is_null($tip)) {
            return $this->greska('Tip sa zadatim id-em ne postoji u bazi.');
        }

        $tip->delete();
        return $this->potvrda([], 'Tip je obrisan iz baze.');
    }
}
