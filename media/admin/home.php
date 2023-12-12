<body class="dashboard dashboard_1">
   <div class="full_container">
      <div class="inner_container">

         <div id="content">
            <div class="midde_cont">
               <div class="container-fluid">
                  <div class="row column_title">
                     <div class="col-md-12">
                        <div class="page_title">
                           <h2>Dashboard</h2>
                        </div>
                     </div>
                  </div>

                  <div class="row column1">
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa-solid fa-comments fa-beat-fade" style="color: #f8300d;"></i>
                              </div>
                           </div>
                           <?php
                           $listuser = new home();
                           $selecct =  $listuser->getCountcmt();
                           foreach ($selecct as $item) {
                              echo '
                           <div class="counter_no">
                              <div>
                                 <p class="total_no">' . $item['count'] . '</p>
                                 <p class="head_couter">Comment</p>
                              </div>
                           </div>
                           ';
                           }
                           ?>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa-solid fa-address-card fa-beat-fade" style="color: #fd9149;"></i>
                              </div>
                           </div>
                           <?php
                           $listuser = new home();
                           $selecct =  $listuser->getCountposts();
                           foreach ($selecct as $item) {
                              echo '
                           <div class="counter_no">
                              <div>
                                 <p class="total_no">' . $item['count'] . '</p>
                                 <p class="head_couter">Posts</p>
                              </div>
                           </div>
                           ';
                           }
                           ?>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa-solid fa-user-large fa-beat-fade" style="color: #41f8fb;"></i>
                              </div>
                           </div>
                           <?php
                           $listuser = new home();
                           $selecct =  $listuser->getCount();
                           foreach ($selecct as $item) {
                              echo '
                           <div class="counter_no">
                              <div>
                                 <p class="total_no">' . $item['count'] . '</p>
                                 <p class="head_couter">user</p>
                              </div>
                           </div>
                           ';
                           }
                           ?>
                        </div>
                     </div>
                     <div class="col-md-6 col-lg-3">
                        <div class="full counter_section margin_bottom_30">
                           <div class="couter_icon">
                              <div>
                                 <i class="fa fa-user yellow_color"></i>
                              </div>
                           </div>
                           <div class="counter_no">
                              <div>
                                 <p class="total_no">2500</p>
                                 <p class="head_couter">Lượt Yêu thích</p>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- graph -->
                  <div class="row column2 graph margin_bottom_30">
                     <div class="col-md-l2 col-lg-12">
                        <div class="white_shd full">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Thông Kế giới tính của tất cả User</h2>
                              </div>
                           </div>
                           <div class="full graph_revenue">
                              <div class="row">
                                 <div class="col-md-12">

                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row column2 graph margin_bottom_30">
                     <div class="col-md-l2 col-lg-12">
                        <div class="white_shd full">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Số Lượng User Đăng Nhập Trong 7 Ngày</h2>
                              </div>
                           </div>
                           <div class="full graph_revenue">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="area_chart">
                                       <?php
                                       $db = new home();
                                       $result = $db->getCounttime();

                                       // Kiểm tra và xử lý kết quả
                                       if ($result > 0) {
                                          // Khởi tạo mảng để lưu dữ liệu từ cơ sở dữ liệu
                                          $roles = array();
                                          $totals = array();

                                          // Đọc dữ liệu từ kết quả truy vấn
                                          foreach ($result as $row) {
                                             // Chuyển đổi ngày thành thứ trong tuần
                                             $dayOfWeek = date('N', strtotime($row['login_date']));
                                             switch ($dayOfWeek) {
                                                case 1:
                                                   $dayOfWeekText = 'Thứ Hai';
                                                   $backgroundColor = 'rgba(255, 99, 132, 0.5)'; // Màu đỏ
                                                   break;
                                                case 2:
                                                   $dayOfWeekText = 'Thứ Ba';
                                                   $backgroundColor = 'rgba(54, 162, 235, 0.5)'; // Màu xanh dương
                                                   break;
                                                case 3:
                                                   $dayOfWeekText = 'Thứ Tư';
                                                   $backgroundColor = 'rgba(255, 206, 86, 0.5)'; // Màu vàng
                                                   break;
                                                case 4:
                                                   $dayOfWeekText = 'Thứ Năm';
                                                   $backgroundColor = 'rgba(75, 192, 192, 0.5)'; // Màu xanh lá cây
                                                   break;
                                                case 5:
                                                   $dayOfWeekText = 'Thứ Sáu';
                                                   $backgroundColor = 'rgba(153, 102, 255, 0.5)'; // Màu tím
                                                   break;
                                                case 6:
                                                   $dayOfWeekText = 'Thứ Bảy';
                                                   $backgroundColor = 'rgba(255, 159, 64, 0.5)'; // Màu cam
                                                   break;
                                                case 7:
                                                   $dayOfWeekText = 'Chủ Nhật';
                                                   $backgroundColor = 'rgba(50, 205, 50, 0.5)'; // Màu xanh lá cây sáng
                                                   break;
                                                default:
                                                   $dayOfWeekText = '';
                                                   $backgroundColor = 'rgba(0, 0, 0, 0.5)'; // Màu đen mặc định
                                             }

                                             // Lưu thứ trong tuần vào mảng nhãn
                                             $roles[] = $dayOfWeekText;

                                             // Lưu tổng số vào mảng dữ liệu
                                             $totals[] = $row['user_count'];
                                          }

                                          // Chuyển đổi mảng thành chuỗi JSON để sử dụng trong biểu đồ
                                          $roles_json = json_encode($roles);
                                          $totals_json = json_encode($totals);
                                       } else {
                                          echo "Không có dữ liệu từ cơ sở dữ liệu.";
                                       }
                                       ?>
                                       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                       <canvas id="time" width="800" height="400"></canvas>

                                       <script>
                                          var roles = <?php echo $roles_json; ?>;
                                          var totals = <?php echo $totals_json; ?>;
                                          var backgroundColors = [
                                             'rgba(255, 99, 132, 0.5)',
                                             'rgba(54, 162, 235, 0.5)',
                                             'rgba(255, 206, 86, 0.5)',
                                             'rgba(75, 192, 192, 0.5)',
                                             'rgba(153, 102, 255, 0.5)',
                                             'rgba(255, 159, 64, 0.5)',
                                             'rgba(50, 205, 50, 0.5)'
                                          ];

                                          var ctx = document.getElementById('time').getContext('2d');
                                          var myChart = new Chart(ctx, {
                                             type: 'bar',
                                             data: {
                                                labels: roles,
                                                datasets: [{
                                                   label: 'Số Lượng User Online Trong 7 Ngày',
                                                   data: totals,
                                                   backgroundColor: backgroundColors,
                                                   borderColor: backgroundColors,
                                                   borderWidth: 1,
                                                   barThickness: 60
                                                }]
                                             },
                                             options: {
                                                scales: {
                                                   y: {
                                                      beginAtZero: true
                                                   }
                                                }
                                             }
                                          });
                                       </script>
                                    </div>


                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row column2 graph margin_bottom_30">
                     <div class="col-md-l2 col-lg-12">
                        <div class="white_shd full">
                           <div class="full graph_head">
                              <div class="heading1 margin_0">
                                 <h2>Thông Kế Bài Post Của Từng User</h2>
                              </div>
                           </div>
                           <div class="full graph_revenue">
                              <div class="row">
                                 <div class="col-md-12">
                                    <div class="area_chart">
                                       <?php
                                       $db = new home();
                                       $result = $db->getCountuser();
                                       // var_dump($resuft); exit();
                                       // Kiểm tra và xử lý kết quả
                                       if ($result > 0) {
                                          // Khởi tạo mảng để lưu dữ liệu từ cơ sở dữ liệu
                                          $roles = array();
                                          $totals = array();

                                          // Đọc dữ liệu từ kết quả truy vấn
                                          foreach ($result as $row) {
                                             $roles[] = $row['name']; // Lưu vai trò (role) vào mảng nhãn
                                             $totals[] = $row['count']; // Lưu tổng số vào mảng dữ liệu
                                          }

                                          // Chuyển đổi mảng thành chuỗi JSON để sử dụng trong biểu đồ
                                          $roles_json = json_encode($roles);
                                          $totals_json = json_encode($totals);
                                       } else {
                                          echo "Không có dữ liệu từ cơ sở dữ liệu.";
                                       }

                                       ?>
                                       <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                                       <canvas id="user" width="800" height="400"></canvas>

                                       <script>
                                          var roles = <?php echo $roles_json; ?>;
                                          var totals = <?php echo $totals_json; ?>;

                                          var ctx = document.getElementById('user').getContext('2d');
                                          var myChart = new Chart(ctx, {
                                             type: 'bar',
                                             data: {
                                                labels: roles,
                                                datasets: [{
                                                   label: 'Thông Kế Bài Post Của Từng User',
                                                   data: totals,
                                                   backgroundColor: [
                                                      'rgba(54, 162, 235, 0.5)',
                                                      'rgba(255, 99, 132, 0.5)'
                                                   ],
                                                   borderColor: [
                                                      'rgba(54, 162, 235, 0.5)',
                                                      'rgba(255, 99, 132, 0.5)'
                                                   ],
                                                   borderWidth: 1,
                                                   barThickness: 60
                                                }]
                                             },
                                             options: {
                                                scales: {
                                                   y: {
                                                      beginAtZero: true
                                                   }
                                                }
                                             }
                                          });
                                       </script>

                                    </div>'
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- end graph -->
            </div>
            <!-- footer -->
         </div>
      </div>
   </div>
   </div>
   <!-- jQuery -->

</body>

</html>