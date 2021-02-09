<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Receipt</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" media="all" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="container">
        <div class="col-md-12 text-right mt-2">
            <button class="btn btn-success" id='cmd'><i class="fa fa-download"></i> Download</button>
            <a class="btn btn-secondary" role="button" href="{{route('application')}}">Back</a>
        </div>
    </div>
    <div class="container" id='pdfData'>
        <div class="content col-md-12" >
            <div class="row font-weight-bold mt-2 mb-2">
                <div class="col-md-6 ">
                    <img src="{{logo()}}" alt="" style="max-width: 114px;">
                </div>
                <div class="col-md-6 text-right mt-4">
                    <span class="align-text-bottom">Fund Transfer Request Authorization(FTRA)</span></div>
            </div>
            <div class="row ">
                <div class="mb-2 border col-md-12 bg-light font-weight-bold">
                    <div class="mt-1 mb-1">Customer Information</div>
                </div>
                <div class="col-md-12 row mb-2">
                    <div class="col-md-6 row">
                        <div class="col-md-6">First Name:</div>
                        <div class="col-md-6">{{@$user->first_name}}</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">Last Name:</div>
                        <div class="col-md-6">{{@$user->last_name}}</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">Address:</div>
                        <div class="col-md-6">{{@$user->address1}} ,{{@$user->address2}}</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">State:</div>
                        <div class="col-md-6">{{@$user->state}}</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">City:</div>
                        <div class="col-md-6">{{@$user->city}}</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">Zip Code:</div>
                        <div class="col-md-6">{{@$user->zip_code}}</div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="mb-2 border col-md-12 bg-light font-weight-bold">
                    <div class="mt-1 mb-1">Account Information</div>
                </div>
                <div class="col-md-12 row mb-2">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Account Type:</div>
                        <div class="col-md-6">{{@config('constant.account_type')[$user->account_type]}}</div>
                    </div>
                </div>
                <div class="col-md-12 row mb-2">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Account Number :</div>
                        <div class="col-md-6"> {{@$user->account_number}} </div>
                    </div>
                </div>
                <div class="col-md-12 row mb-2">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Routing Number :</div>
                        <div class="col-md-6"> {{@$user->routing_number}} </div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="mb-2 border col-md-12 bg-light font-weight-bold">
                    <div class="mt-1 mb-1">Funds Transfer Information</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Transfer Type :</div>
                        <div class="col-md-6"> Wire Transfer, Zelle </div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Transfer Date :</div>
                        <div class="col-md-7"> {{@$user->created_at_text}} </div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Country :</div>
                        <div class="col-md-6">USA</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Currency :</div>
                        <div class="col-md-7">USA</div>
                    </div>
                    {{-- <div class="col-md-6 row">
                        <div class="col-md-5">Wire Amount (USD):</div>
                        <div class="col-md-7">0.00</div>
                    </div> --}}
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Amount :</div>
                        <div class="col-md-6 ">{{@$user->loan_amount}}</div>
                    </div>
                    <div class="col-md-6 row mt-4">
                        <div class="col-md-5">Source:</div>
                        <div class="col-md-7">{{@$user->loan_type}}</div>
                    </div>
                </div>
                {{-- <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Source :</div>
                        <div class="col-md-6">In Person</div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Id Verification :</div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Exchange Rate :</div>
                        <div class="col-md-7">N/A</div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Id Type :</div>
                        <div class="col-md-6">Driver Licence</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Ref ID :</div>
                        <div class="col-md-7">TE-123-456-7890</div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Id Type :</div>
                        <div class="col-md-6">Bank Of America Debit Card</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Wire Fee :</div>
                        <div class="col-md-7">35.00</div>
                    </div>
                </div> --}}
            </div>
            <div class="row mb-2">
                <div class="mb-2 border col-md-12 bg-light font-weight-bold">
                    <div class="mt-1 mb-1">Documents Information</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Id Type :</div>
                        <div class="col-md-6">Drivers Licence, State Id, Passport</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Bank Name :</div>
                        <div class="col-md-7">{{@$user->bank_name}}</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">Id State  :</div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="mb-2 border col-md-12 bg-light font-weight-bold">
                    <div class="mt-1 mb-1">Receipt Information</div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Receipt Number :</div>
                        <div class="col-md-6">XXXXXXXXXXXXXXXXX</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Additional Reference Information :</div>
                        <div class="col-md-7">N/A</div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Additional Bank Instruction :</div>
                        <div class="col-md-6">N/A</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Agent Name :</div>
                        <div class="col-md-7"></div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-6">Agent ID Number :</div>
                        <div class="col-md-6"></div>
                    </div>
                </div>
                {{-- <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-4">Information About Payment :</div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Purpose Of Payment :</div>
                        <div class="col-md-6">For Golden Eagle Stamp Investment</div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Addition Phone Advice :</div>
                        <div class="col-md-7"></div>
                    </div>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6 row">
                        <div class="col-md-6">Addition refrence information :</div>
                        <div class="col-md-6"></div>
                    </div>
                    <div class="col-md-6 row">
                        <div class="col-md-5">Addition Bank Instruction:</div>
                        <div class="col-md-7">Golden Eagle Stamp Investment</div>
                    </div>
                </div> --}}
            </div>
            <div class="row mb-2">
                <div class="mb-2 border col-md-12 bg-light font-weight-bold">
                    <div class="mt-1 mb-1">Customer Approval</div>
                </div>
                <div class="col-md-12 row">
                    <p class="pl-3 pr-3">
                        i authorize Bank of America to transfer my fund as set fourth in the instructions herein(including debiting my account if applicable). and agree that
                        such tranfer of funds is subject to the Bank of America standard transfer agreement (see disclosure pages of this form) and applicable fees. If this is a
                        foreign currency wire transfer, I accept the conversion rate provided by Bank of America at the time the wire is sent. <br>
                        For a Consumer International wire We rely on you the customer, to inform us of the curruncy of the receiving account (denoted under 'Curruncy of Receipient Account')
                        so that we may disclosures the exchange rate for conversion in the wire process. If you chose to send USD rather than the foreign currency of the account ,
                        we will honor your choice, however, we will not be able to provide exchange rate information. Additionaly, so that we may provide required disclosures, you must remain
                        in the financial center until we provide you the Remittance Transfer Receipt(RTR). if you leave prior to receiving the RTR, we will change the International Remittance Transfer. 
                    </p>
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-7 row">
                        <div class="col-md-12">Customer Signature : __________________________________________________________</div>
                    </div>
                    <div class="col-md-5 row">
                        <div class="col-md-5 text-right">Date of request:</div>
                        <div class="col-md-7 text-left">_____/_____/__________</div>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="border col-md-12 bg-light font-weight-bold">
                    <div class="">For Bank Use Only: Wire initiation/Financial Center Information</div>
                </div>
                <div class="row col-md-12 m-0 p-0">
                    <div class="col-md-3 border">Financial Center Name</div>
                    <div class="col-md-3 border"></div>
                    <div class="col-md-3 border">Date</div>
                    <div class="col-md-3 border"></div>
                </div>
                <div class="row col-md-12 m-0 p-0">
                    <div class="col-md-3 border">Company #/ Cost Center #</div>
                    <div class="col-md-3 border"></div>
                    <div class="col-md-3 border">Phone #:</div>
                    <div class="col-md-3 border"></div>
                </div>
                <div class="row col-md-12 m-0 p-0">
                    <div class="col-md-3 border">Instiating Associate Name</div>
                    <div class="col-md-3 border"></div>
                    <div class="col-md-3 border">Remittance Id #:</div>
                    <div class="col-md-3 border"></div>
                </div>
                <div class="row col-md-12 m-0 p-0">
                    <div class="col-md-4 border">Indicate Method of Signature Verification (if applicable)</div>
                    <div class="col-md-1 border bg-light"></div>
                    <div class="col-md-1 border">Sig Card</div>
                    <div class="col-md-1 border bg-light"></div>
                    <div class="col-md-2 border">Bus , Resolution</div>
                    <div class="col-md-1 border bg-light"></div>
                    <div class="col-md-2 border">Postal Check #</div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
    <script>
    $('#cmd').click(function () {   
        ExportPdf();
    });


    function ExportPdf(){ 
        kendo.drawing
            .drawDOM("#pdfData", 
            { 
                paperSize: "A4",
                margin: { top: "1cm", bottom: "1cm" },
                scale: 0.59,
                height: 600
            })
                .then(function(group){
                kendo.drawing.pdf.saveAs(group, "Exported.pdf")
            });
    }
    </script>

</body>
</html>
@php
// exit;
@endphp