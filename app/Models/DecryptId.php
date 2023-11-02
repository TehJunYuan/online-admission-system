<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DecryptId extends Model
{
    use HasFactory;

    private $decryptedId;

    public function setDecryptedId($id){
        try{
            $this->decryptedId = Crypt::decrypt($id);
        }catch(DecryptException $e){
            return redirect()->route('stu.dashboard');
        }
    }

    public function getDecryptedId(){
        return $this->decryptedId;
    }
 
}
