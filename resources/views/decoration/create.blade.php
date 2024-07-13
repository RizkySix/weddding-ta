@extends('layouts.main')

@push('style')
<style>
  @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap');

body {
  font-family: 'Manrope', sans-serif;
  background:#eee;
}

.size span {
  font-size: 11px;
}

.color span {
  font-size: 11px;
}

.product-deta {
  margin-right: 70px;
}

.gift-card:focus {
  box-shadow: none;
}

.pay-button {
  color: #fff;
}

.pay-button:hover {
  color: #fff;
}

.pay-button:focus {
  color: #fff;
  box-shadow: none;
}

.text-grey {
  color: #a39f9f;
}

.qty i {
  font-size: 11px;
}
</style>
@endpush

@section('content')


    <div class="main-content">
      <section class="section">
        <div class="section-header" style="display: flex; flex-direction: column">
            <h3>Tambahkan Dekorasi</h3>
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
                    <form class="form-card" action="/decoration/create" method="POST">
                        @csrf
                        <div class="row justify-content-between text-left mb-sm-4">
                            <div class="form-group col-sm-12 flex-column d-flex mb-sm-4"> <label
                                    class="form-label text-center px-3">Nama
                                    Dekorasi<span class="text-danger"> *</span></label>
                                <input type="text" id="name" name="name" class="form-control"
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
                                <textarea name="detail" id="summernote" name="editordata"></textarea>
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
