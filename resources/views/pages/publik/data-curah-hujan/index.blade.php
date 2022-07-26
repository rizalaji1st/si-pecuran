@extends('layouts.admin')

@section('title', 'Data Curah Hujan')

@section('menu_publik_data_curah_hujan_active', 'active')

@section('header', 'Data Curah Hujan')

@section('breadcrumb') 
<!--begin::Breadcrumb-->
<ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-muted">
        <a href="{{url('/')}}" class="text-muted text-hover-primary">Home</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-200 w-5px h-2px"></span>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-dark">Data Curah Hujan</li>
    <!--end::Item-->
</ul>
<!--end::Breadcrumb-->
@endsection

@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Search vertical-->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Aside-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-250px w-xxl-325px mb-8 mb-lg-0 me-lg-9 me-5">
                    <!--begin::Form-->
                    <form action="#">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Wilayah</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid" id="search_wilayah" name="wilayah" data-control="select2" data-placeholder="Select wilayah" data-hide-search="true">
                                        <option value=""></option>
                                        @foreach ($wilayahs as $wilayah)
                                            <option value="{{$wilayah->id}}" {{$data ? ($data['curah_hujans'][0]->wilayahs_id == $wilayah->id ? "selected": "") : ""}}>({{$wilayah->kode}}) {{$wilayah->name}}</option>
                                        @endforeach
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Tahun</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid" id="search_tahun" name="tahun" data-control="select2" data-placeholder="Select tahun" data-hide-search="true">
                                        <option value=""></option>
                                        @for ($i = now()->year; $i >= 2015; $i--)
                                            <option value="{{$i}}" {{$data ? ($data['curah_hujans'][0]->tahun == $i ? "selected": "") : ""}}>{{$i}}</option>
                                        @endfor
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Input group-->
                                <div class="mb-5">
                                    <label class="fs-6 form-label fw-bolder text-dark">Bulan</label>
                                    <!--begin::Select-->
                                    <select class="form-select form-select-solid" id="search_bulan" name="bulan" data-control="select2" data-placeholder="Select bulan" data-hide-search="true">
                                        <option value=""></option>
                                        <option value="1" {{$data ? ($data['curah_hujans'][0]->bulan == 1 ? "selected": "") : ""}}>Januari</option>
                                        <option value="2" {{$data ? ($data['curah_hujans'][0]->bulan == 2 ? "selected": "") : ""}} >Februari</option>
                                        <option value="3" {{$data ? ($data['curah_hujans'][0]->bulan == 3 ? "selected": "") : ""}} >Maret</option>
                                        <option value="4" {{$data ? ($data['curah_hujans'][0]->bulan == 4 ? "selected": "") : ""}} >April</option>
                                        <option value="5" {{$data ? ($data['curah_hujans'][0]->bulan == 5 ? "selected": "") : ""}} >Mei</option>
                                        <option value="6" {{$data ? ($data['curah_hujans'][0]->bulan == 6 ? "selected": "") : ""}} >Juni</option>
                                        <option value="7" {{$data ? ($data['curah_hujans'][0]->bulan == 7 ? "selected": "") : ""}} >Juli</option>
                                        <option value="8" {{$data ? ($data['curah_hujans'][0]->bulan == 8 ? "selected": "") : ""}} >Agustus</option>
                                        <option value="9" {{$data ? ($data['curah_hujans'][0]->bulan == 9 ? "selected": "") : ""}} >September</option>
                                        <option value="10" {{$data ? ($data['curah_hujans'][0]->bulan == 10 ? "selected": "") : ""}} >Oktober</option>
                                        <option value="11" {{$data ? ($data['curah_hujans'][0]->bulan == 11 ? "selected": "") : ""}} >November</option>
                                        <option value="12" {{$data ? ($data['curah_hujans'][0]->bulan == 12 ? "selected": "") : ""}} >Desember</option>
                                    </select>
                                    <!--end::Select-->
                                </div>
                                <!--end::Input group-->
                                <!--begin::Action-->
                                <div class="d-flex align-items-center justify-content-end">
                                    <a id="button_lihat_data" class="btn btn-primary">Lihat</a>
                                </div>
                                <!--end::Action-->
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Card-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Aside-->
                <!--begin::Layout-->
                <div class="flex-lg-row-fluid">
                    <!--begin::Tab Content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                            <!--begin::Row-->
                            <div class="row g-6 g-xl-9">
                                <!--begin::Container-->
                                <div id="kt_content_container" class="container-xxl">
                                    <!--begin::Card-->
                                    <div class="card card-flush">
                                        <!--begin::Card header-->
                                        <div class="card-header mt-6">
                                            <div class="d-flex flex-wrap">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="0" id="data_jumlah">{{$data ? $data['jumlah'] : 0}}</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Jumlah</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <!--end::Svg Icon-->
                                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="0" id="data_hari_hujan">{{$data ? $data['hari_hujan'] : 0}}</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Hari Hujan</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="0" id="data_rata_rata">{{$data ? $data['rata_rata'] : 0}}</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Rata-rata</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="0" id="data_terbesar">{{$data ? $data['terbesar'] : 0}}</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Terbesar</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                    <!--begin::Number-->
                                                    <div class="d-flex align-items-center">
                                                        <div class="fs-2 fw-bolder counted" data-kt-countup="true" data-kt-countup-value="0" id="data_terkecil">{{$data ? ($data['terkecil'] ? $data['terkecil']  : 0) : 0}}</div>
                                                    </div>
                                                    <!--end::Number-->
                                                    <!--begin::Label-->
                                                    <div class="fw-bold fs-6 text-gray-400">Terkecil</div>
                                                    <!--end::Label-->
                                                </div>
                                                <!--end::Stat-->
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed my-8"></div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_curah_hujans_table">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="min-w-125px text-center">Tanggal</th>
                                                        <th class="min-w-125px text-center">Curah Hujan (mm)</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bold text-gray-600">
                                                    @if ($data)
                                                        @foreach ($data['curah_hujans'] as $curahHujan)
                                                            <tr>
                                                                <td class="text-center">{{$curahHujan->tanggal}}</td>
                                                                <td class="text-center">{{$curahHujan->curah_hujan == 0 ? "-" : $curahHujan->curah_hujan}}</td>
                                                            </tr>
                                                        @endforeach
                                                        
                                                    @endif
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Card-->
                                </div>
                                <!--end::Container-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab Content-->
                </div>
                <!--end::Layout-->
            </div>
            <!--begin::Search vertical-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection


@push('style_stack')
    
@endpush

@push('script_stack')
    <script>
        // Lihat button handler
        document.addEventListener("DOMContentLoaded", function(event) {
            const lihatButton = document.getElementById('button_lihat_data');
            lihatButton.addEventListener('click', e => {
                e.preventDefault();
                var wilayahs_id = document.getElementById('search_wilayah').value;
                var tahun = document.getElementById('search_tahun').value;
                var bulan = document.getElementById('search_bulan').value;
                
                if (!(wilayahs_id && tahun && bulan)) {
                    Swal.fire({
                        text: "Sorry, looks like there are some empty box, please fill up the form.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
                else{
                    axios.post('{{ url("/publik/data-curah-hujan/get-data") }}', {
                        wilayahs_id: wilayahs_id,
                        tahun: tahun,
                        bulan: bulan
                    })
                    .then(function (response) {
                        console.log(response.data);
                        
                        document.getElementById("data_jumlah").innerHTML = response.data.jumlah;
                        document.getElementById("data_hari_hujan").innerHTML = response.data.hari_hujan;
                        document.getElementById("data_rata_rata").innerHTML = response.data.rata_rata;
                        document.getElementById("data_terbesar").innerHTML = response.data.terbesar;
                        document.getElementById("data_terkecil").innerHTML = (response.data.terkecil? response.data.terkecil : 0);
                        
                        // // Find a <table> element with id="myTable":
                        var table = document.getElementById("kt_curah_hujans_table").getElementsByTagName('tbody')[0];;
                        table.innerHTML = '';
                        
                        response.data.curah_hujans.forEach((element, index) => {
                            // Create an empty <tr> element and add it to the index position of the table:
                            var row = table.insertRow(index);
                            
                            // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
                            var cell1 = row.insertCell(0);
                            var cell2 = row.insertCell(1);
                            
                            cell1.className += "text-center";
                            cell2.className += "text-center";
    
                            // Add some text to the new cells:
                            cell1.innerHTML = element.tanggal;
                            cell2.innerHTML = element.curah_hujan == 0 ? '-' : element.curah_hujan;
                        });
                        
                    });
                }

            });
        });
    </script>
@endpush