@extends('layouts.main')

@section('content')


    <div class="main-content">
      <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column">
            <h3>Edit Dekorasi ({{ $decoration->name }})</h3>
            <p class="blue-text">Lengkapi form-form dibawah dengan benar dan detail, form dengan tanda * merupakan
                form yang wajib.</p>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-xl-7 col-lg-8 col-md-9 col-11">
                <div class="card px-4 py-4">
                   @if (session('status'))
                   <div class="alert {{ session('status')['status'] }}" role="alert">
                    {{ session('status')['message'] }}
                  </div>
                   @endif
                    <h5 class="text-center mb-4">Powering world-class companies</h5>
                    <form class="form-card" action="/decoration/{{ $decoration->uuid }}/edit" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row justify-content-between text-left mb-sm-4">
                            <div class="form-group col-sm-12 flex-column d-flex mb-sm-4"> <label
                                    class="form-label text-center px-3">Nama
                                    Dekorasi<span class="text-danger"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ old('name' , $decoration->name) }}"
                                    placeholder="Dekorasi Awx">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                            </div>
                            <div class="form-group col-sm-12 flex-column d-flex"> <label
                                    class="form-label text-center px-3">Detail Dekorasi<span class="text-danger">
                                        *</span></label>
                                <textarea name="detail" id="summernote" name="editordata">
                                    {!! $decoration->detail !!}
                                </textarea>
                            </div>
                        </div>

                        <div class="row justify-content-end mt-4">
                            <div class="form-group col-sm-12"> <button type="submit"
                                    class="btn btn-block btn-primary">Simpan</button> </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Decoration nikahan nona manis',
                tabsize: 2,
                height: 120,
                lang: 'id',
                toolbar: [
                    ['font', ['bold', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link']],
                    ['view', ['codeview', 'help']]
                ]
            });
        });
    </script>
@endsection
