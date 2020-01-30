<?php

class Post implements JsonSerializable
{
    private $postId, $text, $date;

    /**
     * Post constructor.
     * @param $postId
     * @param $text
     * @param $date
     */
    public function __construct($postId, $text, $date)
    {
        $this->postId = $postId;
        $this->text = $text;
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'postId' => $this->postId,
            'text' => $this->text,
            'date' => $this->date
        ];
    }
}