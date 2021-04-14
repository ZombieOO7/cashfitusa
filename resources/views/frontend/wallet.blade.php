@extends('frontend.layouts.default')
@section('front_css')
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });

    </script>
    {{-- <link href="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet"
    type="text/css" /> --}}
    {{-- <link href="{{ asset('backend/dist/default/assets/demo/default/base/style.bundle.css') }}" rel="stylesheet"
    type="text/css" /> --}}
    <script src="https://rawgit.com/kimmobrunfeldt/progressbar.js/1.0.0/dist/progressbar.js"></script>
    <style>
        .list-group-item:hover {
            background-color: #eef5ff !important;
            border-right: 3px solid blue !important;
        }

        .list-group-item.active {
            background-color: #eef5ff !important;
            border-right: 3px solid blue !important;
            color: blue !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background: #2171d3 !important;
        }

        .progressbar-text {
            bottom: 20px !important;
            color: #007bff !important;
        }

        .datacontainer {
            display: grid;
            grid-template-columns: repeat(1, 160px);
            grid-gap: 80px;
            margin: auto 0;
        }

        .datacontainer .box .chart {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            font-size: 36px;
            line-height: 160px;
            height: 160px;
            color: #000;
        }

        .datacontainer .box canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            width: 100%;
        }

    </style>
@endsection
@section('content')
@section('title', 'Dashboard')
    <section class="loan-process-section section-padding pt-50">
        <div class="col-md-12">
            <div class="mb-2">
                <div class="row">
                    <div class="col-sm-12 col-md-6 tabdash col-lg-3">
                        <div class="mb-35">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#m_tabs_1_1">Wallet</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#m_tabs_1_2">Earning</a>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="tab-content">
                        {{-- Start Loan tab panel --}}
                        <div id="m_tabs_1_1" role="tabpanel" class="tab-pane active show">
                            <div class="row">
                                <div class="col-12 col-sm-3 col-md-3 col-lg-3 coldashmenu">


                                    <div class="sidebardasbord">
                                        <div class="card">
                                            <div class="filter-content rounded">
                                                <div class="list-group " id="list-tab" role="tablist">
                                                    <div class="mt-3"></div>
                                                    <a class="border-0 list-group-item list-group-item-action text-dark"
                                                        data-toggle="tab" href="#m_tabs_2_1">
                                                        <span class="fas fa-pie-chart mr-2"></span> Dashboard
                                                    </a>
                                                    <a class="border-0 list-group-item list-group-item-action text-dark active"
                                                        href="{{ route('wallet') }}">
                                                        <span class="fas fa-wallet mr-2"></span> Wallet
                                                    </a>
                                                    <a class="border-0 list-group-item list-group-item-action text-dark"
                                                        href="{{ route('loan.detail') }}">
                                                        <span class="fas fa-plus mr-2"></span> New Application
                                                    </a>
                                                    <a class="border-0 list-group-item list-group-item-action text-dark"
                                                        href="{{ route('application') }}">
                                                        <span class="fas fa-eye mr-2"></span> View Application
                                                    </a>
                                                    <a class="border-0 list-group-item list-group-item-action text-dark"
                                                        data-toggle="tab" href="#m_tabs_2_2">
                                                        <span class="fas fa-user mr-3"></span>Account
                                                    </a>
                                                    <div class="eef5ff mb-3"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-9 col-md-9 col-lg-9">
                                    <div class="tab-content">
                                        <div id="m_tabs_2_1" role="tabpanel" class="tab-pane active show">
                                            <div class="row">
                                                <div class="col-md-4 colcardbox mb-20">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-md-9 col-9">
                                                                <label for="" class="text-black text-bold">Wallet
                                                                    Balance</label>
                                                                <div class="h5 count">
                                                                    {{ config('constant.currency_symbol') . @$wallet->wallet_balance }}
                                                                </div>
                                                            </div>
                                                            <div class="col-3 col-md-3 mt-2 p-0">
                                                                <img src="{{ asset('images/d-1.svg') }}" alt=""
                                                                    class="h-75">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 colcardbox mb-20">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-md-9 col-9">
                                                                <label for="" class="text-black text-bold">Transfered
                                                                    Amount</label>
                                                                <div class="h5 count">
                                                                    {{ config('constant.currency_symbol') . @$wallet->transfer_amount }}
                                                                </div>
                                                            </div>
                                                            <div class="col-3 col-md-3 mt-2 p-0">
                                                                <img src="{{ asset('images/d-2.svg') }}" alt=""
                                                                    class="h-75">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 colcardbox">
                                                    <div class="card card-body">
                                                        <div class="row">
                                                            <div class="col-md-9 col-9">
                                                                <label for="" class="text-black text-bold">Withdrawl
                                                                    Amount</label>
                                                                <div class="h5 count">
                                                                    {{ config('constant.currency_symbol') . @$wallet->withdrawal_amount }}
                                                                </div>
                                                            </div>
                                                            <div class="col-3 col-md-3 mt-2 p-0">
                                                                <img src="{{ asset('images/d3.svg') }}" alt="" class="h-75">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-5 col-md-5 col-12 imgdashcolmb">
                                                    <img src="{{ asset('images/dashboardimage.svg') }}"
                                                        alt="dashboardimage">
                                                </div>
                                                <div class="col-lg-7 col-md-6 histcol">
                                                    <div class="card card-body  h-100 histbox wallethisbox">
                                                        <label for=""
                                                            class="form-lable border-title text-bold text-black">Transaction
                                                            History...</label>
                                                        <table class="w-100 tranhismain">
                                                            <thead class="border-0">
                                                                <tr
                                                                    class="headdastitle walletdast font-sizezero font-sizezero">
                                                                    <th class="text-black">Date</th>
                                                                    <th class="text-black">Description</th>
                                                                    <th class="text-black">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @forelse(@$walletTransactions as $transaction)
                                                                    <tr class="font-sizezero walletdastr">
                                                                        <td class='form-label text-dark'>
                                                                            {{ @$transaction->proper_date_text }}</td>
                                                                        <td class='form-label text-dark'>
                                                                            {{ @$transaction->description }}</td>
                                                                        <td class='form-label text-dark'>
                                                                            {{ config('constant.currency_symbol') . @$transaction->amount }}
                                                                        </td>
                                                                    </tr>
                                                                @empty
                                                                    <tr>
                                                                        <td>No Records Found</td>
                                                                    </tr>
                                                                @endforelse
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-12 imgdashcol">
                                                    <div class="mb-35">
                                                        <ul class="nav nav-pills nav-fill" role="tablist">
                                                            <li class="nav-item">
                                                                <a class="nav-link active" data-toggle="tab"
                                                                    href="#m_tabs_1_1">Transfer</a>
                                                            </li>
                                                            <li class="nav-item">
                                                                <a class="nav-link" data-toggle="tab"
                                                                    href="#m_tabs_1_2">Withdraw</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <img src="{{ asset('frontend/img/dashboardwalletimg.png') }}"
                                                        alt="dashboardwalletimg">
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
        </div>
    </section>
    <!-- Button trigger modal -->
    {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
        Launch demo modal
    </button>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
        Launch demo modal1
    </button>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
        Launch demo modal2
    </button> --}}
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog dasbordform" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="formlinkbank formmodelbank">
                        <div class="row formrow">
                            <div class="col-md-12 col-12 formcol">
                                <div class="form-group">
                                    <label>Withdraw Amount</label>
                                    <input type="text" name="withdramo" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-12 formcol">
                                <div class="form-group">
                                    <label>Debit Card No.</label>
                                    <input type="text" name="debitcardno" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>Expiry Date</label>
                                    <span>MM</span>
                                    <input type="text" name="name" class="form-control input-textmon">
                                    <span>YY</span>
                                    <input type="text" name="name" class="form-control input-textyear">
                                </div>
                            </div>

                            <div class="col-md-6 col-12 formcol">
                                <div class="form-group">
                                    <label>CVV</label>
                                    <input type="text" name="cvv" class="form-control inupt-textcvv">
                                </div>
                            </div>
                            <div class="col-md-12 col-12 formcol">
                                <div class="form-group">
                                    <label>Name On Card</label>
                                    <input type="text" name="manecredno" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-12 formcol">
                                <div class="form-group">
                                    <label>Bank Name</label>
                                    <input type="text" name="bankname" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="subbtn">
                            <button class="btn btn-green">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog dasbordform dasbordformerror" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="errormain">
                        <div class="errorimg">
                            <img src="{{ asset('frontend/img/errorimg.png') }}" alt="">
                        </div>
                        <h5 class="errortitle">Sorry!! an ERROR occured while processing the transfer. Please Contact Rapid
                            Cash America for further assistance</h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2"
        aria-hidden="true">
        <div class="modal-dialog dasbordform dasbordformerror" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="errormain">
                        <div class="errorimg">
                            <img src="{{ asset('frontend/img/errorimg.png') }}" alt="">
                        </div>
                        <h5 class="errortitle">Sorry!! an ERROR occured while processing the withdrawl. Please Contact Rapid
                            Cash America for further assistance</h5>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
@section('front_script')
    <script src="{{ asset('backend/dist/default/assets/vendors/base/vendors.bundle.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('backend/dist/default/assets/demo/default/base/scripts.bundle.js') }}" type="text/javascript">
    </script>
    <script>
        var rule = $.extend({}, {!! json_encode(config('constant'), JSON_FORCE_OBJECT) !!});

    </script>
    <script src="{{ asset('frontend/js/user/profile.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easypiechart.min.js') }}"></script>
    <script>
        $('.chart').easyPieChart({
            size: 160,
            barColor: function(percent) {
                var ctx = this.renderer.getCtx();
                var canvas = this.renderer.getCanvas();
                // var gradient = ctx.createLinearGradient(150,60,canvas.width,0);
                var gradient = ctx.createLinearGradient(140, -80, canvas.width, 10);
                gradient.addColorStop(1, "#3D46DC");
                gradient.addColorStop(0, "#FA0B7E");
                return gradient;
            },
            scaleLength: 0,
            lineWidth: 15,
            trackColor: "#E1E5EB",
            lineCap: "circle",
            animate: 2000,
        });
        $('.count').each(function() {
            var $this = $(this);
            textC = $this.text();
            textC = textC.replace('$', '');
            jQuery({
                Counter: 0
            }).animate({
                Counter: textC
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text('$' + Math.ceil(this.Counter));
                }
            });
        });
        $('.count2').each(function() {
            var $this = $(this);
            textC = $this.text();
            jQuery({
                Counter: 0
            }).animate({
                Counter: textC
            }, {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $this.text(Math.ceil(this.Counter));
                }
            });
        });
        $('#editProfile').on('click', function() {
            $("form#m_form_1 :input").each(function() {
                var input = $(this); // This is the jquery object of the input, do what you will
                if (input.attr('name') != 'email')
                    input.attr('disabled', false);
            });
            $("#textArea").attr('disabled', false);
        })
        $('.editCancel').on('click', function() {
            $("form#m_form_1 :input").each(function() {
                var input = $(this); // This is the jquery object of the input, do what you will
                if (input.attr('type') != 'button')
                    input.attr('disabled', true);
            });
            $("#textArea").attr('disabled', false);
        });
        $(document).ready(function() {
            $("form#m_form_1 :input").each(function() {
                var input = $(this); // This is the jquery object of the input, do what you will
                if (input.attr('type') != 'button')
                    input.attr('disabled', true);
            });
            $("#textArea").attr('disabled', false);
        })

    </script>
    <script type="text/javascript">
        $('#myModal').on('shown.bs.modal', function() {
            $('#myInput').trigger('focus')
        })

    </script>
@stop
