<?php

namespace espend\Ide\Client;

use espend\Ide\Client\Response\IdeServerResponse;

class IdeCurlClient implements IdeClientInterface
{

    /**
     * @var string main ide server url
     */
    protected $endpoint;

    public function __construct($endpoint = 'http://127.0.0.1:22221')
    {
        $this->endpoint = $endpoint;
    }

    /**
     * {@inheritdoc}
     */
    public function send($projectName, array $data)
    {

        $ch = curl_init(sprintf(IdeClientInterface::PROJECT_URL, $this->endpoint, $projectName));

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return new IdeServerResponse($result, 200);

    }

    /**
     * {@inheritdoc}
     */
    public function update($projectName, $provider, array $data)
    {
        throw new \RuntimeException(__CLASS__ . ':' . __FUNCTION__ . ' not implemented yet');
    }

    /**
     * {@inheritdoc}
     */
    public function clear($projectName)
    {
        throw new \RuntimeException(__CLASS__ . ':' . __FUNCTION__ . ' not implemented yet');
    }

    /**
     * {@inheritdoc}
     */
    public function projects()
    {
        throw new \RuntimeException(__CLASS__ . ':' . __FUNCTION__ . ' not implemented yet');
    }

}