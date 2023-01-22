<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProizvodjacResurs;
use App\Models\Proizvodjac;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProizvodjacController extends BaseController
{
    public function index()
    {
        $svi = Proizvodjac::all();
        return $this->potvrda(ProizvodjacResurs::collection($svi), 'Vraceni su svi proizvodjaci iz baze.');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'nazivProizvodjaca' => 'required',
        ]);
        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $proizvodjac = Proizvodjac::create($input);

        return $this->potvrda(new ProizvodjacResurs($proizvodjac), 'Novi proizvodjac je dodat u bazu.');
    }


    public function show($id)
    {
        $Proizvodjac = Proizvodjac::find($id);
        if (is_null($Proizvodjac)) {
            return $this->greska('Proizvodjac sa zadatim id-em ne postoji.');
        }
        return $this->potvrda(new ProizvodjacResurs($Proizvodjac), 'Proizvodjac sa zadatim id-em je vracen.');
    }


    public function update(Request $request, $id)
    {
        $proizvodjac = Proizvodjac::find($id);
        if (is_null($proizvodjac)) {
            return $this->greska('Proizvodjac sa zadatim id-em ne postoji u bazi.');
        }

        $input = $request->all();

        $validator = Validator::make($input, [
            'nazivProizvodjaca' => 'required',
        ]);

        if($validator->fails()){
            return $this->greska($validator->errors());
        }

        $proizvodjac->nazivProizvodjaca = $input['nazivProizvodjaca'];
        $proizvodjac->save();

        return $this->potvrda(new ProizvodjacResurs($proizvodjac), 'Izabrani proizvodjac je izmennjen.');
    }

    public function destroy($id)
    {
        $proizvodjac = Proizvodjac::find($id);
        if (is_null($proizvodjac)) {
            return $this->greska('Proizvodjac sa zadatim id-em ne postoji u bazi.');
        }
        $proizvodjac->delete();
        return $this->potvrda([], 'Proizvodjac je obrisan iz baze.');
    }
}
