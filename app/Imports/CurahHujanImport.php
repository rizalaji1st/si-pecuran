<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use App\Models\CurahHujanImport as CurahHujanImportModel;

class CurahHujanImport implements ToCollection, SkipsEmptyRows, WithHeadingRow, WithValidation
{
    protected $wilayahId;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(int $wilayahId)
    {
        $this->wilayahId = $wilayahId;
    }

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $curahHujan) {
            try {
                $tanggal = is_numeric($curahHujan['tanggal'])  ? Carbon::parse(Date::excelToDateTimeObject($curahHujan['tanggal'])) : Carbon::createFromFormat('d/m/Y',$curahHujan['tanggal']);
                CurahHujanImportModel::create([
                    'wilayahs_id' => $this->wilayahId,
                    'curah_hujan' => (double)$curahHujan['curah_hujan'],
                    'tanggal' => $tanggal,
                    'status' => 'valid'
                ]);
            } catch (\Throwable $th) {
                CurahHujanImportModel::create([
                    'wilayahs_id' => $this->wilayahId,
                    'curah_hujan' => (double)$curahHujan['curah_hujan'],
                    'tanggal' => $curahHujan['tanggal'],
                    'status' => 'tidak valid'
                ]);
            }
        }
        return $collection;
    }

    public function rules(): array
    {
        return [
            'tanggal' => ['required'],
            'curah_hujan' => ['required'],
        ];
    }
}
