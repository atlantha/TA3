@extends('master')
@section('title','HOME')
@section('home','active')
@section('content')
    
<div class="content-wrapper">

    {{-- Isi Content --}}
    <section class="content mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-warning float right" data-toggle="modal" data-target="#create-content">
                                Add Data
                            </button>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Image Title</th>
                                        <th scope="col">Logo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <th scope="row">
                                                <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#update-content-{{ $item->id }}">
                                                    <i class="fas-fa-user-check"></i>
                                                    Update
                                                </button>
                                                <form action="{{ route('home.destroy', $item->id) }}" method="POST" class="d-inline-block">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-suser-check"></i> Delete</button>
                                                </form>
                                            </th>
                                            <td>{{ $item->title }}</td>
                                            <td><img src="{{ Storage::url($item->img_title) }}" alt="title" width="200px"></td>
                                            <td><img src="{{ Storage::url($item->logo) }}" alt="logo" width="200px"></td>
                                        </tr>
                                        <div class="modal fade" id="update-content-{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="examleModalLabel">Update Item</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('home.update',$item->id) }}" method="POST" enctype="multipart/form-data">
                                                     <div class="modal-body">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="form-group">
                                                            <label for="title">Title</label>
                                                            <input type="text" name="title" id="title" class="form-control" value="{{ $item->title }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="img_title">Jumbotron Image</label>
                                                            <input type="file" name="img_title" id="img_title" class="custom-file">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="customFile">Logo</label>
                                                            <input type="file" name="logo" id="customFile"class="custom-File">
                                                        </div>
                                                     </div>
                                                     <div class="modal-footer">
                                                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                         <button type="submit" class="btn-btn-primary">Submit</button>
                                                     </div>
                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="4">Data Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <div class="modal fade" id="create-content" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('home.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" class="form-control" id="title">
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="img_title" class="custom-file-input" id="img_title">
                                <label class="custom-file-label" for="img_title">Jumbotron Image</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="logo" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Choose File</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn-btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
@endsection