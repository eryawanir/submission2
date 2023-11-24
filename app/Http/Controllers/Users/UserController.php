<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getDataUser(Request $request)
    {
        $nama = $request->get('nama');
        $email = $request->get('email');

        $data = [
            'nama' => $nama,
            'email' => $email,
        ];

        return json_encode($data);
    }

    private static function cekUser($username)
    {
        if ($username == 'eryawan') {
            return true;
        } else {
            return false;
        }
    }

    public function createDataUser(Request $request)
    {
        $arr['username'] = $request->post('username');
        $arr['email'] = $request->post('email');
        $arr['no_telp'] = $request->post('no_telp');

        // kalau mau valid, username == 'eryawan'
        $isValid = self::cekUser($arr['username']);
        if ($isValid) {
            $res['status'] = true;
            $res['message'] = 'Username Valid!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Username Tidak Valid!';
            $code = 401;
        }
        $data = ['hasil' => $res, 'data' => $arr];
        return response()->json($data, $code);
    }

    public function updateDataUser(Request $request)
    {
        $arr['username'] = $request->post('username');
        $isValid = self::cekUser($arr['username']);

        if ($isValid) {
            $arr['email'] = $request->post('email');
            $arr['no_telp'] = $request->post('no_telp');
            $res['status'] = true;
            $res['message'] = 'Berhasil diupdate';
            $code = 200;
        } else {
            $arr = null;
            $res['status'] = true;
            $res['message'] = 'Username Tidak Valid! tidak ada yang diupdate';
            $code = 401;
        }
        $data = ['hasil' => $res, 'data' => $arr];
        return response()->json($data, $code);
    }
    public function deleteDataUser(Request $request)
    {
        $arr['username'] = $request->get('username');

        $isValid = self::cekUser($arr['username']);
        if ($isValid) {
            $res['status'] = true;
            $res['message'] = 'Data berhasil dihapus!';
            $code = 200;
        } else {
            $res['status'] = false;
            $res['message'] = 'Data tidak ditemukan / username tidak valid!';
            $code = 401;
        }

        return response()->json($res, $code);
    }
}
