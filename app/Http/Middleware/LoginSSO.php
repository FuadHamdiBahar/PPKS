<?php

namespace App\Http\Middleware;

use Closure;

class LoginSSO
{
    var $skey     = "V0d7vT5LY2w0uUsrCOlhwgr8J7vODW6J"; // you can change it 

    public function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function encode($value)
    {
        if (!$value) {
            return false;
        }
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));
    }

    public function decode($value)
    {
        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

    public function handle($request, Closure $next)
    {
        error_reporting(0);
        if (isset($_GET['token'])) {
            $tmptoken = $this->decode($_GET['token']);
            $userdata = json_decode($tmptoken);
            // dd($userdata);
            if ($userdata->expd < time()) {
                return url('http://ssodev.lldikti9.id/access/logout', 'refresh');
            } else {
                foreach ($userdata as $key => $object) {
                    $request->session()->put($key, $object);
                }
            }
        }


        // $person_id = $request->session()->get('personid');


        // $data = DB::select("SELECT usertype from rbacdev.rbac.mstpengguna where username='" . $request->session()->get('username') . "'");
        // $data = collect($data)->first();

        // $value = $person_id;
        // if ($data->usertype == 2) {
        //     $value = collect(DB::select("SELECT id_sp FROM pddikti.dbo.dosen where id_sdm='" . ($person_id) . "'"))->first()->id_sp;
        // }

        // $request->session()->put('id_sp',  '$value');
        // $request->session()->put('id_sp',  'F8DD0A7C-A200-4988-BC60-78951AE95D1E');



        $request->session()->put('namalengkap', 'ali isra');
        $request->session()->put('userid', '790DF6AD-EB98-4C6A-A3FC-FB7A05BE3A82');
        $request->session()->put('email', ' ');
        $request->session()->put('personid', '63BA72E3-1C3B-422F-9C3F-B4F71560BDFE');
        $request->session()->put('username', 'aisra');
        $request->session()->put('paltform', 'Mac OS X');
        $request->session()->put('browser', 'Chrome 96.0.4664.55');
        $request->session()->put('logged_in', True);

        // $request->session()->put('namalengkap', '091002_ppks');
        // $request->session()->put('userid', '4736B4B3-DBF8-4F7D-986D-FCAA08DF5CCF');
        // $request->session()->put('email', ' ');
        // $request->session()->put('personid', 'F8DD0A7C-A200-4988-BC60-78951AE95D1E');
        // $request->session()->put('username', '091002');
        // $request->session()->put('paltform', 'Mac OS X');
        // $request->session()->put('browser', 'Chrome 96.0.4664.55');
        // $request->session()->put('logged_in', True);

        // dd($request->session());
        $logged_in = $request->session()->get('logged_in');
        $userid = $request->session()->get('userid');
        $username = $request->session()->get('username');



        if (!$logged_in) {
            return redirect('http://ssodev.lldikti9.id/access?url=http://127.0.0.1:8000/');
        }

        return $next($request);
    }
}
