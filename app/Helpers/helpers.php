<?php

use App\Models\Customer;
use App\Models\User;
use App\Models\ShopSettings;

    if(!function_exists("get_user")){
        function get_user($id)
        {
            return User::find($id)->name;
            // return "Samuel Sarpong-Duah";
        }
    }

    if(!function_exists("getShopSettings")){
        function getShopSettings()
        {
            // DB::table('shop_settings')->selectRaw('*')->first();
           return ShopSettings::selectRaw('*')->first();
        }
    }

    if(!function_exists("getTaxValue")){
        function getTaxValue($value)
        {
            // DB::table('shop_settings')->selectRaw('*')->first();
           $value = ShopSettings::selectRaw("$value")->first()->$value;

           return $value;
        }
    }

    if(!function_exists("getTax")){
        function getTax($amount)
        {
            $nhil = $amount * (getShopSettings()->nhil / 100);
            $gehl = $amount * (getShopSettings()->gehl / 100);
            $covid = $amount * (getShopSettings()->covid19 /100);

            $sum = $amount + $nhil + $gehl + $covid;

            $result = $sum * (getShopSettings()->vat / 100);

            $total = $sum + $result;

            return $total;
        }
    }

    if(!function_exists("getCustomer")){
        function getCustomer($id)
        {
           $cus = Customer::find($id);
            if($cus){
                return $cus;
            }

           return -1;
        }
    }





