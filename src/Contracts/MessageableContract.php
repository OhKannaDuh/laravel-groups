<?php

namespace OhKannaDuh\Groups\Contracts;

use Illuminate\Database\Eloquent\Relations\Relation;

interface MessageableContract
{


    /**
     * Returns all groups.
     *
     * @return Relation
     */
    public function messages(): Relation;


    /**
     * Sends a Message.
     *
     * @return bool
     */
    public function sendMessage(GroupableContract $sender, string $content): bool;


    /**
     * Checks if the sender can send a message to this.
     *
     * @param GroupableContract $sender
     *
     * @return bool
     */
    public function canSendMessage(GroupableContract $sender): bool;
}
