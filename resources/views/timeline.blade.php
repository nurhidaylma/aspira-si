@extends('templates/template')

@include('templates.navbar')

@section('title','Feed')

@section('container')
    <section class="container  mt-5">
        <div class="row mb-4">
            <div class="col-12">
                <form action="" class="text-right">
                    <select name="" id="sortByOption" class="btn-sm btn btn-primary">
                        <option value="" disabled selected>Sort By</option>
                        <option value="terbaru">
                            Terbaru
                        </option>
                        <option value="teratas">
                            Teratas
                        </option>
                    </select>
                </form>
            </div>
        </div>
        @foreach($aspirasi as $asp)
            <div class="row justify-content-center mb-4">
                <div class="col-12">
                    <div class="card aspiration-card">
                        <div class="card-header aspiration-card-header">
                            <div class="row">
                                <div class="col-9">
                                    <h3>{{$asp->judul_aspirasi}}</h3>
                                    <span class="span-time">Posted on September, {{$asp -> created_at}}</span>
                                </div>
                                <div class="col-3 text-right">
                                    <button class="btn btn-sm btn-outline-danger"><img
                                            src="{{'assets/icon/hand-thumbs-down.svg'}}" class="img-icon" alt=""><span
                                            onclick="addDisLikes({{session(0)->id_mahasiswa}},{{$asp->id_aspirasi}})"
                                            id="totalDisLikes{{$asp->id_aspirasi}}">{{$asp -> downvote}}</span>
                                    </button>
                                    <button class="btn btn-sm btn-primary"><img
                                            src="{{'assets/icon/hand-thumbs-up.svg'}}" class="img-icon" alt=""><span
                                            onclick="addLikes({{session(0)->id_mahasiswa}},{{$asp->id_aspirasi}})"
                                            id="totalLikes{{$asp->id_aspirasi}}">{{$asp -> upvote}}</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body aspiration-card-body">
                            <div class="aspiration-card-body-content">
                                <div class="row mb-4">
                                    <div class="col-1 col">
                                        <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
                                             style="width: 50px">
                                    </div>
                                    <div class="col-11 col">
                            <span class="span-asal usernamePengirim">
                                {{$asp -> username}}
                            </span>
                                        <br>
                                        <span class="span-tujuan">
                                Kepada: {{$asp -> nama_entitas}}
                            </span>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-10">
                                        <p>
                                            {{$asp -> aspirasi_text}}
                                        </p>
                                    </div>
                                    <div class="col-10">
                                        @if(isset($asp->file_name))
                                            <a href="" class="btn btn-outline-info"
                                               data-target="#modalFile{{$asp->id_aspirasi}}" data-toggle="modal">File
                                                Pendukung</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer aspiration-card-footer">
                            <div class="row">
                                <div class="col-1 col">
                                    <img alt="" class="img-thumbnail img-icon" src="../assets/img/telkom.jpg"
                                         style="width: 50px;">
                                </div>
                                <div class="col-11 col">
                                    <input class="form-control aspiration-comments" placeholder="add comments"
                                           type="text">
                                </div>
                                <div class="col-12 text-right">
                                    <a href="">see more comments</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach
    <!--End of Aspiration Card-->
    </section>

    @if(session('0')->getTable() == 'mahasiswa')
        <button class="btn btn-primary feb btn-lg rounded-circle" data-target="#exampleModalCenter" data-toggle="modal">
            +
        </button>
    @endif


    <!--MODAL ADD-->
    <div aria-hidden="true" aria-labelledby="exampleModalCenterTitle" class="modal fade" id="exampleModalCenter"
         role="dialog" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Aspiration</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/PostAspiration" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_mahasiswa" value="{{session(0)->id_mahasiswa}}">
                        {{--                    <input type="hidden" name="id_entitas" value="2">--}}
                        <input type="hidden" name="status" value="Belum Diproses">
                        <label for="judulAspirasi">Judul Aspisrasi</label>
                        <input class="form-control" name="judul_aspirasi" id="judulAspirasi"
                               placeholder="Tuliskan Judul Aspirasi" type="text" required>
                        <label for="tujuanAspirasi">Tujuan Aspirasi</label>
                        <select name="id_entitas" id="tujuanAspirasi" class="form-control" required>
                            @foreach($entitas as $ent)
                                <option value="{{$ent -> id_entitas}}">{{$ent -> nama_entitas}}</option>
                            @endforeach
                        </select>
                        <label for="textAspirasi">Teks Aspirasi</label>
                        <textarea class="form-control" name="aspirasi_text" id="textAspirasi" cols="30" rows="10"
                                  required></textarea>
                        <label for="file">File Pendukung</label>
                        <input class="form-control-file" id="file" multiple type="file" name="file_name[]">
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                        <button class="btn btn-primary" type="submit">Post Aspiration</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach($aspirasi as $asp)
        @if(isset($asp->file_name))
            <div aria-hidden="true" aria-labelledby="modalFile{{$asp->id_aspirasi}}" class="modal fade"
                 id="modalFile{{$asp->id_aspirasi}}"
                 role="dialog" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">File Pendukung</h5>
                            <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <span>Download</span> <br>
                            <?php
                            foreach (json_decode($asp->file_name) as $file){ ?>
                            <a href="{{asset('files/'.$file)}}" target="_blank"
                               class="btn btn-outline-info">Name: <?php echo $file?></a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


    <script !src="">
        document.getElementById('sortByOption').addEventListener('change', function (e) {
            if (e.target.value == 'teratas') {
                refreshTeratas();
            } else {
                refreshTerbaru();
            }
        })

        function refreshTerbaru() {
            let url = "{{ route('feed')}}";
            document.location.href = url;
        }

        function refreshTeratas() {
            let url = "{{ route('feedPopular')}}";
            document.location.href = url;
        }

        function addLikes(idm, id) {
            var x = document.getElementById('totalLikes' + id).innerText;
            x = parseInt(x) + 1;
            document.getElementById('totalLikes' + id).innerText = x;
            runAjaxForLikes(idm, id);
        }

        function addDisLikes(idm, id) {
            var x = document.getElementById('totalDisLikes' + id).innerText;
            x = parseInt(x) + 1;
            document.getElementById('totalDisLikes' + id).innerText = x;
            runAjaxForDisLikes(idm, id);
        }

        function runAjaxForLikes(idm, id) {
            $.ajax({
                type: "GET",
                url: '/feed/likes/' + idm + '/' + id,
                data: {
                    id_mahasiswa: idm,
                    id_aspirasi: id,
                    _token: '{{csrf_token()}}'
                }
            })
            // .done(function (msg) {
            //     alert('Likes Diterima');
            // })
            ;
        }
        function runAjaxForDisLikes(idm, id) {
            $.ajax({
                type: "GET",
                url: '/feed/dislikes/' + idm + '/' + id,
                data: {
                    id_mahasiswa: idm,
                    id_aspirasi: id,
                    _token: '{{csrf_token()}}'
                }
            })
            // .done(function (msg) {
            //     alert('Likes Diterima');
            // })
            ;
        }
    </script>

@endsection
