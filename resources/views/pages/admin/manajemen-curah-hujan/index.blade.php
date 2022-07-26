@extends('layouts.admin')

@section('title', 'Manajemen Curah Hujan')

@section('menu_admin_manajemen_curah_hujan_active', 'active')

@section('header', 'Manajemen Curah Hujan')

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
    <li class="breadcrumb-item text-dark">Manajemen Curah Hujan</li>
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
                                                        <th class="min-w-100px text-center">Actions</th>
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
                                                                <td class="text-end">
                                                                    <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_curah_hujan" onclick="setDataUpdateCurahHujan({{$curahHujan->id}},{{$curahHujan->tanggal}},{{$curahHujan->curah_hujan}})">
                                                                        <span class="svg-icon svg-icon-3">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                                                <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                                                            </svg>
                                                                        </span>
                                                                    </button>
                                                                </td>
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

        <!--begin::Modal - Update permissions-->
        <div class="modal fade" id="kt_modal_update_curah_hujan" tabindex="-1" aria-hidden="true">
            <!--begin::Modal dialog-->
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <!--begin::Modal content-->
                <div class="modal-content">
                    <!--begin::Modal header-->
                    <div class="modal-header">
                        <!--begin::Modal title-->
                        <h2 class="fw-bolder">Update Curah Hujan</h2>
                        <!--end::Modal title-->
                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Close-->
                    </div>
                    <!--end::Modal header-->
                    <!--begin::Modal body-->
                    <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                        <!--begin::Form-->
                        <form id="kt_modal_update_curah_hujan_form" method="POST" class="form" action="{{url('/admin/manajemen-curah-hujan/update')}}">
                            @csrf
                            <input type="hidden" id="update_curah_hujan_id" name="id" />
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mb-2">
                                    <span class="required">Tanggal</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true"></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" id="update_curah_hujan_tanggal" name="tanggal" disabled/>
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="fs-6 fw-bold form-label mb-2">
                                    <span class="required">Curah Hujan</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="curah hujan is required."></i>
                                </label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" type="number" placeholder="Enter the curah hujan" id="update_curah_hujan_curah_hujan" name="curah_hujan" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Actions-->
                            <div class="text-center pt-15">
                                <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">Discard</button>
                                <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Modal body-->
                </div>
                <!--end::Modal content-->
            </div>
            <!--end::Modal dialog-->
        </div>
        <!--end::Modal - Update permissions-->

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
                    axios.post('{{ url("/admin/manajemen-curah-hujan/get-data") }}', {
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
                            var cell3 = row.insertCell(2);

                            
                            cell1.className += "text-center";
                            cell2.className += "text-center";
                            cell3.className += "text-center";
    
                            // Add some text to the new cells:
                            cell1.innerHTML = element.tanggal;
                            cell2.innerHTML = element.curah_hujan == 0 ? '-' : element.curah_hujan;
                            cell3.innerHTML = `
                                                <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_curah_hujan" onclick="setDataUpdateCurahHujan(${element.id},${element.tanggal},${element.curah_hujan})">
                                                    <span class="svg-icon svg-icon-3">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="black" />
                                                            <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="black" />
                                                        </svg>
                                                    </span>
                                                </button>
                            `;
                        });
                        
                    });
                }

            });
        });

        

    function setDataUpdateCurahHujan(id, tanggal, curah_hujan){
        document.getElementById('update_curah_hujan_id').value = id;
        document.getElementById('update_curah_hujan_tanggal').value = tanggal;
        document.getElementById('update_curah_hujan_curah_hujan').value = curah_hujan;
    }

    var KTUsersUpdatePermission = function () {
        // Shared variables
        const element = document.getElementById('kt_modal_update_curah_hujan');
        const form = element.querySelector('#kt_modal_update_curah_hujan_form');
        const modal = new bootstrap.Modal(element);

        // Init add schedule modal
        var initUpdatePermission = () => {

            // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
            var validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'curah_hujan': {
                            validators: {
                                notEmpty: {
                                    message: 'curah hujan is required'
                                }
                            }
                        }
                    },

                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: '.fv-row',
                            eleInvalidClass: '',
                            eleValidClass: ''
                        })
                    }
                }
            );

            // Close button handler
            const closeButton = element.querySelector('[data-kt-permissions-modal-action="close"]');
            closeButton.addEventListener('click', e => {
                e.preventDefault();
                
                form.reset(); // Reset form	
                modal.hide(); // Hide modal				
            });

            // Cancel button handler
            const cancelButton = element.querySelector('[data-kt-permissions-modal-action="cancel"]');
            cancelButton.addEventListener('click', e => {
                e.preventDefault();
                
                form.reset(); // Reset form	
                modal.hide(); // Hide modal		
            });

            // Submit button handler
            const submitButton = element.querySelector('[data-kt-permissions-modal-action="submit"]');
            submitButton.addEventListener('click', function (e) {
                // Prevent default button action
                e.preventDefault();

                // Validate form before submit
                if (validator) {
                    validator.validate().then(function (status) {
                        console.log('validated!');

                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;

                            // const onlyInputs = document.querySelectorAll('#kt_modal_update_curah_hujan_form input');

                            // onlyInputs.forEach(input => {
                            //     if(input.name == '_token') _token = input.value;
                            // });

                            // formData = {
                            //             id: document.getElementById('update_curah_hujan_id').value,
                            //             _token: _token,
                            //             curah_hujan: document.getElementById('update_curah_hujan_curah_hujan').value                               
                            // };

                            // try {
                            //     (async() => {
                            //         const resp = await axios({
                            //             method: 'POST',
                            //             url: "{{url('/admin/manajemen-curah-hujan/update')}}",
                            //             data: formData
                            //         });

                            //         console.log(resp.data);
                            //     });

                            // } catch (err) {
                            //     // Handle Error Here
                            //     console.error(err);
                            // }

                            
                            // console.log(document.getElementById('kt_modal_update_curah_hujan_form'));
                            document.getElementById('kt_modal_update_curah_hujan_form').submit()
                        } else {
                            // Show popup warning. For more info check the plugin's official documentation: https://sweetalert2.github.io/
                            Swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            });
                        }
                    });
                }
            });
        }

        return {
            // Public functions
            init: function () {
                initUpdatePermission();
            }
        };
    }();

    // On document ready
    KTUtil.onDOMContentLoaded(function () {
        KTUsersUpdatePermission.init();
    });

    </script>
@endpush