<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientsMessages extends Model
{
    use HasFactory;

    protected $fillable = ['phone_number', 'first_name', 'last_name','email','num_unread_messages','visited','clients_id'];

    public function client()
    {
        return $this->belongsTo(Client::class,'clients_id');
    }
}
