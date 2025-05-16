<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý nhân viên</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/google-fonts/1.0.0/families/roboto.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #2e59d9;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
            color: #5a5c69;
        }

        .card {
            border-radius: 0.75rem;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 2rem;
        }

        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
            padding: 1.25rem;
        }

        .page-header {
            padding: 1.5rem;
            border-radius: 0.75rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(76, 111, 238, 0.4);
        }

        .page-header h4 {
            margin: 0;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        .page-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--primary-color);
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14);
        }

        .employee-table th {
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 0.05rem;
            background: linear-gradient(135deg, var(--info-color) 0%, #3abbd5 100%);
            color: white;
            border: none;
            padding: 0.75rem 1rem;
        }

        .employee-table td {
            vertical-align: middle;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
        }

        .employee-table tr:hover {
            background-color: rgba(78, 115, 223, 0.05);
        }

        .btn-action {
            margin: 0 5px;
            border-radius: 50px;
            padding: 5px 15px;
            font-size: 0.75rem;
            font-weight: 500;
            text-transform: uppercase;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: all 0.3s;
        }

        .btn-edit {
            background-color: var(--warning-color);
            border-color: var(--warning-color);
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #daa520;
            border-color: #daa520;
            color: #fff;
        }

        .btn-delete {
            background-color: var(--danger-color);
            border-color: var(--danger-color);
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #d04437;
            border-color: #d04437;
            color: #fff;
        }

        .btn-add {
            background: linear-gradient(135deg, var(--success-color) 0%, #17a673 100%);
            border: none;
            color: white;
            padding: 10px 20px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05rem;
            border-radius: 50px;
            box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.14), 0 7px 10px -5px rgba(25, 205, 140, 0.4);
            transition: all 0.3s;
        }

        .btn-add:hover {
            transform: translateY(-2px);
            box-shadow: 0 7px 30px 0 rgba(0, 0, 0, 0.2);
        }

        .password-field {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #999;
            cursor: pointer;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: var(--primary-color);
        }

        .table-responsive {
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .badge-role {
            padding: 0.5em 0.75em;
            font-size: 0.75em;
            border-radius: 50px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: 500;
        }

        .employee-info .name {
            font-weight: 500;
            font-size: 0.9rem;
        }

        .employee-info .email {
            font-size: 0.75rem;
            color: #858796;
        }

        .dataTables_filter input {
            border-radius: 50px;
            padding: 5px 15px;
            border: 1px solid #d1d3e2;
        }

        .dataTables_length select {
            border-radius: 50px;
            padding: 5px 30px 5px 15px;
            border: 1px solid #d1d3e2;
        }

        .page-item.active .page-link {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .page-link {
            color: var(--primary-color);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            border-radius: 50px;
            padding: 0;
            margin: 0 3px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--primary-color);
            border-color: var(--primary-color);
            color: white !important;
        }

        .pagination .page-link {
            border-radius: 50px;
            margin: 0 3px;
        }

        .bg-status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }

        .animate-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

<?php
    $sql = "select * from nhanvien";
    $rs = mysqli_query($conn, $sql);
?>

<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="page-header animate-in">
        <h4>
            <span class="page-icon"><i class="fas fa-user-tie"></i></span>
            Quản Lý Nhân Viên

        </h4>
    </div>

    <!-- Main Content -->
    <div class="card animate-in">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="m-0 font-weight-bold text-primary">Danh Sách Nhân Viên</h5>
            <a href="?action=nhanvien&view=them" class="btn btn-add">
                <i class="fas fa-user-plus mr-2"></i>Thêm Nhân Viên
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="employeeTable" class="table table-hover employee-table">
                    <thead>
                        <tr>
                            <th>Mã NV</th>
                            <th>Thông Tin</th>
                            <th>Liên Hệ</th>
                            <th>Địa Chỉ</th>
                            <th>Quyền</th>
                            <th>Mật Khẩu</th>
                            <th>Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($rs)) { ?>
                        <tr>
                            <td><strong><?php echo $row['MaNV']; ?></strong></td>
                            <td>
                                <div class="employee-info">
                                    <div class="name"><?php echo $row['TenNV']; ?></div>
                                </div>
                            </td>
                            <td>
                                <div><i class="far fa-envelope mr-1 text-primary"></i> <?php echo $row['Email']; ?></div>
                                <div><i class="fas fa-phone-alt mr-1 text-success"></i> <?php echo $row['SDT']; ?></div>
                            </td>
                            <td><?php echo $row['DiaChi']; ?></td>
                            <td><span class="badge badge-role"><?php echo $row['Quyen']; ?></span></td>
                            <td>
                                <div class="password-field">
                                    <input type="password" class="form-control password-input" readonly value="<?php echo $row['MatKhau']; ?>">
                                    <button type="button" class="password-toggle">
                                        <i class="far fa-eye"></i>
                                    </button>
                                </div>
                            </td>
                            <td>
                                <a href="index.php?action=nhanvien&view=sua&manv=<?php echo $row['MaNV']; ?>" class="btn btn-action btn-edit">
                                    <i class="far fa-edit mr-1"></i> Sửa
                                </a>
                                <a href="nhanvien/xuly.php?xoa&manv=<?php echo $row['MaNV']; ?>" class="btn btn-action btn-delete btn-delete-confirm">
                                    <i class="fas fa-trash-alt mr-1"></i> Xóa
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS, jQuery, Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.0.18/sweetalert2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    $('#employeeTable').DataTable({
        language: {
            search: "Tìm kiếm:",
            lengthMenu: "Hiển thị _MENU_ bản ghi",
            info: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            infoEmpty: "Hiển thị 0 đến 0 của 0 bản ghi",
            infoFiltered: "(lọc từ _MAX_ bản ghi)",
            paginate: {
                first: "Đầu",
                last: "Cuối",
                next: "<i class='fas fa-chevron-right'></i>",
                previous: "<i class='fas fa-chevron-left'></i>"
            },
            emptyTable: "Không có dữ liệu",
            zeroRecords: "Không tìm thấy bản ghi phù hợp"
        },
        responsive: true,
        pageLength: 10,
        order: [[ 0, "asc" ]],
        dom: '<"top"lf>rt<"bottom"ip>'
    });

    // Password Toggle
    $('.password-toggle').on('click', function() {
        const passwordField = $(this).siblings('.password-input');
        const passwordIcon = $(this).find('i');

        if (passwordField.attr('type') === 'password') {
            passwordField.attr('type', 'text');
            passwordIcon.removeClass('fa-eye').addClass('fa-eye-slash');
        } else {
            passwordField.attr('type', 'password');
            passwordIcon.removeClass('fa-eye-slash').addClass('fa-eye');
        }
    });

    // Delete confirmation
    $('.btn-delete-confirm').on('click', function(e) {
        e.preventDefault();
        const deleteUrl = $(this).attr('href');

        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Bạn có chắc chắn muốn xóa nhân viên này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#858796',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl;
            }
        });
    });

    // Animation for cards
    setTimeout(function() {
        $('.animate-in').removeClass('animate-in');
    }, 500);
});
</script>
</body>
</html>