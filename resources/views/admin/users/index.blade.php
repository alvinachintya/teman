@extends('admin.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">User</h1>
  </div>
  @if (session()->has('success_message'))
  <div class="alert alert-success" role="alert">
  {{ session('success_message') }}
  </div>
  @endif
  <div class="table-responsive">
                    <!-- Start kode untuk form pencarian -->
                        <form class="form" method="get" action="{{ route('user/search') }}">
                            <div class="form-group w-100 mb-3">
                                <label for="search" class="d-block mr-2 mb-1">Cari Akun</label>
                                    <input type="text" name="search" class="form-control w-75 d-inline" id="search" placeholder="Masukkan nama pengguna">
                                     <button type="submit" class="btn btn-success mb-1">Cari</button>
                            </div>
                        </form>
                    <!-- Start kode untuk form pencarian -->
                    @if ($message = Session::get('success'))
                     <div class="alert alert-success">
                        <p>{{ $message }}</p>
                     </div>
                    @endif
                    <a href="{{route('users.create')}}" class="btn btn-success mb-2">
                        Tambah
                    </a>
                    <table class="table">
                        <thead class="thead-dark">
                        <tr>
                            <th>No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Opsi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key => $user)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->is_admin}}</td>
                                <td>
                                    <a href="{{route('users.edit', $user)}}" class="badge bg-warning"><i class='bx bxs-edit'></i></a>
                                    </a>
                                    <form class='d-inline' action="{{route('users.destroy', $user)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class='bx bx-x-circle'></i></button>
                                    </form>
                                </td>
                            </tr>
                            
                        @endforeach
                        </tbody>
                    </table>
                    <div class=mt-2>
                        Current Page : {{ $users->currentPage() }} <br>
                        Jumlah Data : {{ $users->total() }} <br>
                        Data perhalaman : {{ $users->perPage() }} <br>
                        {{ $users->links() }}
                    </div>
    </div>
@endsection
