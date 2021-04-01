<?php

namespace App\Http\Controllers;

use App\Helpers\BaseHelper;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $helper;
    public $emailTemplate;
    public function __construct(BaseHelper $helper, EmailTemplate $emailTemplate)
    {
        $this->helper = $helper;
        $this->emailTemplate = $emailTemplate;
    }
    public function authenticate(Request $request)
    {
        $validator = $request->validate([
            'email'     => 'required',
            'password'  => 'required|min:6'
        ]);

        if (Auth::attempt($validator)) {
            if(Auth::user()->status == 0){
              Auth::guard('web')->logout();
              return redirect()->route('login')->withError('Your account was banned ');
            }
            // $viewFile = 'email.login';
            // $this->helper->sendMailToAdmin(config('constant.mail_template.1'),$viewFile,Auth::user(),null);
            return redirect('/dashboard');
        }else{
            return redirect()->route('login')->withErrors('Invalid credentials');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with(['success' => 'Logout Successfully']);
    }
}
