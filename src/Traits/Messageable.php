<?php

namespace OhKannaDuh\Groups\Traits;

use Illuminate\Database\Eloquent\Relations\Relation;
use OhKannaDuh\Groups\Contracts\GroupableContract;
use OhKannaDuh\Groups\Model\Message;

trait Messageable
{


    /**
     * Returns all messages.
     *
     * @return Relation
     */
    public function messages(): Relation
    {
        return $this->hasMany(Message::class);
    }


    /**
     * Send a Message.
     *
     * @return bool
     */
    public function sendMessage(GroupableContract $sender, string $content): bool
    {
        if ($this->canSendMessage($sender) === false) {
            return false;
        }

        $message = new Message([
            "user_id" => $sender->id,
            "group_id" => $this->id,
            "content" => $content,
        ]);

        return $message->save();
    }


    /**
     * Checks if the sender can send a message to this.
     *
     * @param GroupableContract $sender
     *
     * @return bool
     */
    public function canSendMessage(GroupableContract $sender): bool
    {
        return (
            $this->contains($sender) === true
            && $sender->canSendMessageToGroup($this) === true
        );
    }
}
