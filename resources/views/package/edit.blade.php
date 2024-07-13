@extends('layouts.main')

@push('style')
<link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet" />
<link
    href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
    rel="stylesheet"
/>
@endpush

@section('content')

    <div class="main-content">
       <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column">
            <h3>Edit Paket ({{ $package->name }})</h3>
            <span class="blue-text">Lengkapi form-form dibawah dengan benar dan detail, form dengan tanda * merupakan form yang wajib. Jika belum ada decoration yang dipilih paket tidak akan ditampilkan pada halaman Customer.</span>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11 text-center">
                <div class="card px-4 py-4">
                    @if (session('status'))
                   <div class="alert {{ session('status')['status'] }}" role="alert">
                    {{ session('status')['message'] }}
                  </div>
                  @endif
                    <h5 class="text-center mb-4">Powering world-class companies</h5>
                    <form class="form-card" action="/package/{{ $package->uuid }}/edit" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-between text-left mb-sm-4">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                    class="form-label px-3">Nama Paket<span class="text-danger"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control"
                                    placeholder="Paket Super" value="{{ old('name' , $package->name) }}"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                    class="form-label px-3">Harga<span class="text-danger"> *</span></label>
                                <input type="text" id="price" name="price" class="form-control"
                                    placeholder="150.000" value="{{ old('price' , $package->price->price) }}"> </div>
                        </div>
                        <div class="row justify-content-between text-left mb-sm-4">
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                    class="form-label px-3">Diskon</label> <input type="number" id="discount" name="discount" class="form-control"
                                    placeholder="" value="{{ old('discount' , $package->price->discount) }}"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                class="form-label px-3">Stok</label> <input type="number" id="stock" name="stock" class="form-control"
                                placeholder="" value="{{ old('stock' , $package->stock) }}"> </div>
                            <div class="form-group col-sm-6 flex-column d-flex"> <label
                                    class="form-label px-3">Dekorasi</label> 
                                    <select name="decoration[]" class="form-select" multiple>
                                        <option value="0" disabled class="font-italic">Tekan ctrl + click untuk memilih *</option>
                                        @foreach ($decorations as $decoration)
                                            <option value="{{ $decoration->id }}"
                                                @if (in_array($decoration->id, array_column($package->decoration->toArray(), 'id')))
                                                    selected
                                                @endif       
                                            >{{ $decoration->name }}</option>
                                        @endforeach
                                    </select>  
                                </div>
                        </div>
                      
                        <input type="hidden" name="catalog_meta_data" value="{{ $catalogMetaData }}" readonly required class="d-none">
                       
                        <div class="row justify-content-end">
                            <div class="form-group col-sm-12"> <button type="submit"
                                    class="btn btn-block btn-primary">Simpan</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{ $package->catalog }}
        {{-- http:\/\/ta-wedding-decoration.test\/storage\/tmp\/u6ec01cN7A9JQKfwQ3VBPY4ui0gojZtjU6d88HhV.jpg --}}
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        <script src="https://unpkg.com/filepond-plugin-file-metadata/dist/filepond-plugin-file-metadata.js"></script>
        <script src="https://unpkg.com/filepond/dist/filepond.js"></script>

             <script>
                 const reOrderAction = (files, origin, target) => {
                    let order = []
                    files.forEach((element, index) => {
                        order.push({
                            order: index,
                            serverId: element.serverId
                        })
                    })

                    console.log(order)

                    $.ajax({
                        url: "http://ta-wedding-decoration.test/reorder/" + {{ $catalogMetaData }},
                        headers: {
                            'X-CSRF-TOKEN': "{{  csrf_token() }}"
                        },
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            order: JSON.stringify(order),
                        },

                        success: function(data) {
                         console.log(data)
                        },
                        error: function(error) {
                            
                            console.log(error);
                        }
                    });
             }

            //filepond
              FilePond.registerPlugin(FilePondPluginImagePreview);
              FilePond.registerPlugin(FilePondPluginFileMetadata);
             var element = document.querySelector('meta[name="csrf-token"]');
             var csrf = element && element.getAttribute("content");
            
             const inputElement = document.querySelector('input[name="image"]');
             const pond = FilePond.create(inputElement,{
                    files: [
                        {
                            source: 'C:\\laragon\\www\\ta-wedding-decoration\\public\\storage\/tmp\/u6ec01cN7A9JQKfwQ3VBPY4ui0gojZtjU6d88HhV.jpg',
                            options: {
                                type: 'local',

                                // mock file information
                              /*   file: {
                                    name: 'juku.png',
                                } */
                            }
                        }
                    ]
                });
          
             </script>

       </section>
    </div>
    
@endsection

@push('scripts')
<!-- include FilePond library -->
<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<!-- include FilePond plugins -->
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.js"></script>

<!-- include FilePond jQuery adapter -->
<script src="https://unpkg.com/jquery-filepond/filepond.jquery.js"></script>
@endpush