<?php 

namespace App\Class;

use App\Models\RentPayments;

class RentPayment{
    

    public function insert_payments($rent_id, $terms, $date, $rent_type, $amount, $discount){
        
        $type = str_replace("ly", "", $rent_type);

        $discounted = $discount == 0 ? $amount : $amount * ($discount/100);
        for($i=0; $i < $terms; $i++){
            $data = [
                'rent_id' => $rent_id,
                'amount' => $discounted,
                'due_date' => date('Y-m-d', strtotime('+'.($i+1).' '.$type, strtotime($date))),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            RentPayments::insert($data);
        }

    }

}


?>