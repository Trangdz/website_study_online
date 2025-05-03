@extends('layouts.backend')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 mb-0 text-gray-800">Quản lý người dùng</h1>
    <a href="{{ route('admin.users.add') }}" class="btn btn-primary">Thêm mới</a>
</div>

<div class="table-responsive">
    <table class="table table-bordered" id="datatablesSimple" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Thời gian</th>
                <th style="width: 5%;">Sửa</th>
                <th style="width: 5%;">Xóa</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Tên</th>
                <th>Email</th>
                <th>Nhóm</th>
                <th>Thời gian</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </tfoot>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td><a href="#" class="btn btn-warning">Sửa</a></td>
                <td><a href="#" class="btn btn-danger">Xóa</a></td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td><a href="#" class="btn btn-warning">Sửa</a></td>
                <td><a href="#" class="btn btn-danger">Xóa</a></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection

@push('scripts')
    <!-- CDN hoặc file đã tải xuống -->
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const datatable = new simpleDatatables.DataTable("#datatablesSimple");
        });
    </script>
@endpush
