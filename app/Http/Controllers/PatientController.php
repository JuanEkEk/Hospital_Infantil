<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return $patient = Patient::all();
        return $patient = DB::select('SELECT * FROM patients ORDER BY id ASC');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // Validation
        $request->validate(
        [
            'full_name' => 'required',
            'age' => ['required','integer'],
            'sex' => 'required',
            'birth_date' => 'required',
            'inscription_date' => 'required',
            'origin_city' => 'required',
            'origin_hospital' => 'required',
            'tutor' => 'required',
            'tutor_telephone' => ['required','integer','digits:10'],
        ],
        [
            'full_name.required' => 'Este campo es obligatorio',
            'age.required' => 'Este campo es obligatorio',
            'age.integer' => 'Número inválido',
            'sex.required' => 'Este campo es obligatorio',
            'birth_date.required' => 'Este campo es obligatorio',
            'inscription_date.required' => 'Este campo es obligatorio',
            'origin_city.required' => 'Este campo es obligatorio',
            'origin_hospital.required' => 'Este campo es obligatorio',
            'tutor.required' => 'Este campo es obligatorio',
            'tutor_telephone.required' => 'Este campo es obligatorio',
            'tutor_telephone.integer' => 'Verifique el número de teléfono',
            'tutor_telephone.digits'=> 'El número de teléfono deben ser 10 dígitos'
        ]);

        $patient = new Patient();

        $patient->full_name = $request->get('full_name');
        $patient->age = $request->get('age');
        $patient->sex = $request->get('sex');
        $patient->birth_date = $request->get('birth_date');
        $patient->inscription_date = $request->get('inscription_date');
        $patient->origin_city = $request->get('origin_city');
        $patient->origin_hospital = $request->get('origin_hospital');
        $patient->tutor = $request->get('tutor');
        $patient->tutor_telephone = $request->get('tutor_telephone');
        $patient->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $patient = Patient::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        // Validation
        $request->validate(
        [
            'full_name' => 'required',
            'age' => ['required','integer'],
            'sex' => 'required',
            'birth_date' => 'required',
            'inscription_date' => 'required',
            'origin_city' => 'required',
            'origin_hospital' => 'required',
            'tutor' => 'required',
            'tutor_telephone' => ['required','integer','digits:10'],
        ],
        [
            'full_name.required' => 'Este campo es obligatorio',
            'age.required' => 'Este campo es obligatorio',
            'age.integer' => 'Número inválido',
            'sex.required' => 'Este campo es obligatorio',
            'birth_date.required' => 'Este campo es obligatorio',
            'inscription_date.required' => 'Este campo es obligatorio',
            'origin_city.required' => 'Este campo es obligatorio',
            'origin_hospital.required' => 'Este campo es obligatorio',
            'tutor.required' => 'Este campo es obligatorio',
            'tutor_telephone.required' => 'Este campo es obligatorio',
            'tutor_telephone.integer' => 'Verifique el número de teléfono',
            'tutor_telephone.digits'=> 'El número de teléfono deben ser 10 dígitos'
            ]);
        $patient = Patient::find($id);

        $patient->full_name = $request->get('full_name');
        $patient->age = $request->get('age');
        $patient->sex = $request->get('sex');
        $patient->birth_date = $request->get('birth_date');
        $patient->inscription_date = $request->get('inscription_date');
        $patient->origin_city = $request->get('origin_city');
        $patient->origin_hospital = $request->get('origin_hospital');
        $patient->tutor = $request->get('tutor');
        $patient->tutor_telephone = $request->get('tutor_telephone');

        $patient->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $patient = Patient::destroy($id);
    }
}
