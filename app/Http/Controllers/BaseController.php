<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as IlluminateController;

class BaseController extends IlluminateController
{
    public $validator = null;
        /**
     * success response method.
     *
     *@return \Illuminate\Http\Response
     */

    public function __construct()
    {
    	$this->validator = new Validator;
    }

    public  function _validar(array $reglas, array $data = null, array $mensajesPersonalisados = [])
    {
       $datosValidar = $data!=null? $data : request()->all();
       return  Validator::make($datosValidar, $reglas, $mensajesPersonalisados);
    }

    public function ok($message="Petición completada con éxito",$result=[])
    {
        return $this->response($message,$result,OK);
    }

    public function forbidden($message="No tiene permiso para acceder a este recurso")
    {
        return $this->response($message,[],FORBIDDEN);
    }

     public function preconditionFailed($message="Validación fallida",$detalleErrores=[])
    {
        return $this->response($message,$detalleErrores,PRECONDITION_FAILED);
    }

     public function expectationFailed($message="Solicitud no procesada, datos inesperados.")
    {
        return $this->response($message,[],EXPECTATION_FAILED);
    }

     public function notFound($message="Recurso no encontrado")
    {
        return $this->response($message,[],NOT_FOUND);
    }

    public function methodNotAllowed($message="Metodo no permitido")
    {
        return $this->response($message,[],METHOD_NOT_ALLOWED);
    }

    public function unauthorized($message="No autorizado")
    {
        return $this->response($message,[],UNAUTHORIZED);
    }


    /*
    Evite utilizar este metodo en clases que hereden de Controller

    En su lugar utilice los métodos: ok,forbidden,preconditionFailed,expectationFailed,notFound, etc. implementado mas arriba segun su necesidad.
     */
    public function response($message="Petición completada con éxito",$result=[],$code=OK)
    {   
        $success = $code == OK ? true : false ;
        
    	$response = [
            'code' => $code,
            'success' => $success,            
            'message' => $message,
        ];

        if(!empty($result))
        {
           foreach ($result as $key => $value) {
            $response[$key] = $value;
            } 
        }        

        return response()->json($response, $code);
    }    
}
