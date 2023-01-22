<?php

namespace App\Http\Controllers;

use App\Http\Resources\SpravaResurs;
use App\Models\Sprava;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SpravaController extends BaseController
{
    public function index()
    {
        $sve = Sprava::all();
        return $this->potvrda(SpravaResurs::collection($sve), 'Vracene su sve sprave iz baze.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'tipID' => 'required',
            'model' => 'required',
            'proizvodjacID' => 'required',
            'cena' => 'required'
        ]);
        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $sprava = Sprava::create($input);

        return $this->potvrda(new SpravaResurs($sprava), 'Nova sprava je dodata u bazu.');
    }


    public function show($id)
    {
        $sprava = Sprava::find($id);
        if (is_null($sprava)) {
            return $this->greska('Sprava sa zadatim id-em ne postoji u bazi.');
        }
        return $this->potvrda(new SpravaResurs($sprava), 'Sprava sa zadatim id-em je vracena.');
    }


    public function update(Request $request, $id)
    {
        $sprava = Sprava::find($id);
        if (is_null($sprava)) {
            return $this->greska('Sprava sa zadatim id-em ne postoji u bazi.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'tipID' => 'required',
            'model' => 'required',
            'proizvodjacID' => 'required',
            'cena' => 'required'
        ]);

        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $sprava->tipID = $input['tipID'];
        $sprava->model = $input['model'];
        $sprava->proizvodjacID = $input['proizvodjacID'];
        $sprava->cena = $input['cena'];
        $sprava->save();

        return $this->potvrda(new SpravaResurs($sprava), 'Izabrana sprava je izmenjena.');
    }

    public function destroy($id)
    {
        $sprava = Sprava::find($id);
        if (is_null($sprava)) {
            return $this->greska('Sprava sa zadatim id-em ne postoji u bazi');
        }

        $sprava->delete();
        return $this->potvrda([], 'Sprava je obrisana iz baze.');
    }
}
