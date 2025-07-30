{{-- resources/views/front/vitri/history.blade.php --}}
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch sử thay đổi</title>
    <!-- Tải Tailwind CSS từ CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Tùy chỉnh nhỏ để giao diện đẹp hơn */
        @import url('https://rsms.me/inter/inter.css');
        body {
            font-family: 'Inter', sans-serif;
        }
        /* Style cho trạng thái loading */
        .loader {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-4 md:p-8">
    <!-- Tiêu đề và nút Quay lại -->
    <div class="mb-8">
        <div class="flex justify-between items-center mb-1">
            <h1 class="text-3xl font-bold text-gray-800">Lịch sử thay đổi</h1>
            <a id="back-button" href="#" class="inline-flex items-center px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Quay lại
            </a>
        </div>
        <p id="subject-info" class="text-gray-600"></p>
    </div>

    <!-- Container cho dòng thời gian (Timeline) -->
    <div id="timeline-container" class="relative border-l-2 border-blue-200 ml-4">
        <!-- Trạng thái loading sẽ được hiển thị ở đây -->
        <div id="loading-indicator" class="flex justify-center items-center p-8">
            <div class="loader"></div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Cấu hình ---
        const timelineContainer = document.getElementById('timeline-container');
        const subjectInfo = document.getElementById('subject-info');
        const loadingIndicator = document.getElementById('loading-indicator');
        const backButton = document.getElementById('back-button');

        /**
         * Lấy ID từ đường dẫn URL.
         * Ví dụ: từ URL /front-vi-tri-history/123, hàm này sẽ trả về "123".
         */
        function getSubjectIdFromUrl() {
            const pathParts = window.location.pathname.split('/').filter(part => part);
            const id = pathParts[pathParts.length - 1];
            return !isNaN(id) ? id : null;
        }

        const subjectId = getSubjectIdFromUrl();

        // Cập nhật link cho nút "Quay lại"
        if (subjectId && backButton) {
            // Giả định route xem chi tiết là '/front-vi-tri/show/{id}' hoặc tương tự.
            // Hãy thay đổi '/front-vi-tri/show/' cho phù hợp với route của bạn.
            // Dựa trên các route đã có, có thể route xem chi tiết là `front-vi-tri/show/{id}`
            backButton.href = `/front-vi-tri/${subjectId}`;
        }

        if (!subjectId) {
            timelineContainer.innerHTML = `<div class="p-4 text-center text-red-500 font-semibold">Không tìm thấy ID hợp lệ của đối tượng trong URL.</div>`;
            loadingIndicator.style.display = 'none';
            if(backButton) backButton.style.display = 'none'; // Ẩn nút quay lại nếu không có ID
            return;
        }

        /**
         * Hàm gọi API để lấy dữ liệu lịch sử.
         */
        async function fetchHistory() {
            try {
                // SỬA ĐÚNG TÊN ROUTE API Ở ĐÂY
                const apiUrl = `/front-vi-tri-get-history/${subjectId}`;
                const response = await fetch(apiUrl);

                if (!response.ok) {
                    throw new Error(`Lỗi HTTP! Trạng thái: ${response.status}`);
                }

                const data = await response.json();
                renderHistory(data);

            } catch (error) {
                console.error("Lỗi khi lấy dữ liệu lịch sử:", error);
                timelineContainer.innerHTML = `<div class="p-4 text-center text-red-500 font-semibold">Đã xảy ra lỗi khi tải dữ liệu. Vui lòng thử lại.</div>`;
            } finally {
                loadingIndicator.style.display = 'none';
            }
        }

        /**
         * Hàm render toàn bộ giao diện lịch sử từ dữ liệu JSON.
         */
        function renderHistory(data) {
            const { subject, activities } = data;

            // Hiển thị thông tin đối tượng
            subjectInfo.innerHTML = `
                Đối tượng: <span class="font-semibold">${subject.class_name || 'Không xác định'}</span> |
                ID: <span class="font-semibold">${subject.id}</span>
            `;

            if (!activities || activities.length === 0) {
                timelineContainer.innerHTML += `<div class="p-4 text-center text-gray-500">Không có lịch sử nào được ghi nhận.</div>`;
                return;
            }

            // Render từng mục trong lịch sử
            activities.forEach(activity => {
                const activityElement = createActivityElement(activity);
                timelineContainer.appendChild(activityElement);
            });
        }

        /**
         * Hàm tạo một phần tử HTML cho một hoạt động (activity).
         */
        function createActivityElement(activity) {
            const element = document.createElement('div');
            element.className = 'mb-8 ml-8';

            const actionDetails = getActionDetails(activity.action);
            const userName = activity.user ? activity.user.name : 'Hệ thống';
            const activityDate = new Date(activity.created_at).toLocaleString('vi-VN', {
                hour: '2-digit', minute: '2-digit', second: '2-digit', day: '2-digit', month: '2-digit', year: 'numeric'
            });

            let detailsTable = '';
            if (activity.action === 'updated' && activity.before && activity.after) {
                detailsTable = createDetailsTable(activity.before, activity.after);
            }

            element.innerHTML = `
                <span class="absolute -left-4 flex items-center justify-center w-8 h-8 rounded-full ${actionDetails.bgColor}">
                    ${actionDetails.icon}
                </span>
                <div class="p-4 bg-white rounded-lg shadow-md">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-700">
                                <span class="font-bold text-blue-600">${userName}</span>
                                đã
                                <span class="font-semibold ${actionDetails.textColor}">${actionDetails.text}</span>
                                bản ghi này.
                            </p>
                            <time class="text-sm text-gray-500">${activityDate}</time>
                        </div>
                        ${activity.action === 'updated' && detailsTable ? `
                            <button class="toggle-details text-sm text-blue-600 hover:text-blue-800 font-semibold focus:outline-none">
                                <span>Xem chi tiết</span>
                            </button>
                        ` : ''}
                    </div>
                    ${detailsTable}
                </div>
            `;

            const toggleButton = element.querySelector('.toggle-details');
            if (toggleButton) {
                toggleButton.addEventListener('click', () => {
                    const detailsDiv = element.querySelector('.details-content');
                    const buttonText = toggleButton.querySelector('span');
                    if (detailsDiv) {
                        const isHidden = detailsDiv.classList.toggle('hidden');
                        buttonText.textContent = isHidden ? 'Xem chi tiết' : 'Ẩn chi tiết';
                    }
                });
            }

            return element;
        }

        // --- Các hàm hỗ trợ ---

        function getActionDetails(action) {
            switch (action) {
                case 'created':
                    return { bgColor: 'bg-green-500', textColor: 'text-green-600', text: 'tạo mới', icon: `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>` };
                case 'updated':
                    return { bgColor: 'bg-blue-500', textColor: 'text-blue-600', text: 'cập nhật', icon: `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.5L14.732 3.732z"></path></svg>` };
                case 'deleted':
                    return { bgColor: 'bg-red-500', textColor: 'text-red-600', text: 'xóa', icon: `<svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>` };
                default:
                    return { bgColor: 'bg-gray-500', textColor: 'text-gray-600', text: action, icon: '' };
            }
        }

        function createDetailsTable(before, after) {
            let tableRows = '';
            const allKeys = new Set([...Object.keys(before || {}), ...Object.keys(after || {})]);

            for (const key of allKeys) {
                const oldValue = before ? (before[key] ?? 'null') : 'null';
                const newValue = after ? (after[key] ?? 'null') : 'null';

                if (JSON.stringify(oldValue) !== JSON.stringify(newValue)) {
                    tableRows += `
                        <tr class="border-b border-gray-200">
                            <td class="p-2 font-mono bg-gray-50">${key}</td>
                            <td class="p-2 text-red-600 break-all">${typeof oldValue === 'object' ? JSON.stringify(oldValue) : oldValue}</td>
                            <td class="p-2 text-green-600 break-all">${typeof newValue === 'object' ? JSON.stringify(newValue) : newValue}</td>
                        </tr>
                    `;
                }
            }

            if (!tableRows) return '';

            return `
                <div class="details-content hidden mt-4 pt-4 border-t border-gray-200 transition-all duration-300">
                    <h4 class="font-semibold text-gray-800 mb-2">Chi tiết thay đổi:</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="p-2 text-left font-semibold text-gray-600">Trường dữ liệu</th>
                                    <th class="p-2 text-left font-semibold text-gray-600">Giá trị cũ</th>
                                    <th class="p-2 text-left font-semibold text-gray-600">Giá trị mới</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">${tableRows}</tbody>
                        </table>
                    </div>
                </div>
            `;
        }

        // --- Bắt đầu chạy ---
        fetchHistory();
    });
</script>

</body>
</html>
