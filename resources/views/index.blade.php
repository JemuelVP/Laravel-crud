@extends('layouts.master')

@section('content')
    <div class="main-content mt-5">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-6">
                        <h4>All Posts</h4>
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <a class="btn btn-success mx-1" href="{{ route('posts.create') }}">Create</a>
                        <a class="btn btn-warning mx-1" href="">Trashed</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                <table class="table table-striped table-bordered border-dark">
                    <thead style="background-color: #f2f2f2">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 10%">Image</th>
                            <th scope="col" style="width: 20%">Title</th>
                            <th scope="col" style="width: 30%">Description</th>
                            <th scope="col" style="width: 10%">Category</th>
                            <th scope="col" style="width: 10%">Publish Date</th>
                            <th scope="col" style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>
                                <img src="https://picsum.photos/200" alt="" width="80px">
                            </td>
                            <td>Lorem ipsum dolor sit,</td>
                            <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo facilis reiciendis,
                                doloremque ea corrupti nisi nihil et consequuntur repudiandae,</td>
                            <td>News</td>
                            <td>08-09-2025</td>
                            <td>
                                <a class="btn-sm btn-success btn" href="">Show</a>
                                <a class="btn-sm btn-primary btn" href="">Edit</a>
                                <a class="btn-sm btn-danger btn" href="">Delete</a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
