<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Classes\MyClassNFe;

class NfeController extends Controller
{
    public function emitirnotafiscal(Request $request)
    {
        $mynfe = new MyClassNFe();
        $response = $mynfe->emissaoNotaFiscal($request->data);

        if (isset($response->error)){
            if (isset($response->log)){
                return  response()->json(['Erro'=> $response->error,'Log' => $response->log]);
            }
            return  response()->json(['Erro'=> $response->error]);
        }
        return  response()->json(['resposne'=> $response ]);
    }

    public function emitirnotafiscaldevolucao(Request $request)
    {
        $mynfe = new MyClassNFe();
        $response = $mynfe->emissaoNotaFiscal($request->data);

        if(isset($response->error)){
            if(isset($response->log)){
                return  response()->json(['Error'=> $response->error, 'Log'=>$response->log]);
            }
            return  response()->json(['Error'=> $response->error]);
        }
        return  response()->json(['resposne'=> $response]);
    }

    public function emitirnotafiscalajuste(Request $request)
    {

        $mynfe = new MyClassNFe();
        $response = $mynfe->ajusteNotaFiscal( $request->data );

        if(isset($response->error)){
            if(isset($response->log)){
                return  response()->json(['Error'=> $response->error, 'Log'=>$response->log]);
            }
            return  response()->json(['Error'=> $response->error]);

        }
        return  response()->json(['resposne'=> $response]);
    }

    public function emitirnotafiscalcomplementar(Request $request)
    {
        $mynfe = new MyClassNFe();
        $response = $mynfe->complementarNotaFiscal( $request->data );

        if(isset($response->error)){
            if(isset($response->log)){
                return  response()->json(['Error'=> $response->error, 'Log'=>$response->log]);
            }
            return  response()->json(['Error'=> $response->error]);
        }
        return  response()->json(['resposne'=> $response]);
    }

    public function consultarnotafiscal(Request $request)
    {

        $data = $request->input('chave');
        $mynfe = new MyClassNFe();
        $response = $mynfe->consultaNotaFiscal( $data );

        if (isset($response->error)){
            return  response()->json(['Erro'=> $response->error]);

        }else{
            return response()->json(['response'=> $response]);
        }
    }
    public function cancelarnotafiscal(Request $request)
    {
        $mynfe = new MyClassNFe();
        $response = $mynfe->cancelarNotaFiscal( $request->data);

        if (isset($response->error)){
            if (isset($response->log)){
                return  response()->json(['Erro'=> $response->error,'Log' => $response->log ]);
            }
            return  response()->json(['Erro'=> $response->error]);
        }
        return  response()->json(['response'=> 'ok']);
    }

    public function inutilizarnotafiscal(Request $request)
    {
        $mynfe = new MyClassNFe();
        $response = $mynfe->inutilizarNumeracao($request->data);

        if (isset($response->error)){
            if (isset($response->log)){
                return  response()->json(['Erro'=> $response->error,'Log' => $response->log ]);
            }
            return  response()->json(['Erro'=> $response->error]);
        }
        return  response()->json(['Response'=> $response]);
    }

    public function validadecertificado()
    {
        $mynfe = new MyClassNFe();
        $response = $mynfe->validadeCertificado();

        if (isset($response->error)){

            return  response()->json(['Erro'=> $response->error]);
        } else {
            return  response()->json(['Response'=> $response]);

        }
    }

    public function statusSefaz()
    {
        $mynfe = new MyClassNFe();

        $response = $mynfe->statusSefaz();

        if (isset($response->error)){
            return  response()->json(['erro'=> $response->error]);
        } else {
            if ($response->status == 'online'){
                return  response()->json(['Sefaz'=> 'Online']);

            }else if ($response->status == 'offline') {
                return  response()->json(['Sefaz'=> 'Offline']);
            }
        }
        return  response()->json(['exepetion'=> 'exepetion']);

    }
}
