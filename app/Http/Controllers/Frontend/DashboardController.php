<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ProfileFromRequest;
use App\Models\App;
use App\Models\ContactUs;
use App\Models\LoanTransaction;
use App\Models\User;
use App\Models\CMS;
use App\Models\UserEarning;
use App\Models\UserLoanDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;

class DashboardController extends Controller
{
    public function index(){
        return view('frontend.index');
    }
    public function workFromHome(){
        return view('frontend.work');
    }
    public function dashboard(){
        $user = Auth::guard('web')->user();

        // user earning data
        $query =    UserEarning::whereHas('earningUser',function($query) use($user){
                        $query->whereUserId($user->id);
                    });
        $earnings = $query->whereStatus(1)->limit(5)->get();
        $totalEarnings = count($query->get());
        $transactionDate = $query->orderBy('id','desc')->first();
        $lastTransactionDate = isset($transactionDate->created_at)?date('d M, Y',strtotime($transactionDate->created_at)):'---';
        $appEarning = $query->select('id','app_id',DB::raw('sum(amount) amount'),'status')
                        ->groupBy('app_id')
                        ->get();
        // dd($earnings);
        $month = date('m');
        $year = date('Y');
        $monthLyEarning = $query->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('amount');
        $totalPaidAmount = UserEarning::whereHas('earningUser',function($query) use($user){
                                $query->whereUserId($user->id);
                            })
                            ->whereStatus(1)
                            ->sum('amount');
        $totalUnPaidAmount =    UserEarning::whereHas('earningUser',function($query) use($user){
                                    $query->whereUserId($user->id);
                                })
                                ->whereStatus(0)
                                ->sum('amount');

        $totalEarning = $totalPaidAmount + $totalUnPaidAmount;
        // loan data
        $totalLoanAmount = UserLoanDetail::whereUserId($user->id)->sum('loan_amount');
        $totalLoan = UserLoanDetail::whereUserId($user->id)->count();
        $paidAmount = LoanTransaction::whereUserId($user->id)->sum('amount');
        $loanTransactions = LoanTransaction::whereUserId($user->id)->whereNotNull('amount')->orderBy('id','desc')->limit(5)->get();
        $totalLoanTransaction = UserEarning::whereHas('earningUser',function($query) use($user){
                                    $query->whereUserId($user->id);
                                })->whereStatus(1)->count();
        $leftToPay = $totalLoanAmount - $paidAmount;
        $lastLoan = UserLoanDetail::whereUserId($user->id)->orderBy('id','asc')->whereStatus(1)->first();
        if($leftToPay < 0 ){
            $leftToPay = 0;
            $loanRatio = 100;
        }else{
            $paidInstallment = $user->userLoans->where('date','!=',null)->where('amount', '!=',null)->count();
            $totalInstallment = $user->userLoans->count();
            $dueInstallment = $user->dueInstallments->count();
            if($totalLoanAmount != 0 && $paidInstallment != 0 && $dueInstallment != 0){
                // $loanRatio = ($paidAmount * 100)/$totalLoanAmount;$totalLoanAmount

                $loanRatio = ( $paidInstallment * 100) / $totalInstallment;

                $loanRatio = number_format($loanRatio,1);
            }
        }
        $earningRatio = 0;
        if($totalEarning > 0){
            $earningRatio = ($totalEarning * 100) / 10000;
        }
        $earningMethod= UserEarning::whereHas('earningUser',function($query) use($user){
                            $query->whereUserId($user->id);
                        })->orderBy('id','asc')->first();
        $earningMethodName = @$earningMethod->app->title;
        $activeLoan = UserLoanDetail::whereUserId($user->id)->whereStatus(1)->count();
        $lastEarning = $query->orderBy('id','desc')->first();
        return view('frontend.dashboard',['lastTransactionDate'=>@$lastTransactionDate,'totalLoan'=>@$totalLoan,'leftToPay'=>@$leftToPay,
        'paidAmount'=>@$paidAmount,'user'=>@$user,'earnings'=>@$earnings,'monthLyEarning'=>@$monthLyEarning,
        'totalPaidAmount'=>@$totalPaidAmount,'totalUnPaidAmount'=>@$totalUnPaidAmount,
        'totalLoanAmount'=>@$totalLoanAmount,'activeLoan'=>@$activeLoan,'appEarning'=>@$appEarning,
        'loanTransactions' =>@$loanTransactions,'loanRatio'=>@$loanRatio,'totalEarning'=>@$totalEarning,
        'totalEarnings' => @$totalEarnings, 'earningRatio' => @$earningRatio,'lastLoan' => @$lastLoan, 'lastEarning'
        => @$lastEarning, 'totalLoanTransaction' =>@$totalLoanTransaction,'earningMethodName'=>@$earningMethodName,
        ]);
    }
    public function updateProfile(){
        return view('frontend.profile');
    }

    public function profile(){
        $user = Auth::user();
        $query =    UserEarning::whereHas('earningUser',function($query) use($user){
                        $query->whereUserId($user->id);
                    });
        $earnings = $query->limit(10)->get();
        $appEarning = $query->select('id','app_id',DB::raw('sum(amount) amount'),'status')
                        ->groupBy('app_id')
                        ->get();
        // dd($appEarning);
        $month = date('m');
        $year = date('Y');
        $monthLyEarning = $query->whereMonth('created_at',$month)->whereYear('created_at',$year)->sum('amount');
        $totalLoanAmount = UserLoanDetail::whereUserId($user->id)->sum('loan_amount');
        $activeLoan = UserLoanDetail::whereUserId($user->id)->whereStatus(1)->count();
        $totalPaidAmount = $query->whereStatus(1)->sum('amount');
        $totalUnPaidAmount = $query->whereStatus(0)->sum('amount');
        $user = Auth::guard('web')->user();
        return view('frontend.profile',['user'=>@$user,'earnings'=>@$earnings,'monthLyEarning'=>@$monthLyEarning,'totalPaidAmount'=>@$totalPaidAmount,'totalUnPaidAmount'=>@$totalUnPaidAmount,'totalLoanAmount'=>@$totalLoanAmount,'activeLoan'=>@$activeLoan,'appEarning'=>@$appEarning]);
    }

    public function profileUpdate(ProfileFromRequest $request){
        $userId = Auth::guard('web')->id();
        $user = User::find($userId);
        if(isset($request->password) && $request->password != null){
            array_set($request,'password',Hash::make($request->password));
        }else{
            $request->request->remove('password');
        }
        if ($request->hasFile('image_file')) {
            $logo = $request->file('image_file');
            $request['image'] = $this->fileupload($logo, ($user->image) ? $user->image : null);
        }

        $user->fill($request->all())->save();
        $msg = 'Profile updated successfully';
        return redirect()->route('dashboard')->with('message',$msg);
    }

    public function fileupload($file, $name = null)
    {
        if ($name != null) {
            Storage::disk('local')->delete('users/' . $name);
        }
        $filename = time() . '_' . $file->getClientOriginalName();
        Storage::disk('local')->putFileAs('users/', $file, $filename);
        return $filename;
    }

    public function contactPage(Request $request){
        return view('frontend.contact_us');
    }

    public function contactUs(Request $request){
        $contactUs = ContactUs::create($request->all());
        $msg = 'Your request send successfully';
        return redirect()->route('get.contact-us')->with('message',$msg);
    }

    public function aboutUs(Request $request){
        $cms = CMS::where('page_slug','about-us')->first();
        return view('frontend.about_us',['cms'=>@$cms]);
    }
    
    public function cmsPages(Request $request){
        $routeName = Route::currentRouteName();
        $cms = CMS::where('page_slug',$routeName)->first();
        return view('frontend.about_us',['cms'=>@$cms]);
    }
}
