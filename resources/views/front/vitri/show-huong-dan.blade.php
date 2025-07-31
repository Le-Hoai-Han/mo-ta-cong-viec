<x-front-layout>
    @push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a{
            cursor: pointer;
        }
        body {
            font-family: "Quicksand", Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-size: 24px;
            color: #B52227;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
            table-layout: fixed;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background: #B52227;
            color: white;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* display: flex; */
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }

        .show{
            display: flex !important;
        }

    </style>
    @endpush

    @php
        $kiemTra = auth()->user()->hasRole('Admin') ||
            (auth()->user()->hasRole('mo_ta_cong_viec') &&
                auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv');

        $kiemTraCaNhan = auth()->user()->hasRole('Admin') ||
            (auth()->user()->hasRole('mo_ta_cong_viec') ||
                auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv') || auth()->user()->id === $viTri->id_user;
    @endphp
    <div class="container">
        <h2>{{ $viTri->ten_vi_tri }}</h2>

        @include('front.vitri.show._thong_tin_nhan_vien', [ 'nhanVien' => $viTri->user ])
        @include('front.vitri.show._huong_dan_cong_viec', [ 'nhanVien' => $viTri->user ])

    </div>

    @push('scripts')

    @if (session('success'))
    <script>
        hienThongBao(@json(session('success')));
        setTimeout(function() {
                                location.reload();
                            }, 500);
    </script>
    @endif

    @if (session('error'))
        <script>
            hienLoi(@json(session('error')));
            setTimeout(function() {
                                location.reload();
                            }, 500);
        </script>
    @endif
    {{-- Thêm script của TinyMCE từ CDN --}}
    <script src="https://cdn.tiny.cloud/1/{{ config('services.tiny.key') }}/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Chỉ chạy script nếu các element tồn tại (khi người dùng có quyền)
            if (document.getElementById('openEditModalBtn')) {

                // Khởi tạo TinyMCE
                tinymce.init({
                    selector: '#huongDanEditor',
                    plugins: 'autolink lists link image charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table directionality emoticons template paste textpattern',
                    toolbar: 'undo redo | styles | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | code',
                    height: 400,
                });

                // Logic để điều khiển Modal
                const modal = document.getElementById('editHuongDanModal');
                const openBtn = document.getElementById('openEditModalBtn');
                const closeBtn = document.getElementById('closeModalBtn');

                openBtn.addEventListener('click', () => {
                    modal.classList.add('show'); // Thêm class 'show' để hiện modal
                });

                closeBtn.addEventListener('click', () => {
                    modal.classList.remove('show');
                });

                // Đóng modal khi click ra ngoài vùng modal-content
                window.addEventListener('click', (event) => {
                    if (event.target == modal) {
                        modal.classList.remove('show');
                    }
                });
            }
        });
    </script>
    @endpush
</x-front-layout>
