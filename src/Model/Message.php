<?php

namespace OhKannaDuh\Groups\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Message extends Model
{
    /** @var array */
    protected $fillable = [
        "user_id", "group_id", "content",
    ];


    /**
     * Gets the user that sent this message.
     *
     * @return Relation
     */
    public function user(): Relation
    {
        return $this->belongsTo(config("auth.providers.users.model"));
    }


    /**
     * Gets the group that this message was sent to.
     *
     * @return Relation
     */
    public function group(): Relation
    {
        return $this->belongsTo(Group::class);
    }
}
