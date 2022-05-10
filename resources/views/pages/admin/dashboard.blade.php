@extends('admin')
@section('admin_content')
  <style>
    .content {
      padding-top: 40px;
      padding-bottom: 40px;
    }

    .icon-stat {
      display: block;
      overflow: hidden;
      position: relative;
      padding: 15px;
      margin-bottom: 1em;
      background-color: #fff;
      border-radius: 4px;
      border: 1px solid #ddd;
    }

    .icon-stat-label {
      display: block;
      color: #999;
      font-size: 13px;
    }

    .icon-stat-value {
      display: block;
      font-size: 20px;
      font-weight: 600;
    }

    .icon-stat-visual {
      position: relative;
      top: 22px;
      display: inline-block;
      width: 32px;
      height: 32px;
      border-radius: 4px;
      text-align: center;
      font-size: 16px;
      line-height: 30px;
    }

    .bg-primary {
      color: #fff;
      background: #d74b4b;
    }

    .bg-secondary {
      color: #fff;
      background: #6685a4;
    }

    .icon-stat-footer {
      padding: 10px 0 0;
      margin-top: 10px;
      color: #aaa;
      font-size: 12px;
      border-top: 1px solid #eee;
    }

  </style>
  <div class="container-fluid px-4 content">
    <h4 class="mt-4">Thống kê</h4>
    <div class="card my-4">
      <div class="card-header">
        Doanh thu
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3 col-sm-6">
            <div class="icon-stat">
              <div class="row">
                <div class="col-xs-12 text-left">
                  <span class="icon-stat-label">Tổng doanh thu</span>
                  <span class="icon-stat-value">{{ formatCurrent($totalRevenue) }}</span>
                </div>

              </div>

            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-stat">
              <div class="row">
                <div class="col-xs-12 text-left">
                  <span class="icon-stat-label">Số đơn đã bán</span>
                  <span class="icon-stat-value">{{ $totalSales }}</span>
                </div>

              </div>

            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-stat">
              <div class="row">
                <div class="col-xs-12 text-left">
                  <span class="icon-stat-label">Doanh số hôm nay</span>
                  <span class="icon-stat-value">{{ formatCurrent($todayRevenue) }}</span>
                </div>

              </div>

            </div>
          </div>
          <div class="col-md-3 col-sm-6">
            <div class="icon-stat">
              <div class="row">
                <div class="col-xs-12 text-left">
                  <span class="icon-stat-label">Số đơn đã bán hôm nay</span>
                  <span class="icon-stat-value">{{ $todaySales }}</span>
                </div>

              </div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
@endsection
