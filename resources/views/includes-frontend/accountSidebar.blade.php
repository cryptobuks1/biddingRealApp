 <div class="col-lg-4 pb-5 ">
            <!-- Account Sidebar-->
              <div class="author-card pb-3">
                <div class="author-card-cover" style="background-image: url({{ asset('img') }}/{{ Auth::user()->image }});"><a class="btn btn-style-1 btn-white btn-sm" href="#" data-toggle="tooltip" title="" data-original-title="You currently have 290 Reward points to spend"></a></div>
                <div class="author-card-profile">
                    <div class="author-card-avatar">
                      @if (!empty(Auth::user()->image))
                        <img src="{{ asset('img') }}/{{ Auth::user()->image }}" alt="Daniel Adams" class="rounded  img-thumbnail" >
                      @else


                        <img src="{{ asset('img') }}/no-preview-available.png" alt="Daniel Adams">
                      @endif

                    </div>
                    <div class="author-card-details">
                        <h5 class="author-card-name text-lg">{{ Auth::user()->name }} </h5><span class="author-card-position">{{ Auth::user()->created_at->format('d M Y')  }}</span>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush shadow-sm    bg-white rounded">
                
                    <a class="list-group-item " href="{{ route('myaccount') }}"><i class="fe-icon-user text-muted"></i>Profile Settings</a>
                  
                     <a class="list-group-item" href="{{ route('myaccountWinningBids') }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">Winning Auctions</div>
                            </div><span class="badge badge-secondary">{{ $winningAuctionscount }}</span>
                        </div>
                    </a>


                     <a class="list-group-item" href="{{ route('myaccountWhereBids') }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">Auctions Where You Bids</div>
                            </div><span class="badge badge-secondary">{{ $auctionswhereBidcount }}</span>
                        </div>
                    </a>
 
                       <a class="list-group-item" href="{{ route('whishlist') }}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">WhishList</div>
                            </div><span class="badge badge-secondary">{{ $whishListcount }}</span>
                        </div>
                    </a>

                  {{--   <a class="list-group-item" href="#">
                        <div class="d-flex justify-content-between align-items-center">
                            <div><i class="fe-icon-heart mr-1 text-muted"></i>
                                <div class="d-inline-block font-weight-medium text-uppercase">My Wishlist</div>
                            </div><span class="badge badge-secondary">3</span>
                        </div>
                    </a> --}}
                  
                </nav>
            </div>
        </div>