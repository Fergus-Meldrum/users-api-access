<?php

namespace Dtos;

use JsonSerializable;

class UserDto implements JsonSerializable {

    public function __construct(
        public int $id,
        public string $email,
        public string $firstName,
        public string $lastName,
        public string $avatar,
    )
    {
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first-name' => $this->firstName,
            'last-name' => $this->lastName,
            'avatar' => $this->avatar,
        ];
    }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
            'first-name' => $this->firstName,
            'last-name' => $this->lastName,
            'avatar' => $this->avatar,
        ];
    }


}