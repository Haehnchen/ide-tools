<?php

namespace espend\Ide\Client\Response;

class IdeServerResponse
{

    protected $content;
    protected $responseCode;

    public function __construct($content, $responseCode)
    {
        $this->content = $content;
        $this->responseCode = $responseCode;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

}