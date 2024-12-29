<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMention extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'users';

    public function searchableAs () {
        return 'users_mentions';
    }

    public function toSearchableArray () {
        return [
            'value' => $this->username,
            'label' => $this->name . ' (@' . $this->username . ')',
        ];
    }
}
