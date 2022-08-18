<?php

namespace App\Http\Controllers;

use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FpdfReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function report(Request $request){

        $patient = DB::select("SELECT * FROM patients WHERE id = $request->id");


        $pdf = new Fpdf('P','mm','Letter');
        $pdf->SetMargins(25,20,25,20);
        $pdf->AddPage();
        $pdf->Ln(15);
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(167, 8, utf8_decode('HOSPITAL INFANTIL'), 0, 1, 'C');
        $pdf->Image('img/logo.jpg', 10, 10, 35, 28);
        $pdf->Ln(5);
        $pdf->Cell(167, 8, utf8_decode('INFORMACIÓN GENERAL'), 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
        $pdf->SetFillColor(31, 97, 175);
        $pdf->SetDrawColor(255,255,255);  // Establece el color dentro del cell
        $pdf->Cell(167,8,utf8_decode('DATOS DEL PACIENTE'),1,1,'C',True);
        $pdf->SetDrawColor(112,106,106); // Establece el color de borde del cell
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('NOMBRE: '));
        $pdf->SetFont('Arial');
        $pdf->Multicell(102, 8, utf8_decode($patient[0]->full_name),0, 1);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('EDAD: '),0);
        $pdf->SetFont('Arial');
        $pdf->Multicell(102, 8, utf8_decode($patient[0]->age), 0, 1);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('SEXO: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Cell(102, 8, utf8_decode($patient[0]->sex), 0, 1);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('FECHA DE NACIMIENTO: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Cell(102, 8, utf8_decode($patient[0]->birth_date), 0, 1);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('CIUDAD DE ORIGEN: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Multicell(102, 8, utf8_decode($patient[0]->origin_city), 0, 1);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('FECHA DE INSCRIPCIÓN: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Cell(102, 8, utf8_decode($patient[0]->inscription_date), 0, 1);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('HOSPITAL DE ORIGEN: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Multicell(102, 8, utf8_decode($patient[0]->origin_hospital), 0, 1);
        $pdf->Ln(10);
        $pdf->SetTextColor(255,255,255);  // Establece el color del texto (en este caso es blanco)
        $pdf->SetFillColor(112, 106, 106);
        $pdf->SetFont('Arial', 'B', 15);
        $pdf->Cell(167,8,utf8_decode('DATOS DEL TUTOR'),1,1,'C',True);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('NOMBRE: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Multicell(102, 8, utf8_decode($patient[0]->tutor), 0, 2);
        $pdf->SetFont('Arial', 'B', 14);
        $pdf->Cell(65, 8, utf8_decode('NÚMERO: '), 0);
        $pdf->SetFont('Arial');
        $pdf->Cell(102, 8, utf8_decode($patient[0]->tutor_telephone), 0, 0);
        $pdf->Ln(30);
        $pdf->Output('',"Paciente-" . $patient[0]->full_name);
        exit();
    }
}
