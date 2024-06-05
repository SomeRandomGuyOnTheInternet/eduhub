<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiscussionReply extends Model
{
    protected $table = 'discussion_replies';
    protected $primaryKey = 'discussion_replies_id';
    protected $fillable = ['discussion_id', 'user_id', 'reply'];

    public function discussion()
    {
        return $this->belongsTo(Discussion::class, 'discussion_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
