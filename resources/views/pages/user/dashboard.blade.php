@extends('layouts')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading">
      <div class="breadcrumbs">
        <ol class="breadcrumb" style="margin:0;">
          <li><a href="/">Home</a></li>
          <li class="active">Thống kê</li>
        </ol>
      </div>
    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Đã mua</span>
                <span class="icon-stat-value">{{ formatCurrent($totalCost) }}</span>
              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
              </div> --}}
            </div>

          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Số đơn mua</span>
                <span class="icon-stat-value">{{ $totalPurchase }}</span>

              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
              </div> --}}
            </div>

          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Số đơn thành công</span>
                <span class="icon-stat-value">{{ $totalDelivered }}</span>

              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
              </div> --}}
            </div>

          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Số đơn đã hủy</span>
                <span class="icon-stat-value">{{ $totalCanceled }}</span>

              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
              </div> --}}
            </div>

          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Thanh toán trong ngày</span>
                <span class="icon-stat-value">{{ formatCurrent($totalCostToday) }}</span>
              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
              </div> --}}
            </div>

          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Số đơn trong ngày</span>
                <span class="icon-stat-value">{{ $totalPurchaseToday }}</span>

              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
              </div> --}}
            </div>

          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Số đơn thành công trong ngày</span>
                <span class="icon-stat-value">{{ $totalDeliveredToday }}</span>

              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-dollar icon-stat-visual bg-primary"></i>
              </div> --}}
            </div>

          </div>
        </div>
        <div class="col-md-3 col-sm-6">
          <div class="icon-stat">
            <div class="row">
              <div class="col-xs-12 text-left">
                <span class="icon-stat-label">Số đơn đã hủy trong ngày</span>
                <span class="icon-stat-value">{{ $totalCanceledToday }}</span>

              </div>
              {{-- <div class="col-xs-4 text-center">
                <i class="fa fa-gift icon-stat-visual bg-secondary"></i>
              </div> --}}
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>
@endsection
