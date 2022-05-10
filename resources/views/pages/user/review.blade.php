@extends('layouts')
@section('content')
  <div class="panel panel-default">
    <div class="panel-heading d-flex justify-content-between align-items-center">
      <ol class="breadcrumb m-0">
        <li><a href="#">Trang chủ</a></li>
        <li class="active">Đánh giá sản phẩm</li>
      </ol>

    </div>
    <div class="panel-body">

      <div class="table-responsive ">
        <div class="container" id="reviews">
          <div class="col-sm-8 col-sm-offset-2">
            <div id="review">
              <div class="wrap-review-form">
                <div id="comments">
                  <ol class="commentlist">
                    <li class="comment byuser comment-author-admin bypostauthor even thread-even depth-1"
                      id="li-comment-20">
                      <div id="comment-20" class="comment_container">
                        <img alt="" src="{{ asset('images/' . $orderItem->product->image) }}" width="200">
                        <div class="comment-text">
                          <div class="description">
                            <p style="font-size: 2rem">Tên sản phẩm: <strong>{{ $orderItem->product->name }}</strong>
                            </p>
                          </div>
                          <p class="meta" style="font-size: 1.6rem">
                            <strong class="woocommerce-review__author">Giá: {{ formatCurrent($orderItem->price) }}
                              đ</strong>
                          </p>
                        </div>
                      </div>
                    </li>
                  </ol>
                </div><!-- #comments -->
                <div id="review_form_wrapper">
                  <div id="review_form">
                    <div id="respond" class="comment-respond">

                      <form id="commentform" class="comment-form" method="POST"
                        action="{{ route('user.review.add') }}">
                        @csrf
                        <input type="hidden" name="order_item_id" value="{{ $orderItem->id }}">
                        <div class="comment-form-rating">
                          <h4>Đánh giá</h4>
                          <p class="stars" style="padding: 2rem 0;">
                            <label for="rated-1"></label>
                            <input type="radio" id="rated-1" name="rating" value="1">
                            <label for="rated-2"></label>
                            <input type="radio" id="rated-2" name="rating" value="2">
                            <label for="rated-3"></label>
                            <input type="radio" id="rated-3" name="rating" value="3">
                            <label for="rated-4"></label>
                            <input type="radio" id="rated-4" name="rating" value="4">
                            <label for="rated-5"></label>
                            <input type="radio" id="rated-5" name="rating" value="5" checked>
                          </p>
                        </div>
                        <p class="comment-form-comment">
                        <h4 for="comment">Bình luận sản phẩm<span class="required">*</span></h4>
                        <textarea id="comment" name="comment" cols="45" rows="8" required></textarea>
                        </p>
                        <p class="form-submit">
                          <button type="submit" class="btn btn-default">Gửi bình luận</button>
                        </p>
                      </form>

                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
