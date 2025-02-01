<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2 justify-between"> <!-- Sử dụng justify-between để căn giữa tiêu đề và breadcrumb -->
              <div class="col-sm-12 text-center">
                  <h1 class="m-0 font-bold text-xl text-gray-800 mt-4">{{ $name . ' ' . $key }}</h1> <!-- Tăng kích thước chữ cho tiêu đề và xích xuống một chút -->
              </div>
          </div>
          <div class="row mb-2">
              <div class="col-sm-6 ml-auto"> <!-- Thêm ml-auto để breadcrumb căn phải -->
                  <ol class="breadcrumb float-right space-x-2"> <!-- Thêm khoảng cách giữa các mục breadcrumb -->
                      <li class="breadcrumb-item">
                          <a href="#" class="text-blue-600 hover:text-blue-800"> <!-- Thêm hiệu ứng hover cho link -->
                              {{ $name }}
                          </a>
                      </li>
                      <li class="breadcrumb-item active text-gray-600"> <!-- Đổi màu cho breadcrumb active -->
                          {{ $key }}
                      </li>
                  </ol>
              </div>
          </div>
      </div>
  </div>

