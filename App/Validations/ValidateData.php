<?php

namespace App\Validations;

use App\Traits\ResponseTrait;
use App\Database\QueryBuilder;

trait ValidateData
{
    use ResponseTrait;

    protected $queryBuilder;

    public function __construct()
    {
        $this->queryBuilder = new QueryBuilder();
    }

    public function validate($fields = [], $request){
        if(count($fields)){
            $isError = false;
            $errorsMessages = [];

            foreach ($fields as $field){
                $items = explode("||", $field);
                $itemsCount = count($items);
//                dd($items[1]);
                if($itemsCount == 2){
                    $validations_param_string = $items[1];
                    $validations = explode('|', $validations_param_string);

                    foreach ($validations as $validation){
                        $key = $items[0];

                        // required validation
                        if($validation == "required"){
                            if(!isset($request->$key) || empty($request->$key)) $isError = true && array_push($errorsMessages, "لطفا " . translate_key($key) . " را وارد کنید");
                        }

                        // check string value
                        if($validation == "string"){
                            if(isset($request->$key)) if(!is_string($request->$key)) $isError = true && array_push($errorsMessages, "مقدار " . translate_key($key) . " باید یک رشته باشد");
                        }

                        // check int|number value
                        if($validation == "int" || $validation == "number"){
                            if(isset($request->$key)) if(!is_int($request->$key)) $isError = true && array_push($errorsMessages, "مقدار " . translate_key($key) . " باید یک عدد باشد");
                        }

                        // check int|number value
                        if($validation == "bool" || $validation == "boolean"){
                            if(isset($request->$key)) if(!is_bool($request->$key)) $isError = true && array_push($errorsMessages, "مقدار " . translate_key($key) . " باید یک عبارت منظقی (true یا false) باشد");
                        }

                        // min chars validation
                        if(str_contains($validation, "min")){
                            $min_value = (int)explode(':', $validation)[1];
                            if(isset($request->$key)) if(mb_strlen($request->$key) < $min_value) $isError = true && array_push($errorsMessages, "مقدار " . translate_key($key) . " باید حداقل ".$min_value." کارکتر باشد");
                        }

                        // max chars validation
                        if(str_contains($validation, "max")){
                            $max_value = (int)explode(':', $validation)[1];
                            if(isset($request->$key)) if(mb_strlen($request->$key) > $max_value) $isError = true && array_push($errorsMessages, "مقدار " . translate_key($key) . " نمیتواند بیشتر از  ".$max_value." کارکتر باشد");
                        }

                        // check chars length
                        if(str_contains($validation, "length")){
                            $length_value = (int)explode(':', $validation)[1];
                            if(isset($request->$key)) if(mb_strlen($request->$key) != $length_value) $isError = true && array_push($errorsMessages, "مقدار " . translate_key($key) . " باید برابر با ".$length_value." کارکتر باشد");
                        }

                        // check enum values
                        if(str_contains($validation, "enum")){
                            $enums = explode(',' , trim($validation, 'enum:'));
                            if(isset($request->$key)) if(!in_array($request->$key, $enums)) $isError = true && array_push($errorsMessages, " مقدار " . translate_key($key) . " معتبر نیست!");
                        }
                    }
                } else if($itemsCount == 1){
                    if(!isset($request->$field) || empty($request->$field)) $isError = true && array_push($errorsMessages, "لطفا " . translate_key($field) . " را وارد کنید");
                } else {
                    $this->sendResponse(message: "ورودی های ولیدیشن شما اشتباه است", error: true, status: HTTP_BadREQUEST);
                    return exit();
                }
            }

            if($isError){
//                $this->sendResponse(message: $errorsMessages, error: true, status: HTTP_BadREQUEST);
                $this->sendResponse(message: $errorsMessages[0], error: true, status: HTTP_BadREQUEST);
                return exit();
            }
        } return true;
    }

    public function checkUnique($table = null, $key = null, $value = null, $array = false){
        if($array){
            foreach ($array as $item){
                // unique Resourse check
                $hasResourse = $this->queryBuilder->table($table)
                    ->where($item[0], '=', $item[1])
                    ->get()->execute();

                if($hasResourse){
                    $this->sendResponse(message: "مقدار " . translate_key($item[0]) . " تکراری است یا از قبل وجود دارد!", error: true, status: HTTP_BadREQUEST);
                    return exit();
                }
            }
        }
        else {
            // unique Resourse check
            $hasResourse = $this->queryBuilder->table($table)
                ->where($key, '=', $value)
                ->get()->execute();

            if($hasResourse){
                $this->sendResponse(message: "مقدار " . translate_key($key) . " تکراری است یا از قبل وجود دارد!", error: true, status: HTTP_BadREQUEST);
                return exit();
            }
        }
    }
}